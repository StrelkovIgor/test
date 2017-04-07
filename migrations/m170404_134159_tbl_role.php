<?php

use yii\db\Migration;

class m170404_134159_tbl_role extends Migration
{
    public function up()
    {
        $this->createTable('tbl_role', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()

        ]);
    }

    public function down()
    {
        echo "m170404_134159_tbl_role cannot be reverted.\n";
        $this->dropTable('tbl_role');
        return false;
    }

    
    // Use safeUp/safeDown to run migration code within a transaction
  /*  public function safeUp()
    {
        
    }

    public function safeDown()
    {
        
    }
    */
}
