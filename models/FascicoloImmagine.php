<?php

namespace app\models;

use app\query\FascicoloImmagineQuery;
use app\query\FascicoloQuery;
use app\query\ImmagineQuery;
use Yii;

/**
 * This is the model class for table "fascicolo_immagine".
 *
 * @property int $fascicolo_id
 * @property int $immagine_id
 * @property int $ordine
 *
 * @property Immagine $immagine
 * @property Fascicolo $fascicolo
 */
class FascicoloImmagine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fascicolo_immagine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fascicolo_id', 'immagine_id', 'ordine'], 'required'],
            [['fascicolo_id', 'immagine_id', 'ordine'], 'integer'],
            [['fascicolo_id', 'immagine_id'], 'unique', 'targetAttribute' => ['fascicolo_id', 'immagine_id']],
            [['immagine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immagine::class, 'targetAttribute' => ['immagine_id' => 'id']],
            [['fascicolo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fascicolo::class, 'targetAttribute' => ['fascicolo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fascicolo_id' => 'Fascicolo ID',
            'immagine_id' => 'Immagine ID',
            'ordine' => 'Ordinamento'
        ];
    }

    /**
     * Gets query for [[Immagine]].
     *
     * @return \yii\db\ActiveQuery|ImmagineQuery
     */
    public function getImmagine()
    {
        return $this->hasOne(Immagine::class, ['id' => 'immagine_id']);
    }

    /**
     * Gets query for [[Fascicolo]].
     *
     * @return \yii\db\ActiveQuery|FascicoloQuery
     */
    public function getFascicolo()
    {
        return $this->hasOne(Fascicolo::class, ['id' => 'fascicolo_id']);
    }

    /**
     * {@inheritdoc}
     * @return FascicoloImmagineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FascicoloImmagineQuery(get_called_class());
    }
}
