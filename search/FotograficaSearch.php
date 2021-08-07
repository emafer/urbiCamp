<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentazioneFotografica;

/**
 * FotograficaSearch represents the model behind the search form of `app\models\DocumentazioneFotografica`.
 */
class FotograficaSearch extends DocumentazioneFotografica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fascicolo_id', 'data_fittizia', 'documento_di_riferimento_id', 'nota_matita', 'immagine_id', 'autore', 'modificato_da'], 'integer'],
            [['data', 'note', 'descrizione', 'descrizione_en', 'testoNotaMatita', 'creato_il', 'modificato_il'], 'safe'],
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
        $query = DocumentazioneFotografica::find();

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
            'nota_matita' => $this->nota_matita,
            'immagine_id' => $this->immagine_id,
            'autore' => $this->autore,
            'creato_il' => $this->creato_il,
            'modificato_da' => $this->modificato_da,
            'modificato_il' => $this->modificato_il,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione])
            ->andFilterWhere(['like', 'descrizione_en', $this->descrizione_en])
            ->andFilterWhere(['like', 'testoNotaMatita', $this->testoNotaMatita]);

        return $dataProvider;
    }
}
