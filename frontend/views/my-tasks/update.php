<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaskAssign
 * @var $taskCommentForm \frontend\models\TaskCommentForm
 */

$this->title = Yii::t('backend', 'Update', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Task Assigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="task-assign-update">

    <div class="box">
        <div class="box__body">
            <!-- Кнопка для вызова модального окна -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Добавить комментарий
            </button>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'departments' => $departments,
        'taskLevels' => $taskLevels
    ]) ?>

</div>

<?php
$taskComments = \common\models\TaskComment::find()
    ->where(['employee_id' => Yii::$app->user->id])
    ->andWhere(['task_id' => $model->id])
    ->all();
?>

<?php if ($taskComments): ?>
<div class="box">
    <div class="box-header">
        <h4>
            Комментарий сотрудника: <?= \common\models\Employees::findOne(['id' => Yii::$app->user->id])->full_name; ?>
        </h4>
    </div>
    <div class="box-body">

        <table class="table">
            <tr>
                <th>Комментарий</th>
            </tr>
            <?php foreach ($taskComments as $taskComment): ?>
                <tr>
                    <th>
                        <?= $taskComment->data ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
<?php endif; ?>

<!-- Модальное окно -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить комментарий</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'task-comment-form', 'action' => '/my-tasks/add-comment']); ?>
                <?= $form->field($taskCommentForm, 'employee_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                <?= $form->field($taskCommentForm, 'data')->widget(TinyMce::className(), [
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
                <div class="form-group">
                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary btn-block', 'name' => 'task-comment-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>