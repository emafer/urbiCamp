<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Faldone;

/**
 * FaldoneSearch represents the model behind the search form of `app\models\Faldone`.
 */
class FaldoneSearch extends Faldone
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'archivio_id'], 'integer'],
            [['descrizione', 'note', 'classificazione'], 'safe'],
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
        $query = Faldone::find();

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
            'archivio_id' => $this->archivio_id,
        ]);

        $query->andFilterWhere(['like', 'descrizione', $this->descrizione])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'classificazione', $this->classificazione]);

        return $dataProvider;
    }
}
