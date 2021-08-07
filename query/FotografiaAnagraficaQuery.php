<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\FotografiaAnagrafica]].
 *
 * @see \app\models\FotografiaAnagrafica
 */
class FotografiaAnagraficaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\FotografiaAnagrafica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\FotografiaAnagrafica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
