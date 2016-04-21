<?php
namespace frontend\controllers\utilities;
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 1/22/2016
 * Time: 11:21 PM
 */
class Common
{
    public static function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'') .' ago';
        }

    }
}