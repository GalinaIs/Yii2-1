<?php

namespace app\controllers;

use Yii;
use yii\web\Controller as Controller;
use app\models\tables\Language;

class LanguageController extends Controller {
    public function actionIndex() {
    
    }

    public function actionChange() {
        $idLang = Yii::$app->request->post()['select_language'];
        Yii::$app->lang->setLanguageApp($idLang);
        return $this->redirect(Yii::$app->request->referrer);
    }
}