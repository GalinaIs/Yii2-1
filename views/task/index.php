<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks Tracker';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'options' => [
            'class' => 'preview_tasks'
        ],
    ]); 
    
    ?>

    <?= Html::beginForm(Url::to(['task/create'])) ?>
        <?= Html::submitButton('Создать новую задачу', ['class' => 'btn btn-warning create_task_button']) ?>
    <?= Html::endForm() ?>
</div>
