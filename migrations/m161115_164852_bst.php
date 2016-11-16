<?php

use yii\db\Migration;

class m161115_164852_bst extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%claim}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string()->notNull()->defaultValue(''),
            'text' => $this->text()->notNull()->defaultValue(''),
            'created_at' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ], $tableOptions);
    }

    public function down()
    {
        //echo "m161029_164852_mfb cannot be reverted.\n";
        //return false;
        
        // Шаг 1 - удаляем таблицы с дочерними записями
        
        // Шаг 2 - удаляем таблицы с родительскими записями
        $this->dropTable('{{%claim}}');
        
        // Шаг 3 - удаляем несвязанные таблицы
        //$this->dropTable('{{%ksk_tags}}');
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
