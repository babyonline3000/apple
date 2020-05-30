<?php

use \yii\db\Migration;

class m200530_213700_add_apple extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'volume' => $this->tinyInteger()->notNull()->defaultValue(100),
            'status' => $this->tinyInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'fallen_at' => $this->integer()->null(),
        ], $tableOptions);
        $this->createIndex('idx_status', '{{%apple}}', 'status');

        $array = [];
        $count = rand(10,30);
        for($i=1;$i<=$count;$i++){
            $array[] = [
                'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')',date('U')
            ];
        }
        $this->batchInsert('{{%apple}}', ['color','created_at'], $array);
    }

    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
