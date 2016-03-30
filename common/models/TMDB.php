<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 3/30/2016
 * Time: 1:25 PM
 */

namespace common\models;

use Yii;
use yii\helpers\Url;


class TMDB
{
    private $data;

    public static function initWithData($data)
    {
        $instance = new self();
        $instance->data = $data;
        return $instance;
    }

    public static function getUpcoming($page = 1)
    {
        $movies = array();
        $results = Yii::$app->tmdb->getUpComing($page);
        foreach($results['results'] as $result)
        {
            $movies[] = TMDB::initWithData($result);
        }
        return [$results['total_pages'],$results['total_results'],$movies];
    }

    public function getTmdb_id()
    {
        return $this->data['id'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getPoster($size)
    {
        if(isset($this->data['poster_path']))
            return Yii::$app->tmdb->config['images']['base_url'].$size.$this->data['poster_path'];
        else
            return Url::to('@web/img/movie_default.jpg');
    }

    public function getTrailers()
    {
        return $this->data['trailers']['youtube'];
    }

    public function getBackdrops($size)
    {
        $backdrops = array();
        if(isset($this->data['images']['backdrops']))
        {
            foreach($this->data['images']['backdrops'] as $image)
                $backdrops[] = Yii::$app->tmdb->config['images']['base_url'].$size.$image['file_path'];
        }
        return $backdrops;
    }

    public function getBackdrop($size)
    {
        return Yii::$app->tmdb->config['images']['base_url'].$size.$this->data['backdrop_path'];
    }

    public function getReleaseDate()
    {
        return $this->data['release_date'];
    }

    public function getRuntime()
    {
        return $this->data['runtime'];
    }

    public function getOverview()
    {
        return $this->data['overview'];
    }

}