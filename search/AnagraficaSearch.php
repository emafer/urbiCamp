<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anagrafica;

/**
 * AnagraficaSearch represents the model behind the search form of `app\models\Anagrafica`.
 */
class AnagraficaSearch extends Anagrafica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nato_a_id', 'morto_a_id', 'morto_shoah'], 'integer'],
            [['cognome', 'nome', 'nato_il', 'morto_il', 'secondo_nome'], 'safe'],
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
        $query = Anagrafica::find();

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
            'id' => $this->id,
            'nato_a_id' => $this->nato_a_id,
            'morto_a_id' => $this->morto_a_id,
            'nato_il' => $this->nato_il,
            'morto_il' => $this->morto_il,
            'morto_shoah' => $this->morto_shoah,
        ]);

        $query->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'secondo_nome', $this->secondo_nome]);

        return $dataProvider;
    }
}
