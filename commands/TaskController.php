<?php

namespace app\commands;

use Yii;
use DateTime;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\helpers\ArrayHelper;

class TaskController extends Controller
{
    public $emailApp = 'my@mail.ru';

    public function actionSendMail()
    {
        $today = date("Y-m-d H:i:s");
        $tomorrow = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y")));
        $tasks = Tasks::find()
            ->where(['between', 'date', $today, $tomorrow])
            ->all();

        foreach($tasks as $task) {
            Yii::$app->mailer->compose()
                ->setTo($task->user->email)
                ->setFrom($this->emailApp)
                ->setSubject('TaskTracker: У вас есть задача с истекающим сроком')
                ->setHtmlBody("Уважаемый {$task->user->name}!<br> У вас есть задача с итекающим сроком. <br> Номер 
                задачи: {$task->id} <br>Название задачи: {$task->name} <br>Описание задачи: {$task->description}")
                ->send();
        }
        var_dump('Рассылка завершена!');
    }
}
