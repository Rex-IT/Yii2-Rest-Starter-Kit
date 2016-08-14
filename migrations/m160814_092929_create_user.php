<?php

use yii\db\Migration;

class m160814_092929_create_user extends Migration
{
    public function up()
    {
        $this->createTable("{{%user}}",[
            'id'=>'pk',
            'username'=>$this->string(32),
            'auth_key'=>$this->string(32),
            'access_token'=>$this->string(40),
            'password_hash'=>$this->string(255),
            'oauth_client'=>$this->string(255),
            'oauth_client_user_id'=>$this->string(255),
            'email'=>$this->string(255),
            'status'=>$this->smallInteger(6),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'logged_at'=>$this->integer()
        ]);


        $this->createTable('{{%user_profile}}',[
            'user_id'=>'pk',
            'first_name'=>$this->string(255),
            'middle_name'=>$this->string(255),
            'last_name'=>$this->string(255),
            'avatar_path'=>$this->string(255),
            'avatar_base_url'=>$this->string(255),
            'gender'=>$this->smallInteger(1)
        ]);

        $this->addForeignKey('fk_user_profile','{{%user_profile}}','user_id','{{%user}}','id','cascade','cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_profile','{{%user_profile}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%user_profile}}');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
