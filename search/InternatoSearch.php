<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Internato;

/**
 * InternatoSearch represents the model behind the search form of `app\models\Internato`.
 */
class InternatoSearch extends Internato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anagrafica_id', 'provenienza_da_id', 'provienza_da_campo_id'], 'integer'],
            [['matricola', 'data_arrivo', 'data_uscita'], 'safe'],
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
        $query = Internato::find();

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
            'anagrafica_id' => $this->anagrafica_id,
            'provenienza_da_id' => $this->provenienza_da_id,
            'provienza_da_campo_id' => $this->provienza_da_campo_id,
            'data_arrivo' => $this->data_arrivo,
            'data_uscita' => $this->data_uscita,
        ]);

        $query->andFilterWhere(['like', 'matricola', $this->matricola]);

        return $dataProvider;
    }
}
