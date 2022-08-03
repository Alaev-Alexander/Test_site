<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model_reg, 'name')->label('Имя') ?>

<?= $form->field($model_reg, 'email')->label('E-mail') ?>

<?= $form->field($model_reg, 'password')->passwordInput()->label('Пароль') ?>

<?= $form->field($model_reg, 'Повторите пароль')->passwordInput()->label('Повторите пароль') ?>
    <div class="form-group">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>