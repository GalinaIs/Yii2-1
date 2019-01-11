<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as Controller;
use yii\data\ActiveDataProvider;
use app\models\Task as Task;
use app\models\tables\Tasks;

class TaskController extends Controller {

    public function actionIndex() {
        $query = Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionItem($id) {
        $model = Tasks::findOne($id);

        return $this->render('item', [
            'model' => $model
        ]);
    }

    public function actionModel() {//проверка работы правил валидации
        $task = new Task();
        $task->setAttributes([
            'name' => '   New task    ',
            'description' => 'This new task in task tracker',
            /*'dateBegin' => '2018-12-19',
            'dateEnd' => '2018-12-18'*/
        ]);
        $task->validate();
        var_dump($task->getErrors());

        var_dump($task);

        exit;
    }
}