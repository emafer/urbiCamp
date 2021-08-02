<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mittenti".
 *
 * @property int $documento_id
 * @property int $anagrafica_id
 *
 * @property Documento $documento
 * @property Anagrafica $anagrafica
 */
class Mittenti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mittenti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'anagrafica_id'], 'required'],
            [['documento_id', 'anagrafica_id'], 'integer'],
            [['documento_id', 'anagrafica_id'], 'unique', 'targetAttribute' => ['documento_id', 'anagrafica_id']],
            [['documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['documento_id' => 'id']],
            [['anagrafica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anagrafica::className(), 'targetAttribute' => ['anagrafica_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'documento_id' => 'Documento ID',
            'anagrafica_id' => 'Anagrafica ID',
        ];
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::className(), ['id' => 'documento_id']);
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
     * {@inheritdoc}
     * @return \app\query\MittentiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\MittentiQuery(get_called_class());
    }
}
