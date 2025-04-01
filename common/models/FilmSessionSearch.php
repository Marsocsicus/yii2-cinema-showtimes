<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FilmSession;

/**
 * FilmSessionSearch represents the model behind the search form of `common\models\FilmSession`.
 */
class FilmSessionSearch extends FilmSession
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'film_id', 'price', 'created_at'], 'integer'],
            [['start_time'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = FilmSession::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'film_id' => $this->film_id,
            'start_time' => $this->start_time,
            'price' => $this->price,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
