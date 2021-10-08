<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%baskets}}`.
 */
class m211006_215643_create_basket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%baskets}}', [
            'id' => $this->primaryKey(),
            'products' => 'json',
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%baskets}}');
    }
}
