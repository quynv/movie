<?php
use yii\helpers\Url;
?>
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft customScroll">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?= Yii::$app->user->identity->getAvatar(80)?>" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?= Yii::$app->user->identity->username ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                        <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                        <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><?= Yii::$app->user->identity->rolename?></p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= Url::to(['site/index'])?>" class="waves-effect active"><i class="glyphicon glyphicon-home"></i><span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-user"></i><span> Users </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">List users</a></li>
                        <li><a href="#">List admins</a></li>
                        <li><a href="<?= Url::to(['auth/register'])?>">Add an admin</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-film"></i> <span> Movies </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">List Movies</a></li>
                        <li><a href="#">Add movie</a></li>
                        <li><a href="#">Check data from tmdb</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-facetime-video"></i><span> Casts </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">Actors</a></li>
                        <li><a href="#">Directors</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-tag"></i> <span> Genres </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                </li>
                <li>
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-plus"></i> <span> Requested movies </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                </li>
                <li>
                    <a href="#" class="waves-effect"><i class="glyphicon glyphicon-envelope"></i> <span> Feedback </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->