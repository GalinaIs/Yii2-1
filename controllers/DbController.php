<?php

namespace app\controllers;

use yii\web\Controller as Controller;
use \app\models\tables\Tasks as Tasks;
use \yii\db\Query as Query;

class DbController extends Controller {

    public function actionIndex() {
        $res = \Yii::$app->db->createCommand("
            SELECT COUNT(*) FROM test
        ")
        ->queryScalar();
        var_dump($res);
        exit;
    }

    public function actionAr() {
        $model = Tasks::findOne(2);
        //$model->delete();
        //var_dump($model);
    }

    public function actionFind() {
        /*$tasks = Tasks::findOne(2);
        var_dump($tasks->user);*/

        $tasks = Tasks::find()
        ->with("user")
        ->all();
        var_dump($tasks);

        exit();
    }
}