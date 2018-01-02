<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $level
 *
 * @property MLevel $level0
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $authKey = 'dsfdfmjvhsdfgn215544';

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'level'], 'required'],
            [['level'], 'integer'],
            [['username', 'password'], 'string', 'max' => 50],
            [['level'], 'exist', 'skipOnError' => true, 'targetClass' => MLevel::className(), 'targetAttribute' => ['level' => 'id']],
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
            'password' => 'Password',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel0()
    {
        return $this->hasOne(MLevel::className(), ['id' => 'level']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username)
    {
        //mencari user login berdasarkan username dan hanya dicari 1.
        $user = static::find()->where(['username'=>$username])->one(); 
        if(count($user)){
            return new static($user);
        }
        return null;
    }

    public function validatePassword($password) {
        return $this->password ===  ($password);
    }


    
}
