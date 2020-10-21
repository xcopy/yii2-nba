<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "division".
 *
 * @property int $id
 * @property string $name
 * @property int $conference_id
 *
 * @property Conference $conference
 * @property Team[] $teams
 */
class Division extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'division';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'conference_id'], 'required'],
            [['conference_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['conference_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conference::class, 'targetAttribute' => ['conference_id' => 'id']],
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
            'conference_id' => 'Conference ID',
        ];
    }

    /**
     * Gets query for [[Conference]].
     *
     * @return ActiveQuery
     */
    public function getConference()
    {
        return $this->hasOne(Conference::class, ['id' => 'conference_id']);
    }

    /**
     * Gets query for [[Teams]].
     *
     * @return ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::class, ['division_id' => 'id']);
    }
}
