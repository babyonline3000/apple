<?php

namespace backend\controllers;

class AppleController extends BaseController
{
	/**
	 * Lists all Apple models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new \backend\models\search\Apple();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
}
