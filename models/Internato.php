<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internato".
 *
 * @property int $id
 * @property int $anagrafica_id
 * @property int|null $provenienza_da_id
 * @property int|null $provienza_da_campo_id
 * @property string|null $matricola
 * @property string|null $data_arrivo
 * @property string|null $data_uscita
 *
 * @property DocumentoInternato[] $documentoInternatos
 * @property Documento[] $documentos
 * @property Comune $provenienzaDa
 * @property Campo $provienzaDaCampo
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
            [['anagrafica_id', 'provenienza_da_id', 'provienza_da_campo_id'], 'integer'],
            [['data_arrivo', 'data_uscita'], 'safe'],
            [['matricola'], 'string', 'max' => 255],
            [['anagrafica_id'], 'unique'],
            [['provenienza_da_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comune::className(), 'targetAttribute' => ['provenienza_da_id' => 'id']],
            [['provienza_da_campo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Campo::className(), 'targetAttribute' => ['provienza_da_campo_id' => 'id']],
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
            'provenienza_da_id' => 'Provenienza Da ID',
            'provienza_da_campo_id' => 'Provienza Da Campo ID',
            'matricola' => 'Matricola',
            'data_arrivo' => 'Data Arrivo',
            'data_uscita' => 'Data Uscita',
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
     * Gets query for [[ProvenienzaDa]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getProvenienzaDa()
    {
        return $this->hasOne(Comune::className(), ['id' => 'provenienza_da_id']);
    }

    /**
     * Gets query for [[ProvienzaDaCampo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\CampoQuery
     */
    public function getProvienzaDaCampo()
    {
        return $this->hasOne(Campo::className(), ['id' => 'provienza_da_campo_id']);
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
