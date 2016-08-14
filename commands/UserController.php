<?php
/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */

namespace app\commands;



use app\models\SignUp;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Json;

class UserController extends Controller
{
    public function actionSignUp()
    {
        $this->stdout("Create user \n");
        $this->stdout("Username [webmaster]:");
        $user_name = Console::stdin();
        $this->stdout("Password [webmaster]:");
        $password = Console::stdin();
        $this->stdout("Email [webmaster@example.com]:");
        $email = Console::stdin();
        if (!$user_name) {
            $user_name = 'webmaster';
        }
        if (!$password) {
            $password = 'webmaster';
        }
        if (!$email) {
            $email = 'webmaster@example.com';
        }
        $model = new SignUp();
        $model->username = $user_name;
        $model->password = $password;
        $model->email = $email;
        if (($user = $model->signup())) {
            $this->stdout("User ".$user->username." created! \n");
            return 0;
        }
        $this->stdout(Json::encode($model->getFirstErrors(),JSON_PRETTY_PRINT)."\n");
        return 1;
    }
}