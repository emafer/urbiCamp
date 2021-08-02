<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\Destinatari]].
 *
 * @see \app\models\Destinatari
 */
class DestinatariQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Destinatari[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Destinatari|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
