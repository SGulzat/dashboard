<?php

namespace backend\controllers;

use common\models\Department;
use common\models\Employees;
use common\models\TaskAssign;
use common\models\TaskLevel;
use common\models\Tasks;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class TasksReportController extends \yii\web\Controller
{
    public $layout = 'report';

    public function actionIndex($departmentId = null)
    {
        //1-график------------------------------
        $departments = Department::find()
            ->select('name')
            ->asArray()
            ->all();
        $departments = ArrayHelper::getColumn($departments, 'name');

        $departmentsCounts = \Yii::$app->db->createCommand('SELECT
                    (
                        SELECT COUNT(*) FROM tasks WHERE tasks.department_id = department.id
                    ) as count_tasks
                    FROM department
        ')->queryAll();
        $departmentsCounts = ArrayHelper::getColumn($departmentsCounts, 'count_tasks');
        //---------------------------------------
        $taskLevels = TaskLevel::find()
            ->select('name')
            ->asArray()
            ->all();
        $taskLevels = ArrayHelper::getColumn($taskLevels, 'name');

        $taskLevelsCounts = \Yii::$app->db->createCommand('SELECT
                    name,
                    (
                        SELECT COUNT(*) FROM tasks WHERE tasks.level_id = task_level.id
                    ) as count_tasks_levels
                    FROM task_level
        ')->queryAll();
        $taskLevelsCounts = ArrayHelper::getColumn($taskLevelsCounts, 'count_tasks_levels');

        //------------
        $allTaskLevels = TaskLevel::find()
            ->asArray()
            ->all();

        $allDepartments = Department::find()
            ->asArray()
            ->all();

        $datasetsForThirdChart = [];

        foreach ($allTaskLevels as $taskLevel) {

            $backgroundColor = '';
            $dataCount = [];

            foreach ($allDepartments as $department) {

                $departmentsTaskLevelCount = Tasks::find()
                    ->where(['level_id' => $taskLevel['id']])
                    ->andWhere(['department_id' => $department['id']])
                    ->count();

                $dataCount[] = $departmentsTaskLevelCount;

            }

            if ($taskLevel['level_number'] == 0) {
                $backgroundColor = 'rgb(75, 192, 192)';
            } elseif ($taskLevel['level_number'] == 1) {
                $backgroundColor = 'rgb(255, 205, 86)';
            } elseif ($taskLevel['level_number'] == 2) {
                $backgroundColor = 'rgb(255, 99, 132)';
            }

            $datasetsForThirdChart[] = [
                'label' => $taskLevel['name'],
                'data' => $dataCount,
                'backgroundColor' => $backgroundColor
            ];

        }


//                print_r($datasetsForThirdChart); die;

        //---------------------------------------
        $taskExecuteStatus = Tasks::getExecuteStatuses();


        $firstDepartment = null;
        $firstDepartmentID = 0;

        if ($departmentId == null) {
            $firstDepartment = $allDepartments[0];
            $firstDepartmentID = $firstDepartment['id'];
        } else {
            $firstDepartmentID = $departmentId;
        }


        $allEmployess = Employees::find()
            ->where(['department_id' => $firstDepartmentID])
            ->asArray()
            ->all();
        $allEmployess2 = $allEmployess;

        $allEmployess = ArrayHelper::getColumn($allEmployess, 'full_name');
        $datasetsForFourChart = [];

        $taskStatuses = [
            Tasks::EXECUTE_STATUS_IN_PROGRESS, Tasks::EXECUTE_STATUS_DONE, Tasks::EXECUTE_STATUS_ON_PAUSE
        ];

        foreach ($taskExecuteStatus as $statusIndex => $executeStatus) {
            $dataCount = [];
            foreach ($allEmployess2 as $employee) {
                $taskStatusCount = Tasks::find()
                    ->innerJoin('task_assign', 'tasks.id = task_assign.task_id')
                    ->where(['task_assign.employee_id' => $employee['id']])
                    ->andWhere(['tasks.execute_status' => $statusIndex])
                    ->count();

                $dataCount[] = $taskStatusCount;
            }


            $backgroundColor = '';
            if ($statusIndex == Tasks::EXECUTE_STATUS_IN_PROGRESS) {
                $backgroundColor = 'rgb(75, 192, 192)';
            } elseif ($statusIndex == Tasks::EXECUTE_STATUS_DONE) {
                $backgroundColor = 'rgb(255, 205, 86)';
            } elseif ($statusIndex == Tasks::EXECUTE_STATUS_ON_PAUSE) {
                $backgroundColor = 'rgb(255, 99, 132)';
            } elseif ($statusIndex == Tasks::EXECUTE_STATUS_TESTING) {
                $backgroundColor = 'rgb(255, 99, 120)';
            } elseif ($statusIndex == Tasks::EXECUTE_STATUS_TESTED) {
                $backgroundColor = 'rgb(255, 99, 100)';
            }

            $datasetsForFourChart[] = [
                'label' => $executeStatus,
                'data' => $dataCount,
                'backgroundColor' => $backgroundColor
            ];
        }

        return $this->render('index', [
            'departments' => Json::encode($departments),
            'departmentsCounts' => Json::encode($departmentsCounts),

            'taskLevels' => Json::encode($taskLevels),
            'taskLevelsCounts' => Json::encode($taskLevelsCounts),

            'datasetsForThirdChart' => Json::encode($datasetsForThirdChart),

            'allDepartments' => $allDepartments,

            'taskExecuteStatus' => Json::encode($taskExecuteStatus),

            'allEmployess' => Json::encode($allEmployess),

            'datasetsForFourChart' => Json::encode($datasetsForFourChart),

            'taskStatuses' => Json::encode($taskStatuses),

            'departmentId' => $departmentId

        ]);
    }
}
