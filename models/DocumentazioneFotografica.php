<?php

namespace app\models;

use Yii;
use yii\web\User;

/**
 * This is the model class for table "fotografia".
 *
 * @property int $id
 * @property int $fascicolo_id
 * @property string $data
 * @property int $data_fittizia
 * @property int|null $documento_di_riferimento_id
 * @property string|null $note
 * @property string|null $descrizione
 * @property string|null $descrizione_en
 * @property int|null $nota_matita
 * @property string|null $testoNotaMatita
 * @property int $immagine_id
 * @property int $campo_id
 *
 * @property Immagine $immagine
 * @property Internato[] $internati
 * @property Anagrafica[] $interessati
 * @property Fascicolo $fascicolo
 * @property Documento $documento
 * @property Campo $campo
 */
class DocumentazioneFotografica extends UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotografia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fascicolo_id', 'data', 'data_fittizia', 'campo_id', 'immagine_id'], 'required'],
            [['fascicolo_id', 'data_fittizia', 'documento_di_riferimento_id', 'nota_matita', 'immagine_id', 'autore', 'modificato_da'], 'integer'],
            [['data', 'creato_il', 'modificato_il', 'campo_id'], 'safe'],
            [['note', 'descrizione', 'descrizione_en', 'testoNotaMatita'], 'string'],
           [['immagine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immagine::className(), 'targetAttribute' => ['immagine_id' => 'id']],
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
            'data' => 'Data',
            'data_fittizia' => 'Data Fittizia',
            'documento_di_riferimento_id' => 'Documento Di Riferimento ID',
            'note' => 'Note',
            'descrizione' => 'Descrizione',
            'descrizione_en' => 'Descrizione En',
            'nota_matita' => 'Nota Matita',
            'testoNotaMatita' => 'Testo Nota Matita',
            'immagine_id' => 'Immagine ID',
            'autore' => 'Autore',
            'creato_il' => 'Creato Il',
            'modificato_da' => 'Modificato Da',
            'modificato_il' => 'Modificato Il',
        ];
    }


    /**
     * Gets query for [[Immagine]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ImmagineQuery
     */
    public function getImmagine()
    {
        return $this->hasOne(Immagine::className(), ['id' => 'immagine_id']);
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::className(), ['id' => 'documento_di_riferimento_id']);
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
     * {@inheritdoc}
     * @return \app\query\FotografiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\FotografiaQuery(get_called_class());
    }

    /**
     * Gets query for [[Anagraficas1]].
     *
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getInteressati()
    {
        return $this->hasMany(Anagrafica::class, ['id' => 'anagrafica_id'])->viaTable('fotografia_anagrafica', ['fotografia_id' => 'id']);
    }

    /**
     * Gets query for [[Internati]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternati()
    {
        return $this->hasMany(Internato::class, ['id' => 'internato_id'])->viaTable('fotografia_internato', ['fotografia_id' => 'id']);
    }

}
