<?php

namespace app\modules\video\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\video\models\Video;

/**
 * VideoSearch represents the model behind the search form about `app\modules\video\models\Video`.
 */
class VideoSearch extends Video
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'year_start', 'year_end', 'duration', 'uploader'], 'integer'],
            [['name', 'origin_name', 'premiere', 'preview', 'description', 'origin_img', 'big_img', 'small_img'], 'safe'],
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
        $query = Video::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'year_start' => $this->year_start,
            'year_end' => $this->year_end,
            'duration' => $this->duration,
            'premiere' => $this->premiere,
            'uploader' => $this->uploader,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'origin_name', $this->origin_name])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'origin_img', $this->origin_img])
            ->andFilterWhere(['like', 'big_img', $this->big_img])
            ->andFilterWhere(['like', 'small_img', $this->small_img]);

        return $dataProvider;
    }
}
