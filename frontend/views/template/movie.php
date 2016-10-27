<div class="grid-boxes-in hover-shadow">
    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$movie->id.'-'.str_replace([':', ' '], '-', $movie->title)?>">
        <img class="img-responsive" src="<?= $movie->getPoster('w342');?>" alt="">
    </a>
    <div class="grid-boxes-caption">
        <h3><a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$movie->id.'-'.str_replace([':', ' '], '-', $movie->title)?>"><?= $movie->title;?></a></h3>
        <ul class="list-inline grid-boxes-news">
            <li>Average:&nbsp;<?= round($movie->average, 1)?>&nbsp;<i class="fa fa-star star-color"></i></li>
            <li>|</li>
            <li><i class="fa fa-clock-o"></i> &nbsp;<?= $movie->released_at;?></li>
        </ul>
    </div>
</div>
