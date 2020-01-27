<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;

$this->title = 'Lista de géneros';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="generos-index">
    <div class="row">
        <div class="col">
            <?php $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['generos/index'],
            ]) ?>
                <?= $form->field($generosSearch, 'denom') ?>
                <div class="form-group">
                    <?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <th><?= $sort->link('denom') ?></th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach ($filas as $fila): ?>
                        <tr>
                            <td>
                                <?= $fila['denom'] ?>
                            </td>
                            <td>
                                <?= Html::a('Ver',
                                    ['generos/view', 'id' => $fila['id']],
                                    ['class' => 'btn btn-sm btn-info']
                                ) ?>
                                <?= Html::a('Modificar',
                                    ['generos/update', 'id' => $fila['id']],
                                    ['class' => 'btn btn-sm btn-primary']
                                ) ?>
                                <?= Html::a('Borrar',
                                    ['generos/delete', 'id' => $fila['id']],
                                    [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data-confirm' => '¿Está seguro?',
                                        'data-method' => 'POST',
                                    ]
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Html::a('Insertar',
                ['generos/create'],
                ['class' => 'btn btn-sm btn-primary']
            ) ?>
        </div>
    </div>
</div>
