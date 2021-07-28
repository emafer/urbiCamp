<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Provincia]].
 *
 * @see \app\models\Provincia
 */
class ProvinciaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Provincia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Provincia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
