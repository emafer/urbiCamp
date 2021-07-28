<?php

namespace app\query;

use app\models\Archivio;

/**
 * This is the ActiveQuery class for [[Archivio]].
 *
 * @see Archivio
 */
class ArchivioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Archivio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Archivio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
