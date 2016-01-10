<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

	<div class='row'>
			<div class='col-md-3'><?php echo $form->field($model, 'author_id') ?></div>   
			<div class='col-md-3'><?php echo $form->field($model, 'name') ?></div>   
	</div>
	
	<div class='row'>
			<div class='col-md-3'><?php echo $form->field($model, 'published_from') ?></div>   
			<div class='col-md-3'><?php echo $form->field($model, 'published_to') ?></div>   
	</div>    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
