<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;

$this->title = 'Lista de géneros';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="generos-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $generosSearch,
        'columns' => [
            'denom',
            'created_at:datetime:Fecha alta',
            'total',
            ['class' => ActionColumn::class],
        ],
    ]) ?>

    <div class="row">
        <div class="col">
            <?= Html::a('Insertar',
                ['generos/create'],
                ['class' => 'btn btn-sm btn-primary']
            ) ?>
        </div>
    </div>
</div>
