<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%products}}`
 * - `{{%orders}}`
 */
class m211005_113921_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-items-product_id}}',
            '{{%items}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-items-product_id}}',
            '{{%items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-items-order_id}}',
            '{{%items}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-items-order_id}}',
            '{{%items}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-items-product_id}}',
            '{{%items}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-items-product_id}}',
            '{{%items}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-items-order_id}}',
            '{{%items}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-items-order_id}}',
            '{{%items}}'
        );

        $this->dropTable('{{%items}}');
    }
}
