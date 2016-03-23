<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 2/4/2016
 * Time: 1:26 PM
 */

namespace common\components;

use yii\base\Component;
use Yii;

class TMDB extends Component
{
    public $apiKey;
    public $language;
    public $debug;
    public $config;

    const _API_URL_ = "http://api.themoviedb.org/3/";
    const _MOVIE_ = 'movie/';
    const _SEARCH_ = 'search/movie';
    const _UPCOMING_ = 'movie/upcoming';
    const _NOW_PLAYING_ = 'movie/now_playing';
    const _VIDEOS_ = '/videos';
    const _IMAGES_ = '/images';
    const _CREDIT_ = '/credits';


    public function init()
    {
        parent::init();
        $this->debug = false;
        $this->config = $this->configuration();
    }

    public function setLanguage($language='en')
    {
        return $this->language = $language;
    }

    public function getUpComing($page = 1)
    {
        return self::get(self::_UPCOMING_, 'page='.$page);
    }

    public function searchMovie($movieTitle, $year=null, $page=1)
    {
        $append_to_response = 'query='. urlencode($movieTitle).'&page='.$page;
        if($year){
            $append_to_response .= '&year='.$year;
        }
        return self::get(self::_SEARCH_, $append_to_response);
    }

    public function getMovie($movieId)
    {
        $action = self::_MOVIE_.$movieId;
        $append_to_response = 'append_to_response=trailers,images,casts';
        return self::get($action, $append_to_response);
    }

    public function getVideos($movieId)
    {
        $action = self::_MOVIE_.$movieId.self::_VIDEOS_;
        $append_to_response = 'append_to_response=images,casts';
        return self::get($action, $append_to_response);
    }

    public function getImages($movieId)
    {
        $action = self::_MOVIE_.$movieId.self::_IMAGES_;
        $append_to_response = 'append_to_response=images,casts';
        return self::get($action, $append_to_response);
    }

    public function getCredits($movieId)
    {
        $action = self::_MOVIE_.$movieId.self::_CREDIT_;
        $append_to_response = 'append_to_response=images,casts';
        return self::get($action, $append_to_response);
    }

    public function getNowPlaying($page=1)
    {
        return self::get(self::_NOW_PLAYING_, 'page='.$page);
    }

    private function get($action, $append_to_response)
    {
        $url = self::_API_URL_.$action.
                '?api_key='.$this->apiKey.
                '&language='.$this->language.
                '&'.$append_to_response;
        if($this->debug)
        {
            echo '<pre><a href="' . $url . '">check request</a></pre>';
        }

        return $this->request($url);
    }

    private function configuration()
    {
        $url = self::_API_URL_."configuration".
                '?api_key='.$this->apiKey;
        return $this->request($url);
    }

    private function request($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        $results = curl_exec($ch);
        curl_close($ch);
        return (array) json_decode(($results), true);
    }

}