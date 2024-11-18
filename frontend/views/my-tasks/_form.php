<?php

use common\widgets\Panel;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaskAssign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-assign-form">

    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{cancel}'
    ])?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата начало ...', 'disabled' => true],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Дата окончания ...', 'disabled' => true],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6, 'disabled' => true],
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

    <?= $form->field($model, 'status')->dropDownList(\common\models\Tasks::getStatuses(), ['disabled' => true]) ?>

    <?= $form->field($model, 'department_id')->dropDownList($departments, ['disabled' => true]) ?>

    <?= $form->field($model, 'level_id')->dropDownList($taskLevels, ['disabled' => true]) ?>

    <?= $form->field($model, 'execute_status')->dropDownList(\common\models\Tasks::getExecuteStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Panel::end() ?>

</div>
