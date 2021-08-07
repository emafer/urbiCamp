<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\FotografiaInternato]].
 *
 * @see \app\models\FotografiaInternato
 */
class FotografiaInternatoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\FotografiaInternato[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\FotografiaInternato|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
