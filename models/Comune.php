<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comune".
 *
 * @property int $id
 * @property int $provincia_id
 * @property int $stato_id
 * @property string $nome
 *
 * @property Anagrafica[] $anagraficas
 * @property Anagrafica[] $anagraficas0
 * @property Campo[] $campos
 * @property Provincia $provincia
 * @property Stato $stato
 * @property Internato[] $internatos
 */
class Comune extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comune';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provincia_id', 'stato_id', 'nome'], 'required'],
            [['provincia_id', 'stato_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provincia_id' => 'id']],
            [['stato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stato::className(), 'targetAttribute' => ['stato_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provincia_id' => 'Provincia ID',
            'stato_id' => 'Stato ID',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Anagraficas]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas()
    {
        return $this->hasMany(Anagrafica::className(), ['nato_a_id' => 'id']);
    }

    /**
     * Gets query for [[Anagraficas0]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagraficas0()
    {
        return $this->hasMany(Anagrafica::className(), ['morto_a_id' => 'id']);
    }

    /**
     * Gets query for [[Campos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\CampoQuery
     */
    public function getCampos()
    {
        return $this->hasMany(Campo::className(), ['comune_id' => 'id']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ProvinciaQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provincia_id']);
    }

    /**
     * Gets query for [[Stato]].
     *
     * @return \yii\db\ActiveQuery|\app\query\StatoQuery
     */
    public function getStato()
    {
        return $this->hasOne(Stato::className(), ['id' => 'stato_id']);
    }

    /**
     * Gets query for [[Internatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternatos()
    {
        return $this->hasMany(Internato::className(), ['provenienza_da_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\ComuneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\ComuneQuery(get_called_class());
    }
}
