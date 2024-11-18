<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employees
 * @var $departments array
 * @var $developerLevels array
 */

$this->title = Yii::t('backend', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-create">

    <?= $this->render('_form', [
        'departments' => $departments,
        'model' => $model,
        'developerLevels' => $developerLevels
    ]) ?>

</div>
