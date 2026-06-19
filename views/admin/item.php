<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;
?>

<style>
    .detail-view th {
        margin-left: 18px;
        padding-left: 18px !important;
    }
</style>
<div class="card my-2">

    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Заявка №<?= $model->id ?></span>
        <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <div class="card-body p-0">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'user_id',
                    'visible' => (bool) Yii::$app->user->identity?->isAdmin,
                    'value' => $model->user->full_name,
                ],
                [
                    'attribute' => 'programm_id',
                    'value' => $model->programm->title,
                ],
                [
                    'attribute' => 'date',
                    'value' => Yii::$app->formatter->asDatetime($model->date, 'php: d.m.Y'),
                ],
                [
                    'attribute' => 'pay_type_id',
                    'value' => $model->payType->title,
                ],
                [
                    'attribute' => 'status_id',
                    'value' => $model->status->title,
                ],
                [
                    'attribute' => 'created_at',
                    'value' => Yii::$app->formatter->asDatetime($model->created_at, 'php: d.m.Y H:i:s'),
                ],
                [
                    'label' => 'Отзыв',
                    'visible' => (bool) $model->feedback,
                    'value' => $model->feedback?->comment,
                ],
            ],
        ]) ?>

        <div class="pt-0 p-3">
            <?= $model->status->alias == 'New' ? Html::a('Подтверждена', ['change-status', 'id' => $model->id, 'alias' => 'Success'], ['class' => 'btn btn-outline-primary', 'data-method' => 'post']) : '' ?>
            <?= $model->status->alias == 'Success' ? Html::a('Тур проводится', ['change-status', 'id' => $model->id, 'alias' => 'Run'], ['class' => 'btn btn-outline-success', 'data-method' => 'post']) : '' ?>
            <?= $model->status->alias == 'Run' ? Html::a('Завершена', ['change-status', 'id' => $model->id, 'alias' => 'Finish'], ['class' => 'btn btn-outline-success', 'data-method' => 'post']) : '' ?>
        </div>
    </div>
</div>