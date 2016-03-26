<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Movie | Now playing';
?>
<div class="site-index">
    <div class="row">
        <br>
        <br>
    </div>
    <div class="row">
        <div class="blog_masonry_3col">
            <div class="container-fluid content grid-boxes">
                <?php foreach($movies as $movie) { ?>
                    <?= $this->render('//template/playing',['movie' => $movie]);?>
                <?php } ?>
            </div>
        </div>
        <div class="text-center">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>

</div>
