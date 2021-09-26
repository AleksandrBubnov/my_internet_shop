<?php

use yii\db\Migration;

/**
 * Class m210925_050709_addRole
 */
class m210925_050709_addRole extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->add($auth->createRole('admin'));
        $auth->add($auth->createRole('owner'));
        $auth->add($auth->createRole('seo_manager'));
        $auth->add($auth->createRole('content_manager'));
        $auth->add($auth->createRole('user'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210925_050709_addRole cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210925_050709_addRole cannot be reverted.\n";

        return false;
    }
    */
}
