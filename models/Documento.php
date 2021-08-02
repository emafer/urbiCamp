<?php

namespace app\models;

use app\query\DocumentoImmagineQuery;
use app\query\ImmagineQuery;
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
 * @property Tipologia|null $tipologia
 * @property string $note
 * @property string $protocollo
 * @property string $descrizione
 * @property string $descrizione_en
 *
 * @property Destinatari[] $destinatari
 * @property Anagrafica[] $inCopia
 * @property Documento $documentoDiRiferimento
 * @property Documento[] $documentos
 * @property Fascicolo $fascicolo
 * @property DocumentoInternato[] $documentoInternati
 * @property Internato[] $internati
 * @property Anagrafica[] $incopias
 * @property Anagrafica[] $anagraficas0
 * @property Anagrafica[] $interessati
 * @property Anagrafica[] $anagraficas1
 * @property Anagrafica[] $mittenti
 * @property Anagrafica[] $anagraficas2
 * @property DocumentoImmagine[] $documentoImmagini
 * @property Immagine[] $immagini
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
            [['fascicolo_id', 'oggetto', 'data', 'data_fittizia', 'tipologia_id'], 'required'],
            [['fascicolo_id', 'data_fittizia', 'documento_di_riferimento_id'], 'integer'],
            [['data', 'note', 'protocollo', 'descrizione', 'descrizione_en'], 'safe'],
            [['oggetto'], 'string', 'max' => 255],
            [['documento_di_riferimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['documento_di_riferimento_id' => 'id']],
            [['fascicolo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fascicolo::class, 'targetAttribute' => ['fascicolo_id' => 'id']],
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
            'fascicolo.nomeCompleto' => 'Fascicolo',
            'oggetto' => 'Oggetto',
            'tipologia_id' => 'Tipologia',
            'data' => 'Data',
            'data_fittizia' => 'Data Fittizia',
            'note' => 'Note',
            'descrizione_en' => 'English description',
            'documento_di_riferimento_id' => 'Documento Di Riferimento ID',
            'printDataFittizia' => ' DataFittizia?',
            'nomeMittenti' => 'Mittenti',
            'nomeDestinatari' => 'destinatari',
            'nomeInteressati' => ' interessati',
        ];
    }

    /**
     * Gets query for [[Anagraficas]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getDestinatari()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('destinatari', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentoDiRiferimento]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentoDiRiferimento()
    {
        return $this->hasOne(Documento::class, ['id' => 'documento_di_riferimento_id']);
    }
    /**
     * Gets query for [[Tipologia]].
     *
     * @return \yii\db\ActiveQuery|\app\query\TipologiaQuery
     */
    public function getTipologia()
    {
        return $this->hasOne(Tipologia::class, ['id' => 'tipologia_id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::class, ['documento_di_riferimento_id' => 'id']);
    }

    /**
     * Gets query for [[Fascicolo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FascicoloQuery
     */
    public function getFascicolo()
    {
        return $this->hasOne(Fascicolo::class, ['id' => 'fascicolo_id']);
    }

    /**
     * Gets query for [[nternatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoInternatoQuery
     */
    public function getDocumentoInternati()
    {
        return $this->hasMany(DocumentoInternato::class, ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Internati]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternati()
    {
        return $this->hasMany(Internato::class, ['id' => 'internato_id'])->viaTable('documento_internato', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Incopias]].
     *
     * @return \yii\db\ActiveQuery|\app\query\IncopiaQuery
     */
    public function getIncopias()
    {
        return $this->hasMany(Incopia::class, ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[inCopia]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getInCopia()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('incopia', ['documento_id' => 'id']);
    }


    /**
     * Gets query for [[Anagraficas1]].
     *
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getInteressati()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('interessati', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Mittenti]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getMittenti()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('mittenti', ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas2]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas2()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('mittenti', ['documento_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\DocumentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\DocumentoQuery(get_called_class());
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
    public function getPrintDataFittizia()
    {
        if ($this->data_fittizia>0) {
            return 'SI';
        }

        return 'NO';
    }
    public function getNomeDestinatari()
    {
        $txt = [];
        foreach ($this->destinatari as $dest){
            $txt[] = $dest->getNomeCompleto();
        }
        return implode(", ", $txt);
    }
    public function getNomeInteressati()
    {
        $txt = [];
        foreach ($this->interessati as $dest){
            $txt[] = $dest->getNomeCompleto();
        }
        return implode(", ", $txt);
    }
    public function getNomeMittenti()
    {
        $txt = [];
       
        foreach ($this->mittenti as $dest){
            $txt[] = $dest->getNomeCompleto();
        }
        return implode(", ", $txt);
    }

    /**
     * Gets query for [[DocumentoImmagine]].
     *
     * @return \yii\db\ActiveQuery|DocumentoImmagineQuery
     */
    public function getDocumentoImmagini()
    {
        return $this->hasMany(DocumentoImmagine::class, ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Immagini]].
     *
     * @return \yii\db\ActiveQuery|ImmagineQuery
     */
    public function getImmagini()
    {
        return $this->hasMany(Immagine::class, ['id' => 'immagine_id'])->viaTable('documento_immagine', ['documento_id' => 'id']);
    }

    public function setInternati($array) {
            $this->internati = $array;
    }
}
