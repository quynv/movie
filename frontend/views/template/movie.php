<div class="grid-boxes-in">
    <a href="#">
        <img class="img-responsive" src="<?= $movie->getPoster('w342');?>" alt="">
    </a>
    <div class="grid-boxes-caption">
        <h3><a href="#"><?= $movie->getTitle();?></a></h3>
        <ul class="list-inline grid-boxes-news">
            <li><i class="fa fa-clock-o"></i> &nbsp;<?= $movie->getReleaseDate();?></li>
            <li>|</li>
            <li>&nbsp;<?= $movie->getRuntime()._('mins')?></li>
        </ul>
    </div>
</div>
