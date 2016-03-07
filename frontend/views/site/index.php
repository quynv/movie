<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Movie | Index';
?>
<div class="site-index">
    <?= $this->render('//layouts/slider',['movies' => $playings]);?>
    <div class="row">
        <?php foreach($movies as $movie) {?>
        <div class="col-lg-3">
            <img src="<?= $movie->getPoster('w185')?>">
        </div>
        <?php }?>
    </div>

</div>
