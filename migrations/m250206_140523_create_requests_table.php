<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m250206_140523_create_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('requests', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Имя пользователя'),
            'email' => $this->string()->notNull()->comment('Email пользователя'),
            'status' => $this->string()->defaultValue('Active')->comment('Статус'),
            'message' => $this->text()->notNull()->comment('Сообщение пользователя'),
            'comment' => $this->text()->comment('Ответ ответственного лица'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Время создания заявки'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Время изменения заявки'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('requests');
    }
}
