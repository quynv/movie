<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/2/2016
 * Time: 12:45 AM
 */

namespace frontend\controllers;


use common\models\Movie;
use common\models\User;
use frontend\controllers\base\BaseController;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\filters\AccessControl;

class UsersController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['detail', 'search'],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = User::find();
        $text = \Yii::$app->getRequest()->getQueryParam('keyword');
        if($text) {
            $query->andFilterWhere(['like', 'username', $text]);
        }
        $pagination = new Pagination(['totalCount' => $query->count()]);

        $users = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'users' => $users,
            'pages' => $pagination
        ]);
    }

    private function checkExist($username)
    {
        $user = User::findOne(['username' => $username]);
        if(!$user)
        {
            throw new NotFoundHttpException($username." not found");
        }
        return $user;
    }

    public function actionFavourites($username)
    {
        $user = $this->checkExist($username);
        $query = $user->getFavourites();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->route = '/u/'.$username.'/favourites';
        $movies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('favourites', [
            'user' => $user,
            'movies' => $movies,
            'pages' => $pagination
        ]);
    }

    public function actionRatings($username)
    {
        $user = $this->checkExist($username);
        $query = Movie::find()->select(['movies.*', 'ratings.rating'])->innerJoinWith('ratings', false)->where(['user_id' => $user->id])->asArray();
        $id = \Yii::$app->getRequest()->getQueryParam('id');
        $title = \Yii::$app->getRequest()->getQueryParam('title');
//        $rating = \Yii::$app->getRequest()->getQueryParam('ratings');
        if($id)
        {
            $query->andWhere(['movies.id' => $id]);
        }
        if($title)
        {
            $query->andWhere(['LIKE', 'movies.title', $title]);
        }
//        if($rating)
//        {
//            $query->andWhere(['ratings.rating' => $rating]);
//        }

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->route = '/u/'.$username.'/ratings';
        $movies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('ratings', [
            'user' => $user,
            'movies' => $movies,
            'pages' => $pagination
        ]);
    }

    public function actionFollowing($username)
    {
        $user = $this->checkExist($username);
        $query = $user->getFollowing();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->route = '/u/'.$username.'/following';
        $following = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('following', [
            'user' => $user,
            'following' => $following,
            'pages' => $pagination
        ]);
    }

    public function actionFollowers($username)
    {
        $user = $this->checkExist($username);
        $query = $user->getFollowers();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->route = '/u/'.$username.'/followers';
        $followers = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('followers', [
            'user' => $user,
            'followers' => $followers,
            'pages' => $pagination
        ]);
    }
    public function actionNotifications($username)
    {
        $user = $this->checkExist($username);
        if($user->id != \Yii::$app->user->id)
        {
            throw new NotFoundHttpException("Page not found");
        }
        $query = $user->getNotifications();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->route = '/u/'.$username.'/notifications';
        $notifications = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('notifications', [
            'user' => $user,
            'notifications' => $notifications,
            'pages' => $pagination
        ]);
    }
}