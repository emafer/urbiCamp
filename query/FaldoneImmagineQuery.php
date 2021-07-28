<?php

namespace app\query;

use app\models\FaldoneImmagine;

/**
 * This is the ActiveQuery class for [[FaldoneImmagine]].
 *
 * @see FaldoneImmagine
 */
class FaldoneImmagineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdo0c}
     * @return FaldoneImmagine[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FaldoneImmagine|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
