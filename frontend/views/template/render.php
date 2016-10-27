<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Please rating <?= $this->context->required['remain']?> movies</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <form class="form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="query-text">Title</label>
                <input type="text" name="keyword" class="form-control" id="query-text" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label class="sr-only" for="query-year">Year</label>
                <input type="text" name="year" class="form-control" id="query-year" placeholder="Year">
            </div>
            <div class="form-group">
                <label class="sr-only" for="query-genre">Genre</label>
                <select name="genre" id="query-genre" class="form-control">
                    <option value="">- Please Select Genre -</option>
                    <?php foreach($this->context->genres as $genre){?>
                        <option value="<?= $genre->id?>"><?= $genre->name?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <button type="button" class="btn-u btn-u-green" id="rating-modal-search-btn">Search</button>
            </div>
        </form>
    </div>
    <br>
    <br>
    <div class="rating-container">
        <?php foreach($movies as $movie){?>
            <?= $this->render('//template/partial',['movie' => $movie]);?>
        <?php } ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary disabled">Continue</button>
</div>