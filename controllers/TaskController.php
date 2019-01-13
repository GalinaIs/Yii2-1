<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as Controller;
use yii\data\ActiveDataProvider;
use app\models\Task as Task;
use app\models\tables\Tasks;
use app\models\tables\Users;
use app\models\tables\Status;
use yii\helpers\ArrayHelper;

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

    public function actionCreate() {
        $model = new Tasks();

        $users = Users::find()->all();
        $usersList = ArrayHelper::map($users, 'id', 'name');

        $status = Status::find()->all();
        $statusList = ArrayHelper::map($status, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => $usersList,
            'statusList' => $statusList
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $users = Users::find()->all();
        $usersList = ArrayHelper::map($users, 'id', 'name');

        $status = Status::find()->all();
        $statusList = ArrayHelper::map($status, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'usersList' => $usersList,
            'statusList' => $statusList
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}