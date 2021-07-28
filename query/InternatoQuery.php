<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Internato]].
 *
 * @see \app\models\Internato
 */
class InternatoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Internato[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Internato|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
