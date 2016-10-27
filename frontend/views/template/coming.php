<?php
use yii\helpers\Url;
?>
<div class="grid-boxes-in hover-shadow">
    <a href="<?= Url::to(['/movies/coming_soon/', 'tmdb_id' => $movie->getTmdb_id()])?>">
        <img class="img-responsive" src="<?= $movie->getPoster('w342');?>" alt="">
    </a>
    <div class="grid-boxes-caption">
        <h3><a href="<?= Url::to(['/movies/coming_soon/', 'tmdb_id' => $movie->getTmdb_id()])?>"><?= $movie->getTitle();?></a></h3>
        <ul class="list-inline grid-boxes-news">
            <li><i class="fa fa-clock-o"></i> &nbsp;<?= $movie->getReleaseDate();?></li>
            <li>|</li>
        </ul>
    </div>
</div>
