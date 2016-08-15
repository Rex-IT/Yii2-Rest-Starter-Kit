<?php
/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */

namespace app\models;


use yii\base\Model;

class Login extends Model
{
    public $username;

    public $password;

    private $_user;

    public function rules()
    {
        return [
            [['username','password'],'required']
        ];
    }

    /**
     * Validate login
     * @return bool
     */
    public function validateLogin()
    {
        return $this->validate() && (($this->_user = User::findByUsername($this->username)) !== null)
            ? $this->_user->validatePassword($this->password)
            : false;
    }

    /**
     * @return array
     */
    public function answer()
    {
        return [
            'username'=>$this->getUser()->username,
            'access_token'=>$this->getUser()->access_token
        ];
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }
}