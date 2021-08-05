<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruoli".
 *
 * @property int $id
 * @property string $ruolo
 */
class Ruolo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ruoli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ruolo'], 'required'],
            [['ruolo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruolo' => 'Ruolo',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\query\RuoloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\RuoloQuery(get_called_class());
    }
}
