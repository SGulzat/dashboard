<?php

use common\widgets\Panel;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget as FileAPI;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{cancel}'
    ])?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->input('email',['maxlength' => true, 'required' => 'required']) ?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7-999-999-99-99',
    ]) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'required' => 'required']) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => true, 'required' => 'required']) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Employees::getStatuses()) ?>

    <?= $form->field($model, 'department_id')->dropDownList($departments) ?>

    <?= $form->field($model, 'level_id')->dropDownList($developerLevels) ?>

    <?= $form->field($model, 'image')->widget(FileAPI::className(), [
        'settings' => [
            'url' => ['img-upload']
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Panel::end() ?>

</div>
