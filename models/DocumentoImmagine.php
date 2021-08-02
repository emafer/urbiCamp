<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento_immagine".
 *
 * @property int $documento_id
 * @property int $immagine_id
 * @property int $ordine
 *
 * @property Documento $documento
 * @property Immagine $immagine
 */
class DocumentoImmagine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_immagine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'immagine_id', 'ordine'], 'required'],
            [['documento_id', 'immagine_id', 'ordine'], 'integer'],
            [['documento_id', 'immagine_id'], 'unique', 'targetAttribute' => ['documento_id', 'immagine_id']],
            [['documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['documento_id' => 'id']],
            [['immagine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immagine::className(), 'targetAttribute' => ['immagine_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'documento_id' => 'Documento ID',
            'immagine_id' => 'Immagine ID',
            'ordine' => 'Ordine',
        ];
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery|\app\query\DocumentoQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::className(), ['id' => 'documento_id']);
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
     * {@inheritdoc}
     * @return \app\query\DocumentoImmagineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\DocumentoImmagineQuery(get_called_class());
    }
}
