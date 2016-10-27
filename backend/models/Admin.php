<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "administrators".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property integer $role
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends ActiveRecord implements IdentityInterface
{
    const BANNER = 0;
    const ACTIVE = 1;
    const ADMIN = 10;
    const OWNER = 100;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrators';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','role', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()->where(['id' => $id])->andWhere(['<>', 'role', self::BANNER])->one();
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
        return static::find()->where(['username' => $username])->andWhere(['<>', 'role', self::BANNER])->one();
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */

    public static function findByEmail($email)
    {
        return static::find()->where(['email' => $email])->andWhere(['<>', 'role', self::BANNER])->one();
    }

    public static function findByAccessToken($token)
    {
        throw new NotSupportedException('This function is not implemented.');
    }

    public static function isAccessTokenValid($token)
    {
        throw new NotSupportedException('This function is not implemented.');
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
        throw new NotSupportedException('This function is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('This function is not implemented.');
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
        throw new NotSupportedException('This function is not implemented.');
    }

    public function getAvatar($size = 40)
    {
        return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->email ) ) ) . "?s=" . $size;
    }

    public function getRolename()
    {
        if($this->role == self::OWNER)
        {
            return 'Owner';
        }

        return 'Administrator';
    }

    public static function getRoles()
    {
        return [
            self::OWNER => 'Owner',
            self::ADMIN => 'Administrator',
            self::BANNER => 'Banner'
        ];
    }
}
