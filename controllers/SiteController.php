<?php

namespace app\controllers;

use app\models\Category;
use app\models\Contact;
use app\models\Post;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Homepage
     *
     * @return string
     */
    public function actionIndex(): string
    {
        // Initialize the query
        $query = Post::find();

        // Check if there is a user (author) ID parameter
        $userId = Yii::$app->request->get('author');
        if ($userId !== null) {
            $query->andWhere(['user_id' => $userId]);
        }

        // Check if there is a category ID parameter
        $categoryId = Yii::$app->request->get('category');
        if ($categoryId !== null) {
            $query->andWhere(['category_id' => $categoryId]);
        }

        // Create a data provider
        $postDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => Yii::$app->params['pageSize']],
        ]);
        $posts = $postDataProvider->getModels();
        $pagination = $postDataProvider->getPagination();

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }


    /**
     * Displays a single Post model.
     *
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        $post = Post::findOne($id);
        if ($post === null) {
            throw new NotFoundHttpException('The requested article does not exist.');
        }

        return $this->render('view', ['post' => $post]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $contact = new Contact();
            $contact->attributes = $model->attributes; // simple assignment

            if ($contact->save()) {
                Yii::$app->session->setFlash('contactFormSubmitted', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('contactFormFailed', 'There was an error sending your message.');
            }

            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }

    /**
     * @return void
     */
    public function actionPostsByAuthor()
    {
        
    }

    /**
     * @return void
     */
    public function actionPostsByCategory()
    {
        
    }
}
