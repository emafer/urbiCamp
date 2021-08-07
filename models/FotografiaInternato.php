<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotografia_internato".
 *
 * @property int $fotografia_id
 * @property int $internato_id
 */
class FotografiaInternato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotografia_internato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fotografia_id', 'internato_id'], 'required'],
            [['fotografia_id', 'internato_id'], 'integer'],
            [['fotografia_id', 'internato_id'], 'unique', 'targetAttribute' => ['fotografia_id', 'internato_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fotografia_id' => 'Fotografia ID',
            'internato_id' => 'Internato ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\query\FotografiaInternatoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\FotografiaInternatoQuery(get_called_class());
    }
}
