<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\Role;

class RbacController extends Controller {

    public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }

        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();

        $admin = $auth->createRole(1);
        $admin->description = 'Admin';
        $auth->add($admin);

        $user = $auth->createRole(2);
        $user->description = 'User';
        $auth->add($user);

        $auth->addChild($admin, $user);

        $this->stdout('Done!' . PHP_EOL);
    }
}