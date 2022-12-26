<?php

use app\models\User;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%publication}}`.
 */
class m221223_194840_create_publication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publication}}', [
            'id'          => $this->primaryKey()->unsigned(),
            'author_id'   => $this->integer()->unsigned(),
            'description' => $this->string(),
            'text'        => $this->text(),
        ]);

        $this->createIndex(
            '{{%idx-publication-author_id}}',
            '{{%publication}}',
            'author_id'
        );

        $this->addForeignKey(
            '{{%fk-publication-author_id}}',
            '{{%publication}}',
            'author_id',
            '{{%user}}',
            'id'
        );

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
        $this->dropForeignKey('{{%fk-publication-author_id}}', '{{%publication}}');
        $this->dropIndex('{{%idx-publication-author_id}}', '{{%publication}}');

        $this->dropTable('{{%publication}}');
    }
}
