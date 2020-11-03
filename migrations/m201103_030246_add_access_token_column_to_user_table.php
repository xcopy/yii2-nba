<?php

use yii\db\Migration;
use yii\base\Exception;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m201103_030246_add_access_token_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'access_token', $this->string()->defaultValue(null));

        $this->createIndex(
            'access_token',
            '{{%user}}',
            'access_token',
            true
        );

        try {
            $columns = [
                'username' => 'admin',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'email' => 'admin@example.com',
                'created_at' => time(),
                'updated_at' => time()
            ];

            foreach (['password_reset_token', 'verification_token', 'access_token'] as $key) {
                $columns[$key] = Yii::$app->security->generateRandomString();
            }

            $this->insert('{{%user}}', $columns);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function down()
    {
        $this->truncateTable('{{%user}}');

        $this->dropIndex('access_token', '{{%user}}');

        $this->dropColumn('{{%user}}', 'access_token');
    }
}
