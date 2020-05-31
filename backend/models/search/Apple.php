<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Apple as AppleModel;

class Apple extends AppleModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['status'], 'safe'],
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
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [];
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
		$query = AppleModel::find();

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
			'status' => $this->status,
		]);

//        \Yii::error($query);

		return $dataProvider;
	}
}
