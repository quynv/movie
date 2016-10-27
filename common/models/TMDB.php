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

    public function exportMovie()
    {
        $movie = new Movie();
        $movie->title = $this->getTitle();
        $movie->overview = $this->getOverview();
        $movie->poster = $this->data['poster_path'];
        $movie->backdrop = $this->data['backdrop_path'];
        $movie->released_at = $this->getReleaseDate();
        $movie->imdb_id = $this->getImdb_id();
        $movie->tmdb_id = $this->getTmdb_id();
        return $movie;
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

    public static function getMovie($id)
    {
        $result = Yii::$app->tmdb->getMovie($id);
        if($result)
        {
            return TMDB::initWithData($result);
        }
        return null;
    }

    public function getTmdb_id()
    {
        return $this->data['id'];
    }

    public function getImdb_id()
    {
        return $this->data['imdb_id'];
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

    public function getGenres()
    {
        return $this->data['genres'];
    }

    public function getDirectors()
    {
        $results = [];
        foreach($this->data['casts']['crew'] as $crew)
        {
            if($crew['job'] == 'Director')
            {
                $results[] = [
                    'id' => $crew['id'],
                    'name' => $crew['name'],
                    'avatar' => $crew['profile_path']
                ];
            }
        }
        return $results;
    }

    public function getCasts()
    {
        $results = [];
        foreach($this->data['casts']['cast'] as $cast)
        {
            $results[] = [
                'id' => $cast['id'],
                'name' => $cast['name'],
                'avatar' => $cast['profile_path']
            ];
        }
        return $results;
    }

    public function getCompanies()
    {
        return $this->data['production_companies'];
    }

}