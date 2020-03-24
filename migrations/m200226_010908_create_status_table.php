<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m200226_010908_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$tableOptions = null;
		if($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
			'message' => Schema::TYPE_TEXT.' NOT NULL',
			'permissions' => Schema::TYPE_SMALLINT . ' NOT NULL',
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
