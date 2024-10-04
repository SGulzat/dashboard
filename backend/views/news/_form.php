<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{cancel}'
    ])?>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#content" data-toggle="tab">Контент</a></li>
            <li><a href="#seo" data-toggle="tab">SEO</a></li>
        </ul>
        <?php $form = ActiveForm::begin(); ?>
        <div class="tab-content">
            <div class="tab-pane active" id="content">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'status')->textInput() ?>
                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="tab-pane" id="seo">
                <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Panel::end() ?>
</div>
