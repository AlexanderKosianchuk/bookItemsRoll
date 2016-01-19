<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item') ." ?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
            	'label'=>Yii::t('app', 'Date Created'),
            	'format' => 'raw',
            	'value' => date('Y-m-d H:m:s', $model->created_at)
            ],
            [
	            'label'=>Yii::t('app', 'Date Updated'),
            	'format' => 'raw',
	            'value' => date('Y-m-d H:m:s', $model->updated_at)
            ], 
            [
        		'label' => Yii::t('app', 'Preview'),
        		'format' => 'raw',
        		'contentOptions'=> ['class' => 'grid-view-img-cell'], // <-- right here
        		'value' => sprintf("<img src='%s' alt='%s'/>", $model->preview, Yii::t('app', 'Image unavaliable'))
    		],
            'date',
            'author_id',
        ],
    ]) ?>

</div>
