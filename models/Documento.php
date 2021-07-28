<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property int $id
 * @property int $fascicolo_id
 * @property string $oggetto
 * @property string $data
 * @property int $data_fittizia
 * @property int|null $documento_di_riferimento_id
 *
 * @property Destinatari[] $destinataris
 * @property Anagrafica[] $anagraficas
 * @property Documento $documentoDiRiferimento
 * @property Documento[] $documentos
 * @property Fascicolo $fascicolo
 * @property DocumentoInternato[] $documentoInternatos
 * @property Internato[] $internatos
 * @property Incopia[] $incopias
 * @property Anagrafica[] $anagraficas0
 * @property Interessati[] $interessatis
 * @property Anagrafica[] $anagraficas1
 * @property Mittenti[] $mittentis
 * @property Anagrafica[] $anagraficas2
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fascicolo_id', 'oggetto', 'data', 'data_fittizia'], 'required'],
            [['fascicolo_id', 'data_fittizia', 'documento_di_riferimento_id'], 'integer'],
            [['data'], 'safe'],
            [['oggetto'], 'string', 'max' => 255],
            [['documento_di_riferimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['documento_di_riferimento_id' => 'id']],
            [['fascicolo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fascicolo::className(), 'targetAttribute' => ['fascicolo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fascicolo_id' => 'Fascicolo ID',
            'oggetto' => 'Oggetto',
            'data' => 'Data',
            'data_fittizia' => 'Data Fittizia',
            'documento_di_riferimento_id' => 'Documento Di Riferimento ID',
        ];
    }

    /**
     * Gets query for [[Destinataris]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DestinatariQuery
     */
    public function getDestinataris()
    {
        return $this->hasMany(Destinatari::className(), ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas()
    {
        return $this->hasMany(Anagrafica::className(), ['id' => 'anagrafica_id'])->viaTable('destinatari', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentoDiRiferimento]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentoDiRiferimento()
    {
        return $this->hasOne(Documento::className(), ['id' => 'documento_di_riferimento_id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['documento_di_riferimento_id' => 'id']);
    }

    /**
     * Gets query for [[Fascicolo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FascicoloQuery
     */
    public function getFascicolo()
    {
        return $this->hasOne(Fascicolo::className(), ['id' => 'fascicolo_id']);
    }

    /**
     * Gets query for [[DocumentoInternatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoInternatoQuery
     */
    public function getDocumentoInternatos()
    {
        return $this->hasMany(DocumentoInternato::className(), ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Internatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternatos()
    {
        return $this->hasMany(Internato::className(), ['id' => 'internato_id'])->viaTable('documento_internato', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Incopias]].
     *
     * @return \yii\db\ActiveQuery|\app\query\IncopiaQuery
     */
    public function getIncopias()
    {
        return $this->hasMany(Incopia::className(), ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas0]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas0()
    {
        return $this->hasMany(Anagrafica::className(), ['id' => 'anagrafica_id'])->viaTable('incopia', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Interessatis]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InteressatiQuery
     */
    public function getInteressatis()
    {
        return $this->hasMany(Interessati::className(), ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas1]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas1()
    {
        return $this->hasMany(Anagrafica::className(), ['id' => 'anagrafica_id'])->viaTable('interessati', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Mittentis]].
     *
     * @return \yii\db\ActiveQuery|\app\query\MittentiQuery
     */
    public function getMittentis()
    {
        return $this->hasMany(Mittenti::className(), ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas2]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas2()
    {
        return $this->hasMany(Anagrafica::className(), ['id' => 'anagrafica_id'])->viaTable('mittenti', ['documento_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\DocumentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\DocumentoQuery(get_called_class());
    }
}
