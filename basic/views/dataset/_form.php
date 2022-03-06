<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dataset */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dataset-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'day_of_week')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_until')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
