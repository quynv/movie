<?php

namespace frontend\models;

use common\models\User;
use common\models\Movie;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property integer $target_id
 * @property integer $created_at
 */
class Notification extends ActiveRecord
{
    const FOLLOW = 1;
    const REQUEST = 2;

    public $user;
    public $movie;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'target_id', 'created_at'], 'required'],
            [['user_id', 'type', 'target_id', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'target_id' => Yii::t('app', 'Target ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at'],
                ],
            ],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        if($this->type == self::FOLLOW)
        {
            $this->user = User::findOne(['id' => $this->target_id]);
        }
        elseif($this->type == self::REQUEST)
        {
            $request = Request::findOne(['id' => $this->target_id]);
            $this->user = User::findOne(['id' => $request->user_id]);
            $this->movie = Movie::findOne(['id' => $request->movie_id]);
        }
    }

    public static function addNotification($user_id, $type, $target)
    {
        $notify = self::findOne(['user_id' => $user_id, 'type' => self::REQUEST, 'target_id' => $target]);
        if($notify) return;
        $notify = new Notification();
        $notify->user_id = $user_id;
        $notify->type = $type;
        $notify->target_id = $target;
        $notify->save(false);
    }

}
