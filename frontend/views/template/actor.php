<div class="grid-boxes-in hover-shadow">
    <a href="/actors/<?= $cast->getId().'-'.strtolower(urlencode($cast->getName()))?>">
        <img class="img-responsive" src="<?= $cast->getAvatar('w342');?>" alt="">
    </a>
    <div class="grid-boxes-caption">
        <h3><a href="/actors/<?= $cast->getId().'-'.strtolower(urlencode($cast->getName()))?>"><?= $cast->getName();?></a></h3>
        <ul class="list-inline grid-boxes-news">
            <li><?= $cast->getMovies()?>&nbsp;movies</li>
        </ul>
    </div>
</div>
