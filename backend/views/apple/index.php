<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Apple */
/* @var $model common\models\Apple */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apple';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->locale = 'ru-RU';
//Yii::$app->timeZone = 'Europe/Moscow';
?>

<div class="apple-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a("Create apples", ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '5%'],
            ],
            [
                'attribute' => 'color',
                'headerOptions' => ['width' => '1%'],
                'format' => 'html',
                'value' => function ($model) {
                        return '<p style="background-color: '.$model->color.';width: 60px;height: 35px;padding: 0;margin: 0">';
                    },
            ],
            [
                'attribute' => 'volume',
                'headerOptions' => ['width' => '100px'],
                'format' => 'html',
                'value' => function ($model) {
                        return '<p style="background-color: gray;width: '.$model->volume.'px;height: 5px;padding: 0;margin: 0">';
                    },
            ],
            [
                'attribute' => 'status',
                'value' => function (\common\models\Apple $model) {
                        return $model::typeStatusLabels()[$model->status];
                    },
                'filter' => \common\models\Apple::typeStatusLabels(),
            ],
            [
                'attribute' => 'created_at',
                'headerOptions' => ['width' => '15%'],
                'value' => function ($model) {
                        return Yii::$app->formatter->asDatetime($model->created_at);
                    },
            ],
            [
                'attribute' => 'fallen_at',
                'headerOptions' => ['width' => '15%'],
                'value' => function (\common\models\Apple $model) {
                        return ($model->fallen_at != null ? Yii::$app->formatter->asDatetime($model->fallen_at) : '');
                    },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Кушать',
                'headerOptions' => ['width' => '91px'],
                'template' => '{eat}',
                'buttons' => [
                    'eat' => function ($url,\common\models\Apple $model, $key) {
                            if ($model->status == $model::TYPE_STATUS_LYING_ON_THE_GROUND){
                                return Html::a("Кушать", ['apple/eat', 'id' => $model->id],['class' => 'btn btn-small btn-default']);
                            }else{
                                return '';
                            }
                        },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Падать',
                'headerOptions' => ['width' => '91px'],
                'template' => '{fall}',
                'buttons' => [
                    'fall' => function ($url,\common\models\Apple $model, $key) {
                            if ($model->status == $model::TYPE_STATUS_HANGING_ON_A_TREE){
                                return Html::a("Падать", ['apple/fall', 'id' => $model->id],['class' => 'btn btn-small btn-default']);
                            }else{
                                return '';
                            }
                        },
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Удалить',
                'headerOptions' => ['width' => '91px'],
                'template' => '{del}',
                'buttons' => [
                    'del' => function ($url,\common\models\Apple $model, $key) {
                            if ($model->status == $model::TYPE_STATUS_ROTTEN){
                                return Html::a("Удалить", ['apple/delete', 'id' => $model->id],['class' => 'btn btn-small btn-default']);
                            }else{
                                return '';
                            }
                        },
                ],
            ],


        ],
    ]); ?>


</div>