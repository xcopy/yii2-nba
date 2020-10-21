<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "conference".
 *
 * @property int $id
 * @property string $name
 *
 * @property Division[] $divisions
 */
class Conference extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conference';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * Gets query for [[Divisions]].
     *
     * @return ActiveQuery
     */
    public function getDivisions()
    {
        return $this->hasMany(Division::class, ['conference_id' => 'id']);
    }
}
