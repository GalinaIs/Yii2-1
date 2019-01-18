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
use app\models\DateForm;
use app\models\tables\Comments;
use yii\web\UploadedFile;
use app\models\tables\TaskComment;

class TaskController extends Controller {

    public function actionIndex() {
        $session = Yii::$app->session;
        if (Yii::$app->request->method == 'POST') {
            $dateModel = new DateForm();
            $dateModel->load(Yii::$app->request->post());
            $session->set('dateModel', $dateModel);
        } else {
            $dateModel = $session->has('dateModel') ? $session->get('dateModel') : new DateForm();
        }
        
        $query = Tasks::find()
            ->andFilterWhere(['>=', 'date', $dateModel->dateBegin])
            ->andFilterWhere(['<=', 'date', $dateModel->dateEnd]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dateModel' => $dateModel,
        ]);
    }

    public function actionItem($id) {
        $model = Tasks::findOne($id);
        $user_id = Yii::$app->user->identity->id;
        $modelComment = new Comments();

        if ($modelComment->load(Yii::$app->request->post())){
            $modelComment->user_id = $user_id;
            $modelComment->task_id = $id;
            
            if ($modelComment->img_path = UploadedFile::getInstance($modelComment, 'img_path')) {
                $modelComment->upload();
            }
            $modelComment->save();
        }

        /*$idsComment = TaskComment::find()
            ->where(['task_id' => $id])
            ->asArray()
            ->all();
        $listIdComment = ArrayHelper::map($idsComment, 'id', 'comment_id');*/
        //var_dump($listIdComment);

        $query = Comments::find()
            ->where(['task_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
        //var_dump($listComments);

        return $this->render('item', [
            'model' => $model,
            'user_id' => $user_id,
            'modelComment' => new Comments(),
            'dataProvider' => $dataProvider
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