<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 2/1/2016
 * Time: 3:56 PM
 */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/active_account', 'token' => $user->access_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to confirm your email:

<?= $resetLink ?>
