<div class="card border-secondary">
    <h2 class="card-header">Update: {<?=$picture['title']?>}</h2>
    <div class="card-body">
        <form action="/pictures/<?=$picture['id']?>" method="post">
            <input type="hidden" name="_method" value="put">
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