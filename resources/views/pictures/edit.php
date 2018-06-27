<div class="card border-secondary">
    <h2 class="card-header">Update: {<?=$picture['title']?>}</h2>
    <div class="card-body">
        <form action="/pictures/edit/<?=$picture['id']?>" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$picture['title'];?>">
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="<?=$picture['url'];?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>