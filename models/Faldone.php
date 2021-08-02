<?php

namespace app\models;

use app\query\ArchivioQuery;
use app\query\FaldoneImmagineQuery;
use app\query\FaldoneQuery;
use app\query\FascicoloQuery;
use app\query\ImmagineQuery;
use Yii;

/**
 * This is the model class for table "faldone".
 *
 * @property int $id
 * @property int $archivio_id
 * @property string $descrizione
 * @property string|null $note
 * @property string $classificazione
 *
 * @property Archivio $archivio
 * @property FaldoneImmagine[] $faldoneImmagines
 * @property Immagine[] $immagines
 * @property Fascicolo[] $fascicolos
 */
class Faldone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faldone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archivio_id', 'descrizione', 'classificazione'], 'required'],
            [['archivio_id'], 'integer'],
            [['descrizione', 'note'], 'string', 'max' => 255],
            [['classificazione'], 'string', 'max' => 15],
            [['archivio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archivio::class, 'targetAttribute' => ['archivio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'archivio_id' =>'Fondo',
            'archivio.abbr' => 'Fondo',
            'descrizione' => 'Descrizione',
            'note' => 'Note',
            'classificazione' => 'Classificazione',
        ];
    }

    /**
     * Gets query for [[Archivio]].
     *
     * @return \yii\db\ActiveQuery|ArchivioQuery
     */
    public function getArchivio()
    {
        return $this->hasOne(Archivio::class, ['id' => 'archivio_id']);
    }

    public function getArchivioModel()
    {
        return $this->hasOne(Archivio::class, ['id' => 'archivio_id'])->one();
    }
    /**
     * Gets query for [[Immagine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmagini()
    {
        return $this
            ->hasMany(
                Immagine::class,
                ['id' => 'immagine_id']
            )
            ->viaTable(
                'faldone_immagine',
                ['faldone_id' => 'id']
            );
    }

    /**
     * Gets query for [[Fascicolos]].
     *
     * @return \yii\db\ActiveQuery|FascicoloQuery
     */
    public function getFascicoli()
    {
        return $this->hasMany(Fascicolo::class, ['faldone_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FaldoneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaldoneQuery(get_called_class());
    }

    public function getNomeCompleto():string
    {
        return ($this->archivio->abbr . " - " . $this->classificazione);
    }
}
