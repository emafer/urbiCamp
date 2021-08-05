<?php

namespace app\models;

use app\query\ArchivioQuery;
use app\query\FaldoneQuery;
use Yii;

/**
 * This is the model class for table "archivio".
 *
 * @property int $id
 * @property string $descrizione
 * @property string $abbr
 *
 * @property Faldone[] $faldones
 */
class Archivio extends  UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descrizione', 'abbr'], 'required'],
            [['descrizione'], 'string', 'max' => 255],
            [['abbr'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descrizione' => 'Descrizione',
            'abbr' => 'Abbr',
        ];
    }

    /**
     * Gets query for [[Faldones]].
     *
     * @return \yii\db\ActiveQuery|FaldoneQuery
     */
    public function getFaldones()
    {
        return $this->hasMany(Faldone::class, ['archivio_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ArchivioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArchivioQuery(get_called_class());
    }
}
