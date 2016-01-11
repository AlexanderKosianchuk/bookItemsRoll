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
			<div class='col-md-3'><?php echo $form->field($model, 'author_id')
					->dropDownList($dropDownSearchItems, ['prompt'=> Yii::t('app', 'Author')])->label(false);;?>
			</div>   
			<div class='col-md-3'><?php echo $form->field($model, 'name')
					->textInput(['placeholder' => Yii::t('app', 'Book Name')])->label(false);; ?>
			</div>   
	</div>
	
	<div class='row'>
		<div class='col-md-1'><label>12453245</label></div>
		<div class='col-md-3'>
			<?php echo $form->field($model, 'published_from')->label(false); ?>
		</div>
		<div class='col-md-1'><label>345345</label></div> 
		<div class='col-md-2'>
			<?php echo $form->field($model, 'published_to',
					['template' => '<div>{label}<div>{input}</div><div>{error}</div>']) ?>
		</div>   
		<div class='col-md-2'>_</div>
	</div>    

	<div class='row'>
	    <div class="form-group">
	        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	    </div>
    </div>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
