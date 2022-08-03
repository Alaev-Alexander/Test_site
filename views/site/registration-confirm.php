<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<p>Вы успешно зарегистрированы и можете войти в систему. </p>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model_entry, 'email') ?>

<?= $form->field($model_entry, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>