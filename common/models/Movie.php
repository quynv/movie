<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "movies".
 *
 * @property integer $id
 * @property string $title
 * @property string $imdb_id
 * @property string $tmdb_id
 */
class Movie extends ActiveRecord
{
    private $data;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['imdb_id', 'tmdb_id'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'imdb_id' => Yii::t('app', 'Imdb ID'),
            'tmdb_id' => Yii::t('app', 'Tmdb ID'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->data = Yii::$app->tmdb->getMovie(str_replace(array("\r\n", "\r",","), "", $this->tmdb_id));
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public static function initWithData($data)
    {
        $instance = new self();
        $instance->data = $data;
        return $instance;
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

    public function getImages($size)
    {
        $images = array();
        if(isset($this->data['images']['posters']))
        {
            foreach($this->data['images']['posters'] as $image)
                $images[] = Yii::$app->tmdb->config['images']['base_url'].$size.$image['file_path'];
        }
        return $images;
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

    public function getHomepage()
    {
        return $this->data['homepage'];
    }

    public function getCompanies()
    {
        return $this->data['production_companies'];
    }

    public function getCountries()
    {
        return $this->data['production_countries'];
    }

    public function getCasts()
    {
        $casts = array();
        if(isset($this->data['casts']['cast']))
        {
            foreach($this->data['casts']['cast'] as $user)
                if($user['profile_path'])
                {
                    $casts[] = [
                        'name' => $user['name'],
                        'avatar' => Yii::$app->tmdb->config['images']['base_url'].'w185'.$user['profile_path']
                    ];
                }
                else
                {
                    $casts[] = [
                        'name' => $user['name'],
                        'avatar' => null
                    ];
                }
        }
        return $casts;
    }

    public function getCrews()
    {
        $crews = array();
        if(isset($this->data['casts']['crew']))
        {
            foreach($this->data['casts']['crew'] as $user)
                if($user['profile_path'])
                {
                    $crews[] = [
                        'name' => $user['name'],
                        'avatar' => Yii::$app->tmdb->config['images']['base_url'].'w185'.$user['profile_path']
                    ];
                }
                else
                {
                    $crews[] = [
                        'name' => $user['name'],
                        'avatar' => null
                    ];
                }
        }
        return $crews;
    }

    public static function getUpcoming($page = 1)
    {
        $movies = array();
        $results = Yii::$app->tmdb->getUpComing($page);
        foreach($results['results'] as $result)
        {
            $movies[] = Movie::initWithData($result);
        }
        return [$results['total_pages'],$results['total_results'],$movies];
    }

    public static function searchMovie($title, $year, $page)
    {
        $movies = array();
        $results = Yii::$app->tmdb->searchMovie($title, $year, $page);
        foreach($results['results'] as $result)
        {
            $movies[] = Movie::initWithData($result);
        }
        return [$results['total_pages'],$movies];
    }

    public static function getVideos($movieId)
    {
        $videos = Yii::$app->tmdb->getVideos(str_replace(array("\r\n", "\r",","), "", $movieId));
        return $videos['results'];
    }

    public static function getPictures($movieId)
    {
        return Yii::$app->tmdb->getImages(str_replace(array("\r\n", "\r",","), "", $movieId));
    }

    public static function getCredits($movieId)
    {
        return Yii::$app->tmdb->getCredits(str_replace(array("\r\n", "\r",","), "", $movieId));
    }

    public static function getNowPlaying($page=1 ,$size=10)
    {
        $movies = array();
        $results = Yii::$app->tmdb->getNowPlaying($page);
        $count = 0;
        foreach($results['results'] as $result)
        {
            if($count == $size) break;
            $count++;
            $movie = Movie::initWithData($result);
            $movies[] = $movie;
        }
        return $movies;
    }

    public static function setRequireData($movies)
    {
        foreach($movies as $movie)
        {
            $movie->setData(Yii::$app->tmdb->getMovie(str_replace(array("\r\n", "\r",","), "", $movie->tmdb_id)));
        }
        return $movies;
    }

    public static function getUserBaseRecommends($user, $num)
    {
        $others = Rating::find()->select('user_id')->distinct()->all();
        $user_rated = ArrayHelper::map(Rating::find()->select(['movie_id', 'rating'])->where(['user_id' => $user->id])->asArray()->all(), 'movie_id', 'rating');
        $totals = array();
        $simSums = array();
        foreach($others as $other)
        {
            if($user->id == $other->user_id) continue;

            $other_rated = ArrayHelper::map(Rating::find()->select(['movie_id', 'rating'])->where(['user_id' => $other->user_id])->asArray()->all(), 'movie_id', 'rating');

            $sim = Rating::similarity($user_rated, $other_rated);

            if($sim <= 0) continue;
            foreach($other_rated as $key => $value)
            {
                if(!isset($user_rated[$key]) || $user_rated[$key] == 0)
                {
                    if(isset($totals[$key]))
                        $totals[$key] += $value * $sim;
                    else $totals[$key] = $value * $sim;

                    if(isset($simSums[$key]))
                        $simSums[$key] += $sim;
                    else $simSums[$key] = $sim;
                }
            }
        }
        $rankings = array();
        foreach($totals as $item => $total)
        {
            $rankings[$item] = $total/$simSums[$item];
        }

        arsort($rankings);
        $i = 0;
        $recommend = array();
        foreach($rankings  as $key => $value)
        {
            if($i == $num) break;
            $i++;
            $recommend[] = Movie::findOne(['id' => $key]);
        }
        return $recommend;
    }

    public static function getItemBasedRecommends($movie, $num)
    {
        $others = Rating::find()->select('movie_id')->where([''])->distinct()->all();

    }

    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['movie_id' => 'id']);
    }

    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])
                    ->viaTable('movies_genres', ['movie_id' => 'id']);
    }
}
