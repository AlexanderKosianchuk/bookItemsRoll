<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
        	'preview',
        	'author_id',
            'date_created',
            // 'date_updated',
            'date',
        	[
        		'label' => \Yii::t('app', 'This is a string to translate!'),
        		'value' => function($item) {
    				return $item->preview;
    			}	
    		],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
