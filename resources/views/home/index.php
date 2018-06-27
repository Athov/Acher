<div class="card border-secondary">
    <h2 class="card-header"><?=$title['home'];?></h2>
    <div class="card-body">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Libero molestias beatae odio officiis eaque fugit cum, quod quidem molestiae, 
        deleniti ex nesciunt nostrum magnam distinctio minima! 
        Ipsa eaque dignissimos odit.</p>

        <div class="row">
            <?php foreach($pictures as $picture): ?>
            <div class="col-3 mx-auto mb-4">
                <a href="/pictures/<?=$picture['id']?>">
                    <img class="img-fluid" src="<?=$picture['url']; ?>" alt="<?=$picture['title']?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>