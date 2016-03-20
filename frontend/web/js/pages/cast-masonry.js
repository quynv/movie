//Masonry js functions
$(document).ready(function(){
    loadMasonry();
    $('.cast').on('click', function(){
        reloadMasonry();
    });
    $('.crew').on('click', function(){
        reloadMasonry();
    });
});

function loadMasonry()
{
    var $container = $('.casts-container');

    var gutter = 20;
    var min_width = 200;
    $container.imagesLoaded( function(){
        $container.masonry({
            itemSelector : '.casts-item',
            gutterWidth: gutter,
            isAnimated: true,
            columnWidth: function( containerWidth ) {
                var box_width = (((containerWidth - 5*gutter)/6) | 0) ;

                if (box_width < min_width) {
                    box_width = (((containerWidth - 4*gutter)/5) | 0);
                }

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
}

function reloadMasonry()
{
    var $container = $('.casts-container');
    setTimeout(function(){ $container.masonry() }, 400);
}