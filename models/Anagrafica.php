<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anagrafica".
 *
 * @property int $id
 * @property int|null $nato_a_id
 * @property int|null $morto_a_id
 * @property string $cognome
 * @property string|null $nome
 * @property string|null $nato_il
 * @property string|null $morto_il
 * @property string|null $secondo_nome
 * @property int|null $morto_shoah
 *
 * @property Comune $natoA
 * @property Comune $mortoA
 * @property Destinatari[] $destinataris
 * @property Documento[] $documentos
 * @property Incopia[] $incopias
 * @property Documento[] $documentos0
 * @property Interessati[] $interessatis
 * @property Documento[] $documentos1
 * @property Internato $internato
 * @property Mittenti[] $mittentis
 * @property Documento[] $documentos2
 */
class Anagrafica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anagrafica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nato_a_id', 'morto_a_id', 'morto_shoah'], 'integer'],
            [['cognome'], 'required'],
            [['nato_il', 'morto_il'], 'safe'],
            [['cognome', 'nome', 'secondo_nome'], 'string', 'max' => 255],
            [['nato_a_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comune::className(), 'targetAttribute' => ['nato_a_id' => 'id']],
            [['morto_a_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comune::className(), 'targetAttribute' => ['morto_a_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nato_a_id' => 'Nato A ID',
            'morto_a_id' => 'Morto A ID',
            'cognome' => 'Cognome',
            'nome' => 'Nome',
            'nato_il' => 'Nato Il',
            'morto_il' => 'Morto Il',
            'secondo_nome' => 'Secondo Nome',
            'morto_shoah' => 'Morto Shoah',
        ];
    }

    /**
     * Gets query for [[NatoA]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getNatoA()
    {
        return $this->hasOne(Comune::className(), ['id' => 'nato_a_id']);
    }

    /**
     * Gets query for [[MortoA]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getMortoA()
    {
        return $this->hasOne(Comune::className(), ['id' => 'morto_a_id']);
    }

    /**
     * Gets query for [[Destinataris]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DestinatariQuery
     */
    public function getDestinataris()
    {
        return $this->hasMany(Destinatari::className(), ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['id' => 'documento_id'])->viaTable('destinatari', ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Incopias]].
     *
     * @return \yii\db\ActiveQuery|\app\query\IncopiaQuery
     */
    public function getIncopias()
    {
        return $this->hasMany(Incopia::className(), ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Documentos0]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos0()
    {
        return $this->hasMany(Documento::className(), ['id' => 'documento_id'])->viaTable('incopia', ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Interessatis]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InteressatiQuery
     */
    public function getInteressatis()
    {
        return $this->hasMany(Interessati::className(), ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Documentos1]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos1()
    {
        return $this->hasMany(Documento::className(), ['id' => 'documento_id'])->viaTable('interessati', ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Internato]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternato()
    {
        return $this->hasOne(Internato::className(), ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Mittentis]].
     *
     * @return \yii\db\ActiveQuery|\app\query\MittentiQuery
     */
    public function getMittentis()
    {
        return $this->hasMany(Mittenti::className(), ['anagrafica_id' => 'id']);
    }

    /**
     * Gets query for [[Documentos2]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos2()
    {
        return $this->hasMany(Documento::className(), ['id' => 'documento_id'])->viaTable('mittenti', ['anagrafica_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\AnagraficaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\AnagraficaQuery(get_called_class());
    }
}
