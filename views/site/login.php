<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="col-lg-8">

        <div class="d-flex w-100 gap-3 border shadow-sm rounded-5 overflow-hidden">
            <div style="background-color:blue; width: 500px; height: 100%;" class="overflow-hidden">
                <img src="../../web/img/login.jpg" alt="" class="object-fit-cover w-100 h-100">
            </div>

            <div class="p-5 w-100">
                <h3><?= Html::encode($this->title) ?></h3>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
                ]); ?>

                <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Войти', ['class' => 'btn btn-accent w-100 btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <div>
                    <span>Ещё не зарегистрировались?</span>
                    <?= Html::a('Зарегистрироваться', 'register') ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="pt-2" style="color:#999;">
                    You may login with <strong>admin/admin</strong> or <strong>q/q</strong>.<br>
                </div>

            </div>
        </div>
    </div>
</div>