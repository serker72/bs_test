<?php

use yii\db\Migration;

class m171115_101812_bst extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%antiagent_ads}}', [
            'id' => $this->primaryKey(),
            'ads_id' => $this->bigInteger()->notNull()->defaultValue(0),
            'ads_price' => 'DOUBLE(20,2) NOT NULL DEFAULT 0',
            'ads_img_link' => $this->string()->notNull()->defaultValue(''),
            'ads_header' => $this->string()->notNull()->defaultValue(''),
            'ads_link' => $this->string()->notNull()->defaultValue(''),
            'ads_text' => $this->text()->notNull()->defaultValue(''),
            'ads_owner' => $this->string()->notNull()->defaultValue(''),
            'ads_option_price' => 'DOUBLE(20,2) NOT NULL DEFAULT 0',
            'ads_option_owner' => $this->string()->notNull()->defaultValue(''),
            'ads_option_owner_phone' => $this->string()->notNull()->defaultValue(''),
            'ads_option_owner_email' => $this->string()->notNull()->defaultValue(''),
            'ads_option_dt_create' => $this->string()->notNull()->defaultValue(''),
            'ads_option_dt_last_update' => $this->string()->notNull()->defaultValue(''),
            'ads_option_views' => $this->string()->notNull()->defaultValue(''),
            'ads_option_district' => $this->string()->notNull()->defaultValue(''),
            'ads_option_address' => $this->string()->notNull()->defaultValue(''),
            'ads_option_apartment_area' => $this->string()->notNull()->defaultValue(''),
            'ads_option_floor' => $this->string()->notNull()->defaultValue(''),
            'ads_option_wall material' => $this->string()->notNull()->defaultValue(''),
            'ads_option_year built' => $this->string()->notNull()->defaultValue(''),
            'created_at' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
        ], $tableOptions);
    }

    public function down()
    {
        //echo "m161029_164852_mfb cannot be reverted.\n";
        //return false;
        
        // Шаг 1 - удаляем таблицы с дочерними записями
        
        // Шаг 2 - удаляем таблицы с родительскими записями
        $this->dropTable('{{%antiagent_ads}}');
        
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
