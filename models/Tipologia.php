<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipologia".
 *
 * @property int $id
 * @property string $descrizione
 * @property string $abbr
 */
class Tipologia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipologia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descrizione', 'abbr'], 'required'],
            [['descrizione'], 'string', 'max' => 255],
            [['abbr'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descrizione' => 'Descrizione',
            'abbr' => 'Abbr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\query\TipologiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\TipologiaQuery(get_called_class());
    }
}
