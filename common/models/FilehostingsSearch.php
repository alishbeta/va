<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Filehostings;

/**
 * FilehostingsSearch represents the model behind the search form about `common\models\Filehostings`.
 */
class FilehostingsSearch extends Filehostings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'server_id', 'lock'], 'integer'],
            [['name', 'logo'], 'safe'],
            [['coefficient'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Filehostings::find();

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
            'server_id' => $this->server_id,
            'coefficient' => $this->coefficient,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
