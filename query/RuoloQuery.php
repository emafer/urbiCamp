<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Ruolo]].
 *
 * @see \app\models\Ruolo
 */
class RuoloQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Ruolo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Ruolo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
