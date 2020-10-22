<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "manager".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $team_id
 *
 * @property Team $team
 */
class Manager extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'team_id'], 'required'],
            [['team_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::class, 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'team_id' => 'Team ID',
        ];
    }

    /**
     * Gets query for [[Team]].
     *
     * @return ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'team_id']);
    }
}
