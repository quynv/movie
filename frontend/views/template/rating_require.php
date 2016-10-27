<div class="modal fade" id="rating-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-rating">
        <div class="modal-content" id="render-rating">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        lockScroll();
        $('#render-rating').append('<div class="loader"></div>');
        $('#rating-modal').modal({
            backdrop: 'static',
            keyboard: false
        },'show');
        $.ajax({
            url: '/site/render',
            method: 'get',
            success: function(data) {
                $('#render-rating').html(data);
                unlockScroll();
                loadMasonry();
            },
            error: function() {
                unlockScroll();
            }
        });

    });
    $(document).on('click', '#rating-modal-search-btn', function(){
        var keyword = $('#query-text').val();
        var year = $('#query-year').val();
        var genre = $('#query-genre').val();
        lockScroll();
        $('#render-rating').html('<div class="loader"></div>');
        $.ajax({
            url: '/site/render',
            data: {keyword: keyword, year: year, genre: genre},
            method: 'post',
            success: function(data) {
                $('#render-rating').html(data);
                unlockScroll();
                loadMasonry();
            },
            error: function() {
                unlockScroll();
            }
        });
    });
</script>