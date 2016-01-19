<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
	public $published_from;
	public $published_to;
	public $author;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		[['id', 'author_id'], 'integer'],
        		[['name', 'created_at', 'updated_at', 'date', 'published_from', 'published_to', 'author'], 'safe'],
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
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $query->joinWith(['author']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['>', 'date', $this->published_from])
       		->andFilterWhere(['<', 'date', $this->published_to])
        	->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['=', 'author_id', $this->author_id]);

        return $dataProvider;
    }
}
