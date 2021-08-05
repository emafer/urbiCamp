<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internato_campo".
 *
 * @property int $internato_id
 * @property int|null $provenienza_da_id
 * @property int|null $provenienza_da_campo_id
 * @property string|null $matricola
 * @property string|null $data_arrivo
 * @property string|null $data_uscita
 * @property int|null $campo_id
 *
 * @property Campo $campo
 */
class InternatoCampo extends UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internato_campo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provenienza_da_id', 'provenienza_da_campo_id', 'campo_id', 'autore', 'modificato_da'], 'integer'],
            [['data_arrivo', 'data_uscita', 'creato_il', 'modificato_il'], 'safe'],
            [['matricola'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'internato_id' => 'Internato ID',
            'provenienza_da_id' => 'Provenienza Da Comune',
            'provenienza_da_campo_id' => 'Provenienza Da Campo',
            'matricola' => 'Matricola',
            'data_arrivo' => 'Data Arrivo',
            'data_uscita' => 'Data Uscita',
            'campo_id' => 'Campo',
            'autore' => 'Autore',
            'creato_il' => 'Creato Il',
            'modificato_da' => 'Modificato Da',
            'modificato_il' => 'Modificato Il',
        ];
    }

    /**
     * Gets query for [[campo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\CampoQuery
     */
    public function getCampo()
    {
        return $this->hasOne(Campo::class, ['id' => 'campo_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\InternatoCampoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\InternatoCampoQuery(get_called_class());
    }
}
