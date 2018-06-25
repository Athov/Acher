<div class="card border-secondary">
    <h2 class="card-header"><?=$title['products'];?></h2>
    <div class="card-body">
        <p>
<?php
    foreach ($chars as $row)
    {
        echo $row['username'] . '<br />';
    }
?>
        </p>
    </div>
</div>