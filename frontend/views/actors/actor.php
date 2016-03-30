<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Actor | '.$cast->name;
?>
<div class="site-index">
    <div class="row">
        <br>
        <br>
        <br>
        <br>
    </div>
    <div class="row">
        <div class="blog_masonry_3col">
            <div class="container-fluid content grid-boxes">
                <?php foreach($movies as $movie) { ?>
                    <?= $this->render('//template/movie',['movie' => $movie]);?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="text-center">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
