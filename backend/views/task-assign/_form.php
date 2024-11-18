<?php

use common\widgets\Panel;
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

    <?= $form->field($model, 'task_id')->widget(Select2::classname(), [
        'data' => [],
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите задачу ...', 'required' => 'required'],
        'pluginOptions' => [
            'allowClear' => true,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => '/tasks/list',
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(city) { return city.text; }'),
            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
        ],
    ]); ?>

    <?= $form->field($model, 'status')
        ->hiddenInput(['value' => \common\models\TaskAssign::STATUS_WAITING])
        ->label(false)
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Panel::end() ?>
</div>
