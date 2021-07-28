<?php

namespace app\query;

use app\models\Immagine;

/**
 * This is the ActiveQuery class for [[Immagine]].
 *
 * @see Immagine
 */
class ImmagineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Immagine[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Immagine|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function cercaPerFaldone($db= null) {

    }
}
