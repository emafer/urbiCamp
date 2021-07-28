<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Tipologia]].
 *
 * @see \app\models\Tipologia
 */
class TipologiaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Tipologia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Tipologia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
