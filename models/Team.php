<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $name
 * @property int $division_id
 *
 * @property Division $division
 */
class Team extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'division_id'], 'required'],
            [['division_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => Division::class, 'targetAttribute' => ['division_id' => 'id']],
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
            'division_id' => 'Division ID',
        ];
    }

    /**
     * Gets query for [[Division]].
     *
     * @return ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::class, ['id' => 'division_id']);
    }
}
