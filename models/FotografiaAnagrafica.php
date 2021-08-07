<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotografia_anagrafica".
 *
 * @property int $fotografia_id
 * @property int $anagrafica_id
 *
 * @property DocumentazioneFotografica $fotografia
 * @property Anagrafica $anagrafica
 */
class FotografiaAnagrafica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fotografia_anagrafica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fotografia_id', 'anagrafica_id'], 'required'],
            [['fotografia_id', 'anagrafica_id'], 'integer'],
            [['fotografia_id', 'anagrafica_id'], 'unique', 'targetAttribute' => ['fotografia_id', 'anagrafica_id']],
            [['fotografia_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentazioneFotografica::className(), 'targetAttribute' => ['fotografia_id' => 'id']],
            [['anagrafica_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anagrafica::className(), 'targetAttribute' => ['anagrafica_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fotografia_id' => 'Fotografia ID',
            'anagrafica_id' => 'Anagrafica ID',
        ];
    }

    /**
     * Gets query for [[Fotografia]].
     *
     * @return \yii\db\ActiveQuery|\app\query\FotografiaQuery
     */
    public function getFotografia()
    {
        return $this->hasOne(DocumentazioneFotografica::className(), ['id' => 'fotografia_id']);
    }

    /**
     * Gets query for [[Anagrafica]].
     *
     * @return \yii\db\ActiveQuery|\app\query\AnagraficaQuery
     */
    public function getAnagrafica()
    {
        return $this->hasOne(Anagrafica::className(), ['id' => 'anagrafica_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\query\FotografiaAnagraficaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\query\FotografiaAnagraficaQuery(get_called_class());
    }
}
