<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prestamos */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="prestamos-form">

    <?php $form = ActiveForm::begin([
        'id' => 'create-prestamos-form',
        'enableAjaxValidation' => true,
    ]); ?>
        <?= $form->field($model, 'libro_id')->label('Libro')->dropDownList($libros) ?>
        <?= $form->field($model, 'lector_id')->label('Lector')->dropDownList($lectores) ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
