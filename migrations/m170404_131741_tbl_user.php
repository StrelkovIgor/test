<?php

use yii\db\Migration;

class m170404_131741_tbl_user extends Migration
{
    public function up()
    {
         $this->createTable('tbl_user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(), 
            'role_id' => $this->integer(1)->defaultValue(0)

        ]);
    }

    public function down()
    {
        echo "m170404_131741_tbl_user cannot be reverted.\n";
        $this->dropTable('post');
        return false;
    }

   
    // Use safeUp/safeDown to run migration code within a transaction
   /* public function safeUp()
    {
       
    }

    public function safeDown()
    {
        
    }
    */
}
