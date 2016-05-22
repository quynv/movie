<?php
namespace frontend\controllers;

use common\models\Movie;
use common\models\TMDB;
use frontend\controllers\base\BaseController;
use Yii;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "@app/views/layouts/base";

        list($total_pages, $total_items, $comings) = TMDB::getUpcoming();

        $date = \Yii::$app->getRequest()->getQueryParam('date');
        $title = \Yii::$app->getRequest()->getQueryParam('title');

        $filter = '';

        if($date == 'asc' || $date == 'desc')
        {
            $filter .= ',released_at '.strtoupper($date);
        }

        if($title == 'asc' || $title == 'desc')
        {
            $filter .= ',title '.strtoupper($title);
        }

        if($filter == '')
        {
            $filter .= 'id DESC';
        }

        $query = Movie::find()->orderBy($filter);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(20);
        $movies = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'comings' => $comings,
            'movies' => $movies,
            'pages' => $pages
        ]);
    }

//    /**
//     * Displays contact page.
//     *
//     * @return mixed
//     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending email.');
//            }
//
//            return $this->refresh();
//        } else {
//            return $this->render('contact', [
//                'model' => $model,
//            ]);
//        }
//    }

//    /**
//     * Displays about page.
//     *
//     * @return mixed
//     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }

//    /**
//     * Requests password reset.
//     *
//     * @return mixed
//     */
//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }

//    /**
//     * Resets password.
//     *
//     * @param string $token
//     * @return mixed
//     * @throws BadRequestHttpException
//     */
//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidParamException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password was saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }

    public function actionRender()
    {
        if(Yii::$app->request->isAjax)
        {
            $movies = null;
            if(Yii::$app->request->isGet)
            {
                $movies = Movie::find()
                    ->orderBy(new Expression('rand()'))
                    ->limit(10)
                    ->all();
            }
            elseif(Yii::$app->request->isPost)
            {
                $text = Yii::$app->request->post('keyword');
                $year = Yii::$app->request->post('year');
                $genre = Yii::$app->request->post('genre');
                $query = Movie::find();
                if($text) {
                    $query->andWhere(['LIKE', 'title', $text]);
                }
                if($year) {
                    $query->andWhere(['YEAR(`released_at`)' => $year]);
                }
                if($genre) {
                    $query->joinWith('genres')->andwhere(['genres.id' => $genre]);
                }
                $movies = $query->limit(10)->all();
            }

            return $this->renderPartial('//template/render',['movies' => $movies]);
        }
        else
        {
            throw new NotFoundHttpException('Page not found');
        }
    }
}
