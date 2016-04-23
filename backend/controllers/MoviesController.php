<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 9:54 PM
 */

namespace backend\controllers;


use backend\models\forms\TmdbForm;
use backend\models\MovieSearch;
use common\models\Cast;
use common\models\Company;
use common\models\Genre;
use common\models\Movie;
use common\models\TMDB;
use yii\web\Controller;
use Yii;

class MoviesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new MovieSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionView($id)
    {
        $model = Movie::findOne(['id' => $id]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $movie = Movie::findOne(['id' => $id]);
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
            $this->unlinkActors($movie, $movie->genres);
            $this->unlinkCompanies($movie, $movie->companies);
            $this->unlinkGenres($movie, $movie->genres);
            $this->unlinkDirectors($movie, $movie->directors);
            $movie->delete();
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'This record has been deleted successfully.');
        }
        catch(\ErrorException $e)
        {
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', 'An error occurred while trying delete this record.');
        }
        $this->redirect(['movies/']);
    }

    public function actionNew()
    {
        $model = new TmdbForm();
        $temp = null;
        if($model->load(Yii::$app->request->get()))
        {
            if($model->find())
            {
                $temp = TMDB::getMovie($model->tmdb);
                if(isset(Yii::$app->request->get()['insert']))
                {
                    if($this->save($temp))
                    {
                        Yii::$app->session->setFlash('success', 'New record has been inserted successfully.');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('danger', 'An error occurred while trying insert new record.');
                    }
                }
            } else {
                Yii::$app->session->setFlash('danger', 'An error occurred while trying insert new record.');
            }
        }
        return $this->render('new',[
            'model' => $model,
            'movie' => $temp
        ]);
    }

    protected function save($data)
    {
        $movie = $data->exportMovie();
        $success = false;
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        if($movie->save(false))
        {
            try{
                $this->saveActors($movie, $data->getCasts());
                $this->saveCompanies($movie, $data->getCompanies());
                $this->saveDirectors($movie, $data->getDirectors());
                $this->saveGenres($movie, $data->getGenres());
                $transaction->commit();
                $success = true;
            }
            catch (\ErrorException $e)
            {
                $transaction->rollBack();
            }
        }

        return $success;
    }

    protected function saveDirectors($movie, $directors)
    {
        foreach($directors as $director)
        {
            $cast = Cast::findOne(['id' => $director['id']]);
            if(!$cast)
            {
                $cast = new Cast();
                $cast->id = $director['id'];
                $cast->name = $director['name'];
                $cast->avatar = $director['avatar'];
                $cast->save(false);
            }
            $movie->link('directors', $cast);
        }
    }

    protected function saveActors($movie, $actors)
    {
        foreach($actors as $actor)
        {
            $cast = Cast::findOne(['id' => $actor['id']]);
            if(!$cast)
            {
                $cast = new Cast();
                $cast->id = $actor['id'];
                $cast->name = $actor['name'];
                $cast->avatar = $actor['avatar'];
                $cast->save(false);
            }
            $movie->link('casts', $cast);
        }
    }

    protected function saveCompanies($movie, $companies)
    {
        foreach($companies as $company)
        {
            $new = Company::findOne(['id' => $company['id']]);
            if(!$new)
            {
                $new = new Company();
                $new->id = $company['id'];
                $new->name = $company['name'];
                $new->save(false);
            }
            $movie->link('companies', $new);
        }
    }

    protected function saveGenres($movie, $genres)
    {
        foreach($genres as $genre)
        {
            $tmp = Genre::findOne(['id' => $genre['id']]);
            $movie->link('genres', $tmp);
        }
    }

    protected function unlinkGenres($movie, $genres)
    {
        foreach($genres as $genre)
        {
            $movie->unlink('genres', $genre);
        }
    }

    protected function unlinkCompanies($movie, $companies)
    {
        foreach($companies as $company)
        {
            $movie->unlink('companies', $company);
        }
    }

    protected function unlinkActors($movie, $actors)
    {
        foreach($actors as $actor)
        {
            $movie->unlink('casts', $actor);
        }
    }

    protected function unlinkDirectors($movie, $directors)
    {
        foreach($directors as $director)
        {
            $movie->unlink('directors', $director);
        }
    }
}