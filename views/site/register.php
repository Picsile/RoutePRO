<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <div class="row">
        <div class="col-lg-8 d-flex" style="height: 730px;">

            <div class="d-flex w-100 gap-3 border shadow-sm rounded-5 overflow-hidden">

                <div style="background-color:blue; width: 500px; height: 100%;" class="overflow-hidden">
                    <img src="../../web/img/register.jpg" alt="" class="object-fit-cover w-100 h-100">
                </div>

                <div class="p-5 w-100">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <h3><?= Html::encode($this->title) ?></h3>

                    <?= $form->field($model, 'full_name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'login') ?>

                    <?= $form->field($model, 'password') ?>

                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '+7(999)999-99-99',
                    ]) ?>

                    <?= $form->field($model, 'email') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-accent w-100 btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>