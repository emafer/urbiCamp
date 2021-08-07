<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "familiari".
 *
 * @property int $anagrafica_id
 * @property int $familiare_id
 * @property int $ruolo_id
 *
 * @property Anagrafica $anagrafica
 * @property Anagrafica $familiare
 * @property Ruolo $ruolo
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
            [['anagrafica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anagrafica::className(), 'targetAttribute' => ['anagrafica_id' => 'id']],
            [['familiare_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anagrafica::className(), 'targetAttribute' => ['familiare_id' => 'id']],
            [['ruolo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ruolo::className(), 'targetAttribute' => ['ruolo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anagrafica_id' => 'Anagrafica',
            'familiare_id' => 'Familiare',
            'ruolo_id' => 'Ruolo',
        ];
    }

    /**
     * Gets query for [[Anagrafica]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagrafica()
    {
        return $this->hasOne(Anagrafica::className(), ['id' => 'anagrafica_id']);
    }

    /**
     * Gets query for [[Familiare]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getFamiliare()
    {
        return $this->hasOne(Anagrafica::className(), ['id' => 'familiare_id']);
    }

    /**
     * Gets query for [[Ruolo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\RuoliQuery
     */
    public function getRuolo()
    {
        return $this->hasOne(Ruolo::className(), ['id' => 'ruolo_id']);
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
