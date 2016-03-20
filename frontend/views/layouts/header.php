<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- header -->
<div class="header-v6 header-classic-dark header-sticky">
    <!-- Navbar -->
    <div class="navbar mega-menu" role="navigation">
        <div class="container container-space">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Navbar Brand -->
                <div class="navbar-brand">
                    <a href="<?= Yii::$app->homeUrl?>">
                        <?= Html::img('@web/img/logo.png', ['alt'=>'Logo', 'class'=>'default-logo']) ?>
                    </a>
                </div>
                <!-- ENd Navbar Brand -->
                <!-- Header Inner Right -->
                <div class="header-inner-right">
                    <ul class="menu-icons-list">
                        <li class="menu-icons shopping-cart">
                            <a href="#">
                                <i class="menu-icons-style radius-x icon-bell"></i>
                                <span class="badge">0</span>
                            </a>
                        </li>
                        <li class="menu-icons">
                            <i class="menu-icons-style search search-close search-btn fa fa-search"></i>
                            <div class="search-open">
                                <form action="" method="get">
                                    <input type="text" class="animated fadeIn form-control" placeholder="Start searching ...">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Header Inner Right -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li class="dropdown">
                            <a href="<?= Yii::$app->homeUrl?>">
                                Home
                            </a>
                        </li>
                        <!-- End Home -->

                        <li class="dropdown">
                            <a href="#">
                                Coming soon
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/recommended/')?>">
                                Recommended
                            </a>
                        </li>

                        <!-- Shortcodes -->
                        <li class="dropdown mega-menu-fullwidth">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Genres
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content disable-icons">
                                        <div class="container">
                                            <div class="row equal-height">
                                                <div>
                                                    <ul class="list-unstyled">
                                                        <?php foreach($this->context->genres as $genre) {?>
                                                        <li class="col-md-3"><a href="/genres/<?= $genre->id.'-'.strtolower(urlencode($genre->name))?>"><i class="fa fa-bookmark-o"></i><?= $genre->name?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- End Shortcodes -->

                        <?php if(Yii::$app->user->isGuest) { ?>
                        <li class="dropdown">
                            <a href="<?= Url::toRoute('auth/login')?>">
                                Login
                            </a>
                        </li>
                        <li class="">
                            <a href="<?= Url::toRoute('auth/signup')?>">
                                Register
                            </a>
                        </li>
                        <?php } else {?>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    <?= Yii::$app->user->identity->username ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Favourite</a></li>
                                    <li><a href="#">Setting</a></li>
                                    <li><a href="<?= Url::toRoute('auth/logout')?>" data-method="post">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div><!--/navbar-collapse-->
        </div>
    </div>
    <!-- End Navbar -->
</div>
<!-- end header -->