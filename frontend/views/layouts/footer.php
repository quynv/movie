<?php
use kartik\social\FacebookPlugin;
use yii\helpers\Url;
?>
<!--=== Footer ===-->
<div id="footer-v6" class="footer-v6">
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About Us -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2>Facebook page</h2></div>
                    <?= FacebookPlugin::widget(['type'=>FacebookPlugin::PAGE, 'settings' => ['href'=>'http://facebook.com/rmovie.dev']]);?>
                </div>
                <!-- End About Us -->

                <!-- Recent News -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2>Useful Links</h2></div>
                    <ul class="list-unstyled footer-link-list">
                        <li><a href="<?= Url::to('/movies/upcoming')?>">Coming soon</a></li>
                        <li><a href="<?= Url::to('/recommended')?>">Recommended</a></li>
                        <li><a href="<?= Url::to('/actors/all')?>">Actors</a></li>
                        <li><a href="<?= Url::to('/directors/all')?>">Directors</a></li>
                        <li><a href="<?= Url::to('/search')?>">Search</a></li>
                    </ul>
                </div>
                <!-- End Recent News -->

                <!-- Useful Links -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2>Useful Links</h2></div>
                    <ul class="list-unstyled footer-link-list">
                        <li><a href="<?= Url::to('/contributions')?>">Contribution</a></li>
                        <li><a href="<?= Url::to('/feedback')?>">Feedback</a></li>
                    </ul>
                </div>
                <!-- End Useful Links -->

                <!-- Contacts -->
                <div class="col-md-3">
                    <div class="heading-footer"><h2>Contacts</h2></div>
                    <ul class="list-unstyled contacts">
                        <li>
                            <i class="radius-3x fa fa-map-marker"></i>
                            1 Dai Co Viet street, Hai Ba Trung District,
                            Ha Noi
                        </li>
                        <li>
                            <i class="radius-3x fa fa-phone"></i>
                            (+123) 456 7890<br>
                            (+123) 456 7891
                        </li>
                        <li>
                            <i class="radius-3x fa fa-globe"></i>
                            <a href="#">quytnhanam@gmail.com</a><br>
                        </li>
                    </ul>
                </div>
                <!-- End Contacts -->
            </div>
        </div><!--/container -->
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 sm-margon-bottom-10">
                    <ul class="list-inline terms-menu">
                        <li class="silver">Copyright � 2014 - All Rights Reserved</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline dark-social pull-right space-bottom-0">
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Facebook" href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Twitter" href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Vine" href="#">
                                <i class="fa fa-vine"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Google plus" href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Pinterest" href="#">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Instagram" href="#">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Tumblr" href="#">
                                <i class="fa fa-tumblr"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Youtube" href="#">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Soundcloud" href="#">
                                <i class="fa fa-soundcloud"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=== End Footer ===-->