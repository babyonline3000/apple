<?php

namespace backend\controllers;

use common\models\Apple;
use DateTime;
use yii\web\NotFoundHttpException;

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

    /**
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     * @var int $count
     * @var mixed $array
     */
    public function actionCreate()
    {
        $array = [];
        $count = rand(10,30);
        for($i=1;$i<=$count;$i++){
            $array[] = [
                'rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')',date('U')
            ];
        }
        if (!empty($array)){
            if (!(\Yii::$app->db->createCommand()->batchInsert('apple', ['color','created_at'], $array)->execute())){
                throw new NotFoundHttpException('Not inserted');
            }
        }

        return $this->redirect(['apple/index']);
    }

    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */
    public function actionEat($id)
    {
        $apple = Apple::findOne($id);
        if (!empty($apple)){
            if ($apple->status == \common\models\Apple::TYPE_STATUS_LYING_ON_THE_GROUND){
                $apple->_volume = $apple->volume;
                $apple->volume = rand(1,$apple->_volume);
                if($apple->volume == $apple->_volume){
                    if(!$apple->delete()){
                        throw new NotFoundHttpException('Not delete');
                    }
                }else{
                    if(!$apple->save()){
                        throw new NotFoundHttpException('Not save');
                    }
                }
            }
        }
        return $this->redirect(['apple/index']);
    }

    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */
    public function actionFall($id)
    {
        $apple = \common\models\Apple::findOne($id);
        if ($apple->status == \common\models\Apple::TYPE_STATUS_HANGING_ON_A_TREE){
            $apple->status = \common\models\Apple::TYPE_STATUS_LYING_ON_THE_GROUND;
            if(!$apple->save()){
                throw new NotFoundHttpException('Not save');
            }
        }
        return $this->redirect(['apple/index']);
    }


    /**
     * @param $id
     * @throws \yii\web\NotFoundHttpException
     * @return mixed
     */
    public function actionDelete($id)
    {
        $apple = \common\models\Apple::findOne($id);
        if ($apple->status == \common\models\Apple::TYPE_STATUS_ROTTEN){
            if(!$apple->delete()){
                throw new NotFoundHttpException('Not delete');
            }
        }
        return $this->redirect(['apple/index']);
    }


    public function beforeAction($action)
    {
        $time = 18000;//TODO количество времени в секундах, при котором яблоки считаются испорченными
        Apple::updateAll(['status' => Apple::TYPE_STATUS_ROTTEN], ['<=','fallen_at',(date('U')-$time)]);
        return parent::beforeAction($action);
    }

}
