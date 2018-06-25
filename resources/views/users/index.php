<div class="card border-secondary">
    <h2 class="card-header">All Users</h2>
    <div class="card-body">
        <a href="/users/create" class="btn btn-primary mb-3">New Account</a>
        <div class="list-group">
<?php foreach ($users as $row): ?>
            <a href="users/edit/<?=$row['id']?>" class="list-group-item list-group-item-action"><?=$row['username']?></a>
<?php endforeach; ?>
        </div>
    </div>
</div>