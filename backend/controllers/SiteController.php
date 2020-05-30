<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
