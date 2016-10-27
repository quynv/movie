//Masonry js functions

function loadMasonry()
{
    var $container = $('.rating-container');

    var gutter = 20;
    var min_width = 200;
    $container.imagesLoaded( function(){
        $container.masonry({
            itemSelector : '.grid-boxes-in',
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
    var $container = $('.rating-container');
    setTimeout(function(){ $container.masonry() }, 400);
}

function lockScroll()
{
    // lock scroll position, but retain settings for later
    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
    ];
    var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
    html.data('scroll-position', scrollPosition);
    html.data('previous-overflow', html.css('overflow'));
    html.css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function unlockScroll()
{
    var html = jQuery('html');
    var scrollPosition = html.data('scroll-position');
    html.css('overflow', html.data('previous-overflow'));
    window.scrollTo(scrollPosition[0], scrollPosition[1])
}