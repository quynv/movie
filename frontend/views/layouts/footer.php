<?php
use kartik\social\FacebookPlugin;
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
                    <div class="heading-footer"><h2>Recent News</h2></div>
                    <ul class="list-unstyled link-news">
                        <li>
                            <a href="#">Apple Conference</a>
                            <small>12 July, 2014</small>
                        </li>
                        <li>
                            <a href="#">Bootstrap Update</a>
                            <small>12 July, 2014</small>
                        </li>
                        <li>
                            <a href="#">Themeforest Templates</a>
                            <small>12 July, 2014</small>
                        </li>
                    </ul>
                </div>
                <!-- End Recent News -->

                <!-- Useful Links -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2>Useful Links</h2></div>
                    <ul class="list-unstyled footer-link-list">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">Latest jobs</a></li>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <!-- End Useful Links -->

                <!-- Contacts -->
                <div class="col-md-3">
                    <div class="heading-footer"><h2>Contacts</h2></div>
                    <ul class="list-unstyled contacts">
                        <li>
                            <i class="radius-3x fa fa-map-marker"></i>
                            795 Folsom Ave, Suite 600,
                            San Francisco, CA 94107
                        </li>
                        <li>
                            <i class="radius-3x fa fa-phone"></i>
                            (+123) 456 7890<br>
                            (+123) 456 7891
                        </li>
                        <li>
                            <i class="radius-3x fa fa-globe"></i>
                            <a href="#">toronto@gmail.com</a><br>
                            <a href="#">www.toronto.com</a>
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
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy and Policy</a></li>
                        <li><a href="#">License</a></li>
                        <li><a href="#">Support</a></li>
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