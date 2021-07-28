<?php

namespace app\query;

use app\models\Faldone;

/**
 * This is the ActiveQuery class for [[Faldone]].
 *
 * @see Faldone
 */
class FaldoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Faldone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Faldone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
