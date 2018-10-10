<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearh represents the model behind the search form about `app\models\User`.
 */
class UserSearh extends User
{
    public $datetime_range;
    public $datetime_min;
    public $datetime_max;

    public function behaviors(){
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'datetime_range',
                'dateStartAttribute' => 'datetime_min',
                'dateEndAttribute' => 'datetime_max',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'status', 'updated_at', 'ref_balance'], 'integer'],
            [['username', 'auth_key', 'token', 'password_hash', 'password_reset_token', 'email', 'avatar'], 'safe'],
            [['discounts', 'balance'], 'number'],
            [['datetime_min', 'datetime_max'], 'string'],
            [['created_at'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'discounts' => $this->discounts,
            'balance' => $this->balance,
            'ref_balance' => $this->ref_balance,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['>=', 'date(from_unixtime(created_at))', $this->datetime_min])
            ->andFilterWhere(['<', 'date(from_unixtime(created_at))', $this->datetime_max]);

        return $dataProvider;
    }
}
