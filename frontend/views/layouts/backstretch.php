<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
    $.backstretch([
        <?php foreach($images as $image)?>
        <?= "'".$image ."',"?>
    ], {
        fade: 1000,
        duration: 7000
    });
</script>