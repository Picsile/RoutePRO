<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = 'Создание заявки';
$this->params['breadcrumbs'][] = ['label' => 'Мои заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-create">

    <div class="col-lg-6">

        <div class="p-5 gap-3 border shadow-sm rounded-5 overflow-hidden">
            <h3><?= Html::encode($this->title) ?></h3>

            <?= $this->render('_form', [
                'model' => $model,
                'uploadForm' => $uploadForm,
            ]) ?>
        </div>
    </div>
</div>