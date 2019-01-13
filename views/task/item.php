<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<h2>Название: <?= $model->name ?></h2>
<p>Описание: <?= $model->description ?></p>
<div>Срок исполнения: <?= $model->date ?></div>
<div>Ответственный: <?= $model->user->name ?></div>
<div>Статус: <?= $model->status->name ?></div>

<?= Html::beginForm(['task/update', 'id' => $model->id]) ?>
    <?= Html::submitButton('Изменить задачу', ['class' => 'btn btn-warning create_task_button']) ?>
<?= Html::endForm() ?>