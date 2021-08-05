<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "familiari".
 *
 * @property int $anagrafica_id
 * @property int $familiare_id
 * @property int $ruolo_id
 */
class Familiare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'familiari';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anagrafica_id', 'familiare_id', 'ruolo_id'], 'required'],
            [['anagrafica_id', 'familiare_id', 'ruolo_id'], 'integer'],
            [['anagrafica_id', 'familiare_id'], 'unique', 'targetAttribute' => ['anagrafica_id', 'familiare_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anagrafica_id' => 'Anagrafica ID',
            'familiare_id' => 'Familiare ID',
            'ruolo_id' => 'Ruolo ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\query\FamiliariQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\FamiliariQuery(get_called_class());
    }
}
