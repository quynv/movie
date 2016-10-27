<script>
    jQuery(document).ready(function() {
        App.init();
//        OwlCarousel.initOwlCarousel();
    });
    var slider = new MasterSlider();
    slider.setup('masterslider' , {
        width           : 1360,
        height          : 750,
        minHeight       : 0,
        space           : 0,
        start           : 1,
        grabCursor      : false,
        swipe           : true,
        mouse           : true,
        layout          : "fullwidth",
        autoplay        : true,
        loop            : true,
        shuffle         : false,
        preload         : 0,
        heightLimit     : true,
        autoHeight      : false,
        smoothHeight    : true,
        endPause        : false,
        overPause       : true,
        fillMode        : "fill",
        centerControls  : true,
        startOnAppear   : false,
        layersMode      : "center",
        autofillTarget  : "",
        hideLayers      : false,
        fullscreenMargin: 0,
        speed           : 20,
        dir             : "h",
        view            : "basic"
    });
    slider.control('arrows');
</script>