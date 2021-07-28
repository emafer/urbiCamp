<?php

namespace app\query;

use app\models\FascicoloImmagine;

/**
 * This is the ActiveQuery class for [[FascicoloImmagine]].
 *
 * @see FascicoloImmagine
 */
class FascicoloImmagineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FascicoloImmagine[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FascicoloImmagine|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
