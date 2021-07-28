<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faldone_immagine".
 *
 * @property int $faldone_id
 * @property int $immagine_id
 *
 * @property Immagine $immagine
 * @property Faldone $faldone
 */
class FaldoneImmagine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faldone_immagine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faldone_id', 'immagine_id'], 'required'],
            [['faldone_id', 'immagine_id'], 'integer'],
            [['faldone_id', 'immagine_id'], 'unique', 'targetAttribute' => ['faldone_id', 'immagine_id']],
            [['immagine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immagine::className(), 'targetAttribute' => ['immagine_id' => 'id']],
            [['faldone_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faldone::className(), 'targetAttribute' => ['faldone_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'faldone_id' => 'Faldone ID',
            'immagine_id' => 'Immagine ID',
        ];
    }

    /**
     * Gets query for [[Immagine]].
     *
     * @return \yii\db\ActiveQuery|ImmagineQuery
     */
    public function getImmagine()
    {
        return $this->hasOne(Immagine::className(), ['id' => 'immagine_id']);
    }

    /**
     * Gets query for [[Faldone]].
     *
     * @return \yii\db\ActiveQuery|FaldoneQuery
     */
    public function getFaldone()
    {
        return $this->hasOne(Faldone::className(), ['id' => 'faldone_id']);
    }

    /**
     * {@inheritdoc}
     * @return FaldoneImmagineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaldoneImmagineQuery(get_called_class());
    }
}
