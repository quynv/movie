<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!--=== Slider ===-->
<div class="ms-layers-template">
    <!-- masterslider -->
    <div class="master-slider ms-skin-black-2 round-skin" id="masterslider">
        <?php foreach( $movies as $key => $movie ){?>
            <div class="ms-slide">
                <?= Html::img('@web/js/plugins/masterslider/style/blank.gif',
                    ['data-src'=>Url::to($movie->getBackdrop('w1280'))])
                ?>

                <!--            <video data-autopause="false" data-mute="true" data-loop="true" data-fill-mode="fill">-->
                <!--                <source id="mp4" src="http://media.w3.org/2010/05/bunny/trailer.mp4" type="video/mp4"/>-->
                <!--                <source id="ogv" src="http://media.w3.org/2010/05/bunny/trailer.ogv" type="video/ogg"/>-->
                <!--            </video>-->

                <h3 class="ms-layer ms-promo-info color-light"  style="left:10px; top:170px; color: #fff!important;"
                    data-effect="bottom(20)"
                    data-duration="1300"
                    data-delay="1300"
                    data-ease="easeOutExpo"
                    >Now playing</h3>

                <h3 class="ms-layer ms-promo-info-in color-light"  style="left:10px; top:245px"
                    data-effect="left(100)"
                    data-duration="2300"
                    data-delay="900"
                    data-ease="easeOutExpo"
                    ><span class="color-green"><?= $movie->getTitle() ?></span></h3>

                <h3 class="ms-layer normal-title color-light"  style="left:10px; top:312px; color: #fff!important;"
                    data-effect="bottom(20)"
                    data-duration="1300"
                    data-delay="1000"
                    data-ease="easeOutExpo"
                    >Release at <?= $movie->getReleaseDate()?></h3>

                <a class="btn-u btn-brd btn-brd-width-2 btn-brd-hover btn-u-light rounded-4x ms-layer ms-promo-sub ms-promo-sub-in color-light"  style="left:10px; top:360px"
                   data-effect="right(40)"
                   data-duration="1300"
                   data-delay="1300"
                   data-ease="easeOutExpo"
                   href="#"
                    >View all</a>
            </div>
        <?php } ?>
    </div>
    <!-- end of masterslider -->
</div>
<!--=== End Slider ===-->