<h2>Название: <?= $model->name ?></h2>
<p>Описание: <?= $model->description ?></p>
<div>Срок исполнения: <?= $model->date ?></div>
<div>Ответственный: <?= $model->user->name ?></div>
<div>Статус: <?= $model->status->name ?></div>