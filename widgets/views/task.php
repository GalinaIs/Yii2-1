<div class='tasks-item bg-success text-center' style='width: 350px; '>
    <a href='/index.php?r=task/item&id=<?= $id ?>' class='text-success font-italic'>
        <h2><?= $title ?></h2>    
        <p><?= $description ?></p>
        <div style='display:flex; justify-content:space-around'>
            <div><?= $user ?></div>
            <div><?= $date ?></div>
        </div>
    </a> 
</div>