<?php

namespace app\models;

use app\query\CampoQuery;
use Yii;

/**
 * This is the model class for table "campo".
 *
 * @property int $id
 * @property int $comune_id
 * @property int $tipo
 * @property string $nome
 * @property string|null $data_creazione
 *
 * @property Comune $comune
 * @property Internato[] $internatos
 */
class Campo extends UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comune_id', 'nome'], 'required'],
            [['comune_id', 'tipo'], 'integer'],
            [['data_creazione', 'tipo'], 'safe'],
            [['nome'], 'string', 'max' => 255],
            [['comune_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comune::class, 'targetAttribute' => ['comune_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comune_id' => 'Comune',
            'comune.nome' => 'Comune',
            'tipo' => 'Tipologia',
            'tipoLabel' => 'Tipologia',
            'nome' => 'Nome',
            'data_creazione' => 'Data Creazione',
        ];
    }

    /**
     * Gets query for [[Comune]].
     *
     * @return \yii\db\ActiveQuery|\app\query\ComuneQuery
     */
    public function getComune()
    {
        return $this->hasOne(Comune::class, ['id' => 'comune_id']);
    }

    /**
     * Gets query for [[Internatos]].
     *
     * @return \yii\db\ActiveQuery|\app\query\InternatoQuery
     */
    public function getInternatos()
    {
        return $this->hasMany(Internato::class, ['provienza_da_campo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CampoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampoQuery(get_called_class());
    }
    public function getTipoLabel()
    {
        switch ($this->tipo){
            case 1:
                $tipo = 'Campo di internamento';
                break;
            case 2:
                $tipo = 'Internamento libero';
                break;
        }
        return $tipo;
    }
}
