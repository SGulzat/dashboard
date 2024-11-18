<?php
/**
 * Created by PhpStorm.
 * User: ergali
 * Date: 05.11.24
 * Time: 14:03
 */

namespace common\jobs;


use common\models\TaskAssign;
use yii\base\BaseObject;
use yii\httpclient\Response;
use yii\queue\JobInterface;
use yii\httpclient\Client;

class TaskAssignJob extends BaseObject implements JobInterface
{
    public $url;
    public $data;
    public $taskAssignId;

    public function execute($queue)
    {
        $client = new Client();

        /**
         * @var $response Response
         */

        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->url)
            ->setData($this->data)
            ->setFormat(Client::FORMAT_JSON)
            ->send();

        if ($response->isOk) {
            $data = $response->data;
            $taskAssign = TaskAssign::findOne($this->taskAssignId);
            $taskAssign->employee_id = $data['developer_id'];
            $taskAssign->status = TaskAssign::STATUS_IN_DONE;
            if ($taskAssign->update()) {
                echo "Сотрудник успешно назначен!" . "\n";
            }
            echo "Ответ сервера: " . print_r($data, true);
        } else {
            $statusCode = $response->getStatusCode();
            $errorContent = $response->getContent();
            echo "Ошибка выполнения запроса (HTTP $statusCode): $errorContent";
        }
    }
}