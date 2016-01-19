<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

	<?php /*TODO implement data input via datepicker */ ?>
    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList(
            $dropDownAuthorItems
        )->label(Yii::t('app', 'Author')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 
        		Yii::t('app', 'Create') : 
        		Yii::t('app', 'Update'), 
        		['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
