<div class="card border-secondary">
    <h2 class="card-header"><?=$title['update_picture']; ?>: {<?=$picture['title']?>}</h2>
    <div class="card-body">
        <form action="/pictures/<?=$picture['id']?>" method="post">
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
                <label for="title"><?=$title['form']['title']; ?></label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$picture['title'];?>">
            </div>
            <div class="form-group">
                <label for="url"><?=$title['form']['url']; ?></label>
                <input type="text" class="form-control" id="url" name="url" value="<?=$picture['url'];?>">
            </div>
            <button type="submit" class="btn btn-primary"><?=$title['button']['submit']; ?></button>
        </form>
    </div>
</div>