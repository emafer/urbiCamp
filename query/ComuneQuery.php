<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Comune]].
 *
 * @see \app\models\Comune
 */
class ComuneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Comune[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Comune|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
