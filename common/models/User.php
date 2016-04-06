<?php
namespace common\models;

use frontend\models\Follow;
use frontend\models\Friend;
use Yii;
use yii\base\NotSupportedException;
use \yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use frontend\models\Provider;
use yii\helpers\Url;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $avatar
 * @property string $access_token
 * @property string $email
 * @property string $auth_key
 * @property integer $expire_date
 * @property integer $last_login
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 10;
    const STATUS_ACTIVE = 100;
    const NONE_AVATAR = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_NOT_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->created_at = new Expression('NOW()');
        } else
            $this->updated_at = new Expression('NOW()');

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by access token
     *
     * @param string $token access token
     * @return static|null
     */
    public static function findByAccessToken($token)
    {
        if (!static::isAccessTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'access_token' => $token
        ]);
    }

    /**
     * Finds out if access token is valid
     *
     * @param string $token access token
     * @return boolean
     */
    public static function isAccessTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = static::findByAccessToken($token)->expire_date;
        $expire = Yii::$app->params['user.tokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes access token
     */
    public function removeAccessToken()
    {
        $this->access_token = null;
    }

    /**
     * Generates new password reset token
     */

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
        $this->expire_date = time();
    }

    public function getAvatar($size = 53)
    {
        if($this->avatar == self::NONE_AVATAR) {
            return Url::toRoute('@web/img/default_avatar.png');
        } else {
            $provider = Provider::findOne(['id' => $this->avatar]);
            return Yii::$app->avatar->getAvatar(strtolower($provider->provider), $provider->provider_id, $size);
        }
    }

    public function getProvider()
    {
        return $this->hasMany(Provider::className(), ['id' => 'user_id']);
    }

    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['user_id' => 'id']);
    }

    public static function getRated($movie_id)
    {
        $rating = Rating::find()->where(['user_id' => Yii::$app->user->id, 'movie_id' => $movie_id])->one();
        if($rating) return $rating->rating;
        return 0;
    }

    public function getFavourites()
    {
        return $this->hasMany(Movie::className(), ['id' => 'movie_id'])
                    ->viaTable('favourites', ['user_id' => 'id']);
    }

    public function getFollowers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('follows', ['followed' => 'id']);
    }

    public function getFollowing()
    {
        return $this->hasMany(User::className(), ['id' => 'followed'])
            ->viaTable('follows', ['user_id' => 'id']);
    }

    public function getIs_following()
    {
        $follow = Follow::findOne(['user_id' => Yii::$app->user->id, 'followed' => $this->id]);
        if($follow) return true;
        return false;
    }
}
