<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->title = 'Movie | Search';
?>
<div class="site-index">
    <div class="row">
        <br>
        <br>
        <div class="container">
            <form action="" method="get" class="form-inline" role="form">
                <div class="form-group">
                    <label class="sr-only" for="query-text">Title</label>
                    <input type="text" name="keyword" class="form-control" id="query-text" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="query-year">Year</label>
                    <input type="text" name="year" class="form-control" id="query-year" placeholder="Year">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="query-genre">Genre</label>
                    <select name="genre" id="query-genre" class="form-control">
                        <option value="">- Please Select Genre -</option>
                        <?php foreach($this->context->genres as $genre){?>
                            <option value="<?= $genre->id?>"><?= $genre->name?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-u btn-u-green">Search</button>
                </div>
            </form>
        </div>
    </div>
    <?php if($movies) {?>
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
    <?php } else { ?>
        <div class="container">
            <p>Movie not found</p>
        </div>
    <?php }?>
</div>
