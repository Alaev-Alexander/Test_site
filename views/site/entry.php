<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model 
    @var $model_reg
*/ 
?>
<html>
<body>
<div class="row">
<div class="col-6">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'email')->label('E-mail') ?>

<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="col-6">
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_reg, 'name')->label('Имя') ?>

    <?= $form->field($model_reg, 'email')->label('E-mail') ?>

    <?= $form->field($model_reg, 'password')->passwordInput()->label('Пароль') ?>

    <?= $form->field($model_reg, 'repeat_password')->passwordInput()->label('Повторите пароль') ?>
    <div class="form-group">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</body>
</html>
