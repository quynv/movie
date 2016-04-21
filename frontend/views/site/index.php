<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Movie | Index';
?>
<div class="site-index">
    <?= $this->render('//layouts/slider',['movies' => $comings]);?>
    <div class="row space-color">
        <div class="container">
<!--            <div class="btn-group" style="float: right">-->
<!--                <button type="button" class="btn btn-filter dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    <span class="fa fa-filter"></span> Filter <span class="caret"></span>-->
<!--                </button>-->
<!--                <ul class="dropdown-menu custom-dropdown-filter">-->
<!--                    <li><a href="#">By title</a></li>-->
<!--                    <li><a href="#">By Date</a></li>-->
<!--                </ul>-->
<!--            </div>-->
            <br>
        </div>
    </div>
    <div class="row">
        <div class="blog_masonry_3col">
            <div class="container-fluid content grid-boxes">
                <?php foreach($movies as $movie) { ?>
                    <?= $this->render('//template/movie',['movie' => $movie]);?>
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
