<div class="card border-secondary">
    <h2 class="card-header"><?=$picture['title']; ?> <a href="/pictures/edit/<?=$picture['id']; ?>" class="btn btn-success">Edit</a></h2>
    <div class="card-body">
        <img src="<?=$picture['url']; ?>" alt="<?=$picture['title']?>" class="mx-auto d-block img-fluid" />
    </div>
</div>