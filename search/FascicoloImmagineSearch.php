<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FascicoloImmagine;

/**
 * FascicoloImmagineSearch represents the model behind the search form of `app\models\FascicoloImmagine`.
 */
class FascicoloImmagineSearch extends FascicoloImmagine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fascicolo_id', 'immagine_id', 'ordine'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FascicoloImmagine::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fascicolo_id' => $this->fascicolo_id,
            'immagine_id' => $this->immagine_id,
            'ordine' => $this->ordine,
        ]);

        return $dataProvider;
    }
}
