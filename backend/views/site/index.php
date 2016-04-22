<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Admin Dashboard';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome, <?= Yii::$app->user->identity->username ?>!</h1>

        <p class="lead">[<?= Yii::$app->user->identity->rolename ?>]</p>
    </div>

    <div class="body-content">
        <div class="row">
            <a class="col-md-6 col-sm-6 col-lg-3" href="#">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="glyphicon glyphicon-film"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter"><?= $movies?></span>
                        Movies
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-sm-6 col-lg-3" href="<?= Url::to(['users/'])?>">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="glyphicon glyphicon-user"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter"><?= $users?></span>
                        Users
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-sm-6 col-lg-3" href="#">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="glyphicon glyphicon-tag"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter"><?= $genres?></span>
                        Genres
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-sm-6 col-lg-3" href="#">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="glyphicon glyphicon-facetime-video"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter"><?= $actors?></span>
                        Actors
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-sm-6 col-lg-3" href="#">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="glyphicon glyphicon-bullhorn"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter"><?= $directors?></span>
                        Directors
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
