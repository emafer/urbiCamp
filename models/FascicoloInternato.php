<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "fascicolo_internato".
 *
 * @property int $fascicolo_id
 * @property int $internato_id
 *
 * @property Fascicolo $fascicolo
 * @property Internato $internato
 */
class FascicoloInternato extends  ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fascicolo_internato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fascicolo_id', 'internato_id'], 'required'],
            [['fascicolo_id', 'internato_id'], 'integer'],
            [['fascicolo_id', 'internato_id'], 'unique', 'targetAttribute' => ['fascicolo_id', 'internato_id']],
            [['fascicolo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fascicolo::className(), 'targetAttribute' => ['fascicolo_id' => 'id']],
            [['internato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Internato::className(), 'targetAttribute' => ['internato_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fascicolo_id' => 'Fascicolo ID',
            'internato_id' => 'Internato ID',
        ];
    }

    /**
     * Gets query for [[Fascicolo]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FascicoloQuery
     */
    public function getFascicolo()
    {
        return $this->hasOne(Fascicolo::className(), ['id' => 'fascicolo_id']);
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
     * {@inheritdoc}
     * @return \app\query\FascicoloInternatoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\FascicoloInternatoQuery(get_called_class());
    }
}
