<?php

$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/plugins/cubeportfolio/js/jquery.cubeportfolio.js',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/plugins/cube-portfolio-3-ns.js',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/js/plugins/cubeportfolio/css/cubeportfolio.min.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/js/plugins/cubeportfolio/custom/custom-cubeportfolio.css',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="cube-portfolio container margin-bottom-60">
    <div id="grid-container" class="cbp-l-grid-agency">
        <?php if(isset($images)){ foreach($images as $image) {?>
        <div class="cbp-item">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="<?= $image ?>">
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <ul class="link-captions">
                                <li><a href="<?= $image?>" class="cbp-lightbox"><i class="rounded-x fa fa-search"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }} else {?>
            <div class="cbp-item">
                <div class="cbp-caption">
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?= $backdrop?>">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignCenter">
                            <div class="cbp-l-caption-body">
                                <ul class="link-captions">
                                    <li><a href="<?= $backdrop?>" class="cbp-lightbox"><i class="rounded-x fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div><!--/end Grid Container-->
</div>
