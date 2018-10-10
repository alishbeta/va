<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PremiumKeys;

/**
 * PremiumKeysSearch represents the model behind the search form of `common\models\PremiumKeys`.
 */
class PremiumKeysSearch extends PremiumKeys
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fh_id', 'server_id'], 'integer'],
            [['cookies', 'login', 'pass'], 'safe'],
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
        $query = PremiumKeys::find();

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
            'fh_id' => $this->fh_id,
            'server_id' => $this->server_id,
        ]);

        $query->andFilterWhere(['like', 'cookies', $this->cookies])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'pass', $this->pass]);

        return $dataProvider;
    }
}
