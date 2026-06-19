<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = 'Отзыв на заявку №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="application-update">

    <div class="col-lg-6">

        <div class="p-5 gap-3 border shadow-sm rounded-5 overflow-hidden">
            <h3><?= Html::encode($this->title) ?></h3>

            <?= $this->render('_form_feedback', [
                'model' => $model,
                'feedback' => $feedback,
            ]) ?>
        </div>
    </div>
</div>