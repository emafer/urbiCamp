<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Familiare]].
 *
 * @see \app\models\Familiare
 */
class FamiliariQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Familiare[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Familiare|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
