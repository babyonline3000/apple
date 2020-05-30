<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Apple */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apple';
$this->params['breadcrumbs'][] = $this->title;
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
                        return '<p style="background-color: '.$model->color.';width: 60px;height: 20px;padding: 0;margin: 0">';
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
            'status',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>