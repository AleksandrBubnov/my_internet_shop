<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sub_categories}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 */
class m210930_101304_create_sub_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sub_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-sub_categories-category_id}}',
            '{{%sub_categories}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-sub_categories-category_id}}',
            '{{%sub_categories}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-sub_categories-category_id}}',
            '{{%sub_categories}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-sub_categories-category_id}}',
            '{{%sub_categories}}'
        );

        $this->dropTable('{{%sub_categories}}');
    }
}
