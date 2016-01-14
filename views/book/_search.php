<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;


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
					->textInput(['placeholder' => Yii::t('app', 'Book Name')])->label(false); ?>
			</div>   
	</div>
	
	<div class='row'>
		<div class='col-md-2 search-fields-label'>
			<?= Yii::t('app', 'Book publish date') ?>:
		</div>
		<div class='col-md-3'>
			<?php /*TODO datetime picker*/ ?>
			<?= $form->field($model, 'published_from')->label(false); ?>
		</div>
		<div class='col-md-1 search-fields-label'>
			<?= Yii::t('app', 'till') ?>
		</div>
		<div class='col-md-3'>
			<?php /*TODO datetime picker*/ ?>
			<?= $form->field($model, 'published_to')->label(false); ?>
		</div> 
		<div class='col-md-3'>&nbsp;</div> 
	</div>     

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
