<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\Favourite;

/**
 * This is the model class for table "movies".
 *
 * @property integer $id
 * @property string $title
 * @property string $overview
 * @property string $poster
 * @property string $backdrop
 * @property integer $runtime
 * @property string $released_at
 * @property integer $tmdb_id
 * @property string $imdb_id
 */
class Movie extends ActiveRecord
{
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
            [['overview'], 'string'],
            [['id', 'runtime', 'tmdb_id'], 'integer'],
            [['released_at'], 'safe'],
            [['title'], 'string', 'max' => 400],
            [['poster', 'backdrop'], 'string', 'max' => 255],
            [['imdb_id'], 'string', 'max' => 20]
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
            'overview' => Yii::t('app', 'Overview'),
            'poster' => Yii::t('app', 'Poster'),
            'backdrop' => Yii::t('app', 'Backdrop'),
            'runtime' => Yii::t('app', 'Runtime'),
            'released_at' => Yii::t('app', 'Released At'),
            'tmdb_id' => Yii::t('app', 'Tmdb ID'),
            'imdb_id' => Yii::t('app', 'Imdb ID'),
        ];
    }

    public function getPoster($size)
    {
        if(isset($this->poster))
            return Yii::$app->tmdb->config['images']['base_url'].$size.$this->poster;
        else
            return Url::to('@web/img/movie_default.jpg');
    }

    public function getBackdrop($size)
    {
        return Yii::$app->tmdb->config['images']['base_url'].$size.$this->backdrop;
    }

    public function getFavourites()
    {
        return $this->hasMany(Favourite::className(), ['movie_id' => 'id']);
    }

    public function getInfavourite()
    {
        return Favourite::findOne(['movie_id' => $this->id, 'user_id' => Yii::$app->user->id]);
    }

    public function getRated()
    {
        $rate = Rating::findOne(['movie_id' => $this->id, 'user_id' => Yii::$app->user->id]);
        if($rate)
            return $rate->rating;
        else return null;
    }

    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['movie_id' => 'id']);
    }

    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id' => 'company_id'])
            ->viaTable('movies_companies', ['movie_id' => 'id']);
    }

    public function getCasts()
    {
        return $this->hasMany(Cast::className(), ['id' => 'cast_id'])
            ->viaTable('movies_actors', ['movie_id' => 'id']);
    }

    public function getDirectors()
    {
        return $this->hasMany(Cast::className(), ['id' => 'cast_id'])
            ->viaTable('movies_directors', ['movie_id' => 'id']);
    }

    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])
            ->viaTable('movies_genres', ['movie_id' => 'id']);
    }

    public function getVideos()
    {
        $videos = Yii::$app->tmdb->getVideos($this->tmdb_id);
        $results = array();
        foreach($videos['results'] as $result)
        {
            if($result['site'] == 'YouTube')
            {
                $results[] = [
                    'name' => $result['name'],
                    'source' => $result['key']
                ];
            }
        }
        return $results;
    }

    public function getImages($size)
    {
        $images = Yii::$app->tmdb->getImages($this->tmdb_id);
        $results = array();
        foreach($images['posters'] as $result)
        {
            $results[] = Yii::$app->tmdb->config['images']['base_url'].$size.$result['file_path'];
        }
        return $results;
    }

    public function getAverage()
    {
        $ratings = $this->ratings;
        $total = 0;
        $count = 0;
        foreach($ratings as $rating)
        {
            $count += 1;
            $total += $rating->rating;
        }
         return $count == 0?0:$total/$count;
    }

    public static function initByArray($array)
    {
        $result = array();
        foreach($array as $item)
        {
            $result[] = self::findOne(['id' => $item['id']]);
        }
        return $result;
    }

    public static function getTopNRatings($n)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT `movies`.`id`, AVG(`ratings`.`rating`) as average
            FROM `movies`, `ratings`
            WHERE `movies`.`id` = `ratings`.`movie_id`
            GROUP BY `ratings`.`movie_id`
            ORDER BY average DESC
        ');
        $movies = $command->queryAll();
        return self::initByArray(array_slice($movies, 0, $n));
    }

    public static function getTopNPopulars($n)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('
            SELECT `movies`.`id`, COUNT(`ratings`.`movie_id`) as popular
            FROM `movies`, `ratings`
            WHERE `movies`.`id` = `ratings`.`movie_id`
            GROUP BY `ratings`.`movie_id`
            ORDER BY popular DESC
        ');
        $movies = $command->queryAll();
        return self::initByArray(array_slice($movies, 0, $n));
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
}
