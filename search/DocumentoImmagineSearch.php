<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentoImmagine;

/**
 * DocumentoImmagineSearch represents the model behind the search form of `app\models\DocumentoImmagine`.
 */
class DocumentoImmagineSearch extends DocumentoImmagine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'immagine_id', 'ordine'], 'integer'],
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
        $query = DocumentoImmagine::find();

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
            'documento_id' => $this->documento_id,
            'immagine_id' => $this->immagine_id,
            'ordine' => $this->ordine,
        ]);

        return $dataProvider;
    }
}
