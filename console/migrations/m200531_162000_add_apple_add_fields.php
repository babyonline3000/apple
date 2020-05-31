<?php

use \yii\db\Migration;

class m200531_162000_add_apple_add_fields extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%apple}}', 'fallen_at_and_five_clock', $this->integer()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%apple}}', 'fallen_at_and_five_clock');
    }
}
