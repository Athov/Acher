<div class="card border-secondary">
    <h2 class="card-header">Update: {<?=$user['username']?>}</h2>
    <div class="card-body">
        <form action="/users/edit/<?=$user['id']?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="<?=$user['username'];?>">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$user['email'];?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>