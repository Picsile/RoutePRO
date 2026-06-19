<?php

use app\models\PayType;
use app\models\Programm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($feedback, 'comment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn w-100 btn-accent btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>