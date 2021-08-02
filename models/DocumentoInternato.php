<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento_internato".
 *
 * @property int $documento_id
 * @property int $internato_id
 *
 * @property Internato $internato
 * @property Documento $documento
 */
class DocumentoInternato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_internato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'internato_id'], 'required'],
            [['documento_id', 'internato_id'], 'integer'],
            [['documento_id', 'internato_id'], 'unique', 'targetAttribute' => ['documento_id', 'internato_id']],
            [['internato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Internato::className(), 'targetAttribute' => ['internato_id' => 'id']],
            [['documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['documento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'documento_id' => 'Documento ID',
            'internato_id' => 'Internato ID',
        ];
    }

    /**
     * Gets query for [[Internato]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternato()
    {
        return $this->hasOne(Internato::className(), ['id' => 'internato_id']);
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
     * {@inheritdoc}
     * @return \app\query\DocumentoInternatoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\DocumentoInternatoQuery(get_called_class());
    }
}
