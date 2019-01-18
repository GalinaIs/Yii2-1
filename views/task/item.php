<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

?>

<h2>Название: <?= $model->name ?></h2>
<p>Описание: <?= $model->description ?></p>
<div>Срок исполнения: <?= $model->date ?></div>
<div>Ответственный: <?= $model->user->name ?></div>
<div>Статус: <?= $model->status->name ?></div>

<?= Html::beginForm(['task/update', 'id' => $model->id]) ?>
    <?= Html::submitButton('Изменить задачу', ['class' => 'btn btn-warning create_task_button']) ?>
<?= Html::endForm() ?>

<?php if($user_id): ?>
<h4>Добавить комментарий к задаче: </h4>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($modelComment, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($modelComment, 'content')->textArea() ?>

<?= $form->field($modelComment, 'img_path')->fileInput() ?>

<?= Html::submitButton('Оставить комментарий', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
<?php else: ?>
<h4>Чтобы оставить комментарий к задаче, необходимо авторизоваться</h4>
<?php endif; ?>

<h4>Комментарии к задаче: </h4>
<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'options' => [
            'class' => 'view_comments'
        ],
        'summary' => false,
        'emptyText' => 'Нет комментариев',
    ]);
?>