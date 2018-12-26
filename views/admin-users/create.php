<?php

use yii\helpers\Html;
use app\models\tables\Roles;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Users */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
    echo $this->render('_form', [
        'model' => $model,
        'role' => Roles::find()->all(),
    ]) ?>

</div>
