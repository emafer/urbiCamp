<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internato".
 *
 * @property int $id
 * @property int $anagrafica_id
 * @property int $autore
 * @property string $creato_il
 * @property int $modificato_da
 * @property string $modificato_il
 *
 * @property DocumentoInternato[] $documentoInternatos
 * @property Documento[] $documentos
 * @property FascicoloInternato[] $fascicoloInternatos
 * @property Fascicolo[] $fascicolos
 * @property InternatoCampo[] $internatoCampi;
 * @property Anagrafica $anagrafica
 */
class Internato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anagrafica_id'], 'required'],
            [['anagrafica_id', 'autore', 'modificato_da'], 'integer'],
            [['creato_il', 'modificato_il'], 'safe'],
            [['anagrafica_id'], 'unique'],
            [['anagrafica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anagrafica::className(), 'targetAttribute' => ['anagrafica_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anagrafica_id' => 'Anagrafica ID',
            'autore' => 'Autore',
            'creato_il' => 'Creato Il',
            'modificato_da' => 'Modificato Da',
            'modificato_il' => 'Modificato Il',
        ];
    }

    /**
     * Gets query for [[DocumentoInternatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoInternatoQuery
     */
    public function getDocumentoInternatos()
    {
        return $this->hasMany(DocumentoInternato::className(), ['internato_id' => 'id']);
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['id' => 'documento_id'])->viaTable('documento_internato', ['internato_id' => 'id']);
    }
    /**
     * Gets query for [[DocumentoInternatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoInternatoQuery
     */
    public function getInternatoCampi()
    {
        return $this->hasMany(InternatoCampo::class, ['internato_id' => 'id']);
    }

    /**
     * Gets query for [[Campi]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getCampi()
    {
        return $this->hasMany(Campo::class, ['id' => 'campo_id'])->viaTable('internato_campo', ['internato_id' => 'id'])
            ->orderBy(['data_arrivo' => SORT_DESC]);;
    }

    /**
     * Gets query for [[FascicoloInternatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FascicoloInternatoQuery
     */
    public function getFascicoloInternatos()
    {
        return $this->hasMany(FascicoloInternato::className(), ['internato_id' => 'id']);
    }

    /**
     * Gets query for [[Fascicolos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FascicoloQuery
     */
    public function getFascicolos()
    {
        return $this->hasMany(Fascicolo::className(), ['id' => 'fascicolo_id'])->viaTable('fascicolo_internato', ['internato_id' => 'id']);
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
     * @return \app\query\InternatoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\InternatoQuery(get_called_class());
    }
}
