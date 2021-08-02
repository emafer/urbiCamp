<?php

namespace app\query;

/**
 * This is the ActiveQuery class for [[\app\models\DocumentoInternato]].
 *
 * @see \app\models\DocumentoInternato
 */
class DocumentoInternatoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\DocumentoInternato[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\DocumentoInternato|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
