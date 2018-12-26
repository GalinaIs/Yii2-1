<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<?= app\widgets\TaskWidget::Widget([
    'id' => $model->id,
    'title' => $model->name,
    'description' => $model->description,
    'user' => $model->user->name,
    'date' => $model->date
]); ?>