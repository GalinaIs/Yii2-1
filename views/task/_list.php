<div class='bg-warning one_comment_view'>
    <h5><?= $userLabel ?><?= $model->user->name ?></h5>
    <h2><?= $nameCommentLabel ?><?= $model->title ?></h2>    
    <p><?= $commentLabel ?><br><?= $model->content ?></p>
    <a href=<?= "/img/{$model->img_path}" ?> target="_blank">
        <img src=<?= "/img/small/{$model->img_path}" ?> /> 
    </a>
</div>