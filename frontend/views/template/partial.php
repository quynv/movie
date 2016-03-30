<div class="grid-boxes-in hover-shadow">
    <a href="javascript:void(0);">
        <img class="img-responsive" src="<?= $movie->getPoster('w342')?>" alt="">
    </a>
    <div class="">
        <h3><a href="javascript:void(0);"><?= $movie->title?></a></h3>
        <div class="grid-boxes-news">
            <div class="rating" data-rating="0" data-movie="1">
                <input type="radio" name="stars-rating-<?= $movie->id?>" id="stars-rating-5-<?= $movie->id?>" data-value="5">
                <label for="stars-rating-5-<?= $movie->id?>"></label>
                <input type="radio" name="stars-rating-<?= $movie->id?>" id="stars-rating-4-<?= $movie->id?>" data-value="4">
                <label for="stars-rating-4-<?= $movie->id?>"></label>
                <input type="radio" name="stars-rating-<?= $movie->id?>" id="stars-rating-3-<?= $movie->id?>" data-value="3">
                <label for="stars-rating-3-<?= $movie->id?>"></label>
                <input type="radio" name="stars-rating-<?= $movie->id?>" id="stars-rating-2-<?= $movie->id?>" data-value="2">
                <label for="stars-rating-2-<?= $movie->id?>"></label>
                <input type="radio" name="stars-rating-<?= $movie->id?>" id="stars-rating-1-<?= $movie->id?>" data-value="1">
                <label for="stars-rating-1-<?= $movie->id?>"></label>
            </div>
        </div>
    </div>
</div>
