<div class="card border-secondary">
    <h2 class="card-header"><?=$title['home'];?></h2>
    <div class="card-body">
        <h5 class="card-title">Welcome to the landing page. </h5>
        <h6 class="card-subtitle mb-2 text-muted">Here you can find information about the framework.</h6>
        <p class="text-muted mb-2 text-left">Pictures table</p>
        
<div class="alert alert-secondary text-left">
<pre>
<code>CREATE TABLE IF NOT EXISTS pictures (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    url text COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;</code>
</pre>
</div>

    </div>
</div>