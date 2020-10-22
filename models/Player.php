<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "player".
 *
 * @property int $id
 * @property string $name
 * @property string $from
 * @property float $height
 * @property float $weight
 * @property string $born_at
 * @property string $drafted_at
 * @property int $team_id
 *
 * @property Team $team
 */
class Player extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'from', 'height', 'weight', 'born_at', 'drafted_at', 'team_id'], 'required'],
            [['height', 'weight'], 'number'],
            [['born_at', 'drafted_at'], 'safe'],
            [['team_id'], 'integer'],
            [['name', 'from'], 'string', 'max' => 100],
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
            'from' => 'From',
            'height' => 'Height',
            'weight' => 'Weight',
            'born_at' => 'Born At',
            'drafted_at' => 'Drafted At',
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
