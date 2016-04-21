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
                if(!is_numeric($size)) $size = 240;
                $url = "http://res.cloudinary.com/demo/image/gplus/w_".$size."/".$user_id.".jpg";
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
                if(!is_numeric($size)) $size = 240;
                $url = "http://res.cloudinary.com/demo/image/twitter/w_".$size."/".$user_id.".jpg";
                break;
            case "gravatar":
                if(!is_numeric($size)) $size = 240;
                $url = "https://s.gravatar.com/avatar/".$user_id."?s=".$size;
                break;
        }
        return $url;
    }
}