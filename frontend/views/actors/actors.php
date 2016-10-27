<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Actors | All';
?>
<div class="site-index">
    <div class="row">
        <br>
        <div class="container">
            <form action="" method="get" class="form-inline" role="form" style="margin: 0px auto; max-width: 600px">
                <div class="form-group">
                    <label class="sr-only" for="query-text">Username</label>
                    <input type="text" name="keyword" class="form-control" id="query-text" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-u btn-u-green">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="blog_masonry_3col">
            <div class="container-fluid content grid-boxes">
                <?php foreach($actors as $actor) { ?>
                    <?= $this->render('//template/actor',['cast' => $actor]);?>
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
