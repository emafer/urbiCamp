<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $id
 * @property string $nome
 * @property string $regione
 * @property string $sigla
 *
 * @property Comune[] $comunes
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'regione', 'sigla'], 'required'],
            [['nome', 'regione'], 'string', 'max' => 255],
            [['sigla'], 'string', 'max' => 2],
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
            'regione' => 'Regione',
            'sigla' => 'Sigla',
        ];
    }

    /**
     * Gets query for [[Comunes]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getComunes()
    {
        return $this->hasMany(Comune::className(), ['provincia_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\ProvinciaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\ProvinciaQuery(get_called_class());
    }
}
