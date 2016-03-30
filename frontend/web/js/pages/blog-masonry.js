//Masonry js functions
$(document).ready(function(){
    var $container = $('.grid-boxes');

    var gutter = 20;
    var min_width = 200;
    $container.imagesLoaded( function(){
        $container.masonry({
            itemSelector : '.grid-boxes-in',
            gutterWidth: gutter,
            isAnimated: true,
            columnWidth: function( containerWidth ) {
                var box_width = (((containerWidth - 4*gutter)/5) | 0) ;

                if (box_width < min_width) {
                    box_width = (((containerWidth - 3*gutter)/4) | 0);
                }

                if (box_width < min_width) {
                    box_width = (((containerWidth - 2*gutter)/3) | 0);
                }

                if (box_width < min_width) {
                    box_width = (((containerWidth - gutter)/2) | 0);
                }

                if (box_width < min_width) {
                    box_width = containerWidth;
                }

                $('.grid-boxes-in').width(box_width);

                return box_width;
            }
        });
    });
});
