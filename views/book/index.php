<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel, 'dropDownSearchItems' => $dropDownSearchItems]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
        	[
        		'label' => Yii::t('app', 'Preview'),
        		'format' => 'raw',
        		'contentOptions'=> ['class' => 'grid-view-img-cell'], // <-- right here
        		'value' => function($data) {
    				$lightboxWidget = Lightbox::widget([
    					'files' => [
    						[
    							'thumb' => $data->preview,
    							'original' => $data->preview
    						],
    					],	
    				]);
    				
    				//there was not found the way to set style to Lightbox::widget img,
    				//thus using brut forse till this widget wont be improved
    				//alt is option that always appears in widget compiled html
    				return str_replace('alt', 'style=\'max-width:100%\'', 
    						$lightboxWidget);
    			}	
    		],
    		[
    			'label' => Yii::t('app', 'Author'),
    			'attribute' => 'author_id',
    			'format' => 'raw',
    			'value' => function($data) {
    				return $data->author->firstname . " ". $data->author->lastname;
    			}
    		],
            'date',
            'date_created',
            
            [
            		'class' => 'yii\grid\ActionColumn',
					'template' => '{view} {update} {delete}',
			        'headerOptions' => ['class' => 'activity-view-link'],
			        'contentOptions' => ['class' => 'padding-left-5px'],
			
			        'buttons' => [
			            'view' => function ($url, $model, $key) {
			                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
			                		'/book/'.$key, [
			                    'class' => 'activity-view-link',
			                    'title' => Yii::t('yii', 'View'),
			                    'data-toggle' => 'modal',
			                    'data-target' => '#activity-modal',
			                    'data-id' => $key,
			                ]);
			            },
			        ],
    		],
        ],
    ]); ?>
    
    
	<?php 
		Modal::begin([
			'id' => 'activity-modal',
			'class' => 'modal-view'
		]);
		
		Modal::end();
	?>
	
</div>
