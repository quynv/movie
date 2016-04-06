<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/1/2016
 * Time: 11:56 PM
 */
namespace common\components;

use yii\base\Component;
use Yii;

class AVATAR extends Component
{
    public function getAvatar($service, $user_id, $size)
    {
        $url = null;
        switch ($service) {

            case "google":
                $url = "http://profiles.google.com/s2/photos/profile/" . $user_id . "?sz=" . $size;
                break;
            case "facebook":
                // available sizes: square (50x50), small (50xH) , normal (100xH), large (200xH)
                $size_param = null;
                if (is_numeric($size)) {
                    if ($size >= 200) {
                        $size_param = 'large';
                    };
                    if ($size >= 100 && $size < 200) {
                        $size_param = 'normal';
                    };
                    if ($size >= 50 && $size < 100) {
                        $size_param = 'small';
                    };
                    if ($size < 50) {
                        $size_param = 'square';
                    };
                } else {
                    $size_param = 'normal';
                }
                $url = "https://graph.facebook.com/" . $user_id . "/picture?type=" . $size_param;
                break;
            case "twitter":
                // available sizes: bigger (73x73), normal (48x48), mini (24x24), no param will give you full size
                $size_param = null;
                if (is_numeric($size)) {
                    if ($size >= 73) {
                        $size_param = 'bigger';
                    };
                    if ($size >= 48 && $size < 73) {
                        $size_param = 'normal';
                    };
                    if ($size < 48) {
                        $size_param = 'mini';
                    };
                } else {
                    $size_param = 'normal';
                }

                $url = "http://api.twitter.com/1/users/profile_image?screen_name=" . $user_id . "&size=" . $size_param;
                break;
        }
        return $url;
    }
}