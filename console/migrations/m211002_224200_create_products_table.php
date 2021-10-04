<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m211002_224200_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0),
            'price' => $this->float()->notNull()->defaultValue(0),
            'category_id' => $this->integer()->notNull(),
            'sub_category_id' => $this->integer()->notNull(),
            'url_images' => 'json',
        ]);
        $this->createIndex(
            '{{%idx-products-category_id}}',
            '{{%products}}',
            'category_id'
        );
        $this->addForeignKey(
            '{{%fk-products-category_id}}',
            '{{%products}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-products-sub_category_id}}',
            '{{%products}}',
            'sub_category_id'
        );
        $this->addForeignKey(
            '{{%fk-products-sub_category_id}}',
            '{{%products}}',
            'sub_category_id',
            '{{%sub_categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-products-sub_category_id}}',
            '{{%products}}'
        );
        $this->dropForeignKey(
            '{{%fk-products-category_id}}',
            '{{%products}}'
        );

        $this->dropIndex(
            '{{%idx-products-sub_category_id}}',
            '{{%products}}'
        );
        $this->dropIndex(
            '{{%idx-products-category_id}}',
            '{{%products}}'
        );

        $this->dropTable('{{%products}}');
    }
}
