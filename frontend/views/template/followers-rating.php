<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($followers as $user) {?>
        <tr>
            <td><a href="/u/<?= $user['username']?>/favourites"><?= $user['username']?></a></td>
            <td><?= $user['rating']?>&nbsp;&nbsp;<i class="fa fa-star"></i></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
