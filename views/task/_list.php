<div class='bg-warning one_comment_view'>
    <h5>Пользователь: <?= $model->user->name ?></h5>
    <h2>Тема: <?= $model->title ?></h2>    
    <p>Комментарий:<br><?= $model->content ?></p>
    <a href=<?= "/img/{$model->img_path}" ?> target="_blank">
        <img src=<?= "/img/small/{$model->img_path}" ?> /> 
    </a>
</div>