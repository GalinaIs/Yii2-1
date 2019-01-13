<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as Controller;
use yii\data\ActiveDataProvider;
use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\helpers\Url;

class UserController extends Controller {

    public function actionIndex() {
        if (!$user_id = Yii::$app->user->identity->id) {
            return $this->redirect(Url::to(['/site/logout']));
        }

        $user = Users::findOne($user_id);

        $query = Tasks::find()
            ->where(['responsible_id' => $user_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);
    
        return $this->render('index', [
            'user' => $user,
            'dataProvider' => $dataProvider
        ]);
    }
}