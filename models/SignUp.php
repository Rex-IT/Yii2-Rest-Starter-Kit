<?php
/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */

namespace app\models;


use Yii;
use yii\base\Exception;
use yii\base\Model;

class SignUp extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass'=>User::className(),
                'message' => Yii::t('app', 'This username has already been taken.')
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> User::className(),
                'message' => Yii::t('app', 'This email address has already been taken.')
            ],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('app', 'Username'),
            'email'=>Yii::t('app', 'E-mail'),
            'password'=>Yii::t('app', 'Password'),
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            if(!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup();
            return $user;
        }
        return null;
    }

}