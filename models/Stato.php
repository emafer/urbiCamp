<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stato".
 *
 * @property int $id
 * @property string $nome
 * @property string $nome_pulito
 * @property string $cittadinanza
 *
 * @property Comune[] $comunes
 */
class Stato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nome_pulito', 'cittadinanza'], 'required'],
            [['nome', 'nome_pulito', 'cittadinanza'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'nome_pulito' => 'Nome Pulito',
            'cittadinanza' => 'Cittadinanza',
        ];
    }

    /**
     * Gets query for [[Comunes]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getComunes()
    {
        return $this->hasMany(Comune::className(), ['stato_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\StatoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\StatoQuery(get_called_class());
    }
}
