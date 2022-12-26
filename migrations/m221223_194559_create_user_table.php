<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221223_194559_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'role' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0),
        ]);

        $this->insert('user', [
            'name'     => 'test',
            'email'    => 'test@test.ru',
            'password' => Yii::$app->security->generatePasswordHash('testtest'),
        ]);

        $this->insert('user', [
            'name'     => 'admin',
            'email'    => 'admin@admin.ru',
            'password' => Yii::$app->security->generatePasswordHash('adminadmin'),
            'role'     => User::USER_ROLE_ADMIN,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
