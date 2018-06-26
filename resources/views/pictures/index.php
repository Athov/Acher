<div class="card border-secondary">
    <h2 class="card-header">Pictures</h2>
    <div class="card-body">
        <div class="row">
            <?php foreach($pictures as $picture): ?>
            <div class="col-3 mx-auto mb-4">
                <a href="/pictures/<?=$picture['id']?>">
                    <img class="img-fluid" src="http://via.placeholder.com/350x350" alt="<?=$picture['title']?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>