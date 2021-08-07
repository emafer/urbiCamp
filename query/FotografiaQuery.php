<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\DocumentazioneFotografica]].
 *
 * @see \app\models\DocumentazioneFotografica
 */
class FotografiaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\DocumentazioneFotografica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\DocumentazioneFotografica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
