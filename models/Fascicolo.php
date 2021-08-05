<?php

namespace app\models;

use app\query\DocumentoQuery;
use app\query\FascicoloImmagineQuery;
use Yii;

use app\query\FaldoneQuery;
use app\query\FascicoloQuery;
use app\query\ImmagineQuery;
/**
 * This is the model class for table "fascicolo".
 *
 * @property int $id
 * @property int $faldone_id
 * @property string $descrizione
 * @property string|null $note
 *
 * @property Documento[] $documentos
 * @property Faldone $faldone
 * @property FascicoloImmagine[] $fascicoloImmagines
 * @property Immagine[] $immagines
 * @property FascicoloInternato[] $fascicoloInternati
 * @property Internato[] $internati
 */
class Fascicolo extends  UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fascicolo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faldone_id', 'descrizione'], 'required'],
            [['faldone_id'], 'integer'],
            [['descrizione', 'note'], 'string', 'max' => 255],
            [['faldone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faldone::class, 'targetAttribute' => ['faldone_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faldone.archivio.abbr' => 'Fondo',
            'faldone.classificazione' => 'Class.',
            'faldone.descrizione' => 'Faldone',
            'descrizione' => 'Descrizione',
            'note' => 'Note',
        ];
    }

    /**
     * Gets query for [[Documentos]].
     *
     * @return \yii\db\ActiveQuery|DocumentoQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::class, ['fascicolo_id' => 'id']);
    }

    /**
     * Gets query for [[Faldone]].
     *
     * @return \yii\db\ActiveQuery|FaldoneQuery
     */
    public function getFaldone()
    {
        return $this->hasOne(Faldone::class, ['id' => 'faldone_id']);
    }

    /**
     * Gets query for [[FascicoloImmagines]].
     *
     * @return \yii\db\ActiveQuery|FascicoloImmagineQuery
     */
    public function getFascicoloImmagines()
    {
        return $this->hasMany(FascicoloImmagine::class, ['fascicolo_id' => 'id']);
    }

    /**
     * Gets query for [[Immagines]].
     *
     * @return \yii\db\ActiveQuery|ImmagineQuery
     */
    public function getImmagines()
    {
        return $this->hasMany(Immagine::class, ['id' => 'immagine_id'])->viaTable('fascicolo_immagine', ['fascicolo_id' => 'id']);
    }



    /**
     * Gets query for [[FascicoloInternati]].
     *
     * @return \yii\db\ActiveQuery|FascicoloImmagineQuery
     */
    public function getFascicoloInternati()
    {
        return $this->hasMany(FascicoloInternato::class, ['fascicolo_id' => 'id']);
    }

    /**
     * Gets query for [[Internati]].
     *
     * @return \yii\db\ActiveQuery|ImmagineQuery
     */
    public function getInternati()
    {
        return $this->hasMany(Internato::class, ['id' => 'internato_id'])->viaTable('fascicolo_internato', ['fascicolo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FascicoloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FascicoloQuery(get_called_class());
    }

    public function getNomeCompleto() {
        return $this->faldone->getNomeCompleto() . " " . substr($this->descrizione, 0, 50);
    }
}
