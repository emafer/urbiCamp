<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Documento;

/**
 * DocumentoSearch represents the model behind the search form of `app\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fascicolo_id', 'data_fittizia', 'documento_di_riferimento_id'], 'integer'],
            [['oggetto', 'data', 'descrizione', 'note'], 'safe'],
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
        $query = Documento::find();

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
            'fascicolo_id' => $this->fascicolo_id,
            'data' => $this->data,
            'data_fittizia' => $this->data_fittizia,
            'documento_di_riferimento_id' => $this->documento_di_riferimento_id,
        ]);

        $query->andFilterWhere(['like', 'oggetto', $this->oggetto]);

        return $dataProvider;
    }
}
