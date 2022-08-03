<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\EntryForm;
use app\models\RegistrationForm;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            return $this->render('registration-confirm', ['model' => $model]);
        } else {
            return $this->render('registration', ['model' => $model]);
        }
    }


    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('entry', ['model' => $model]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        {
            $model = new EntryForm();
            $model_reg = new RegistrationForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = User::findOne([
                    'email' => $model->email,
                ]);
                if (!empty($user)) {
                    if (Yii::$app->getSecurity()->validatePassword($model->password, $user->pass)){
                        return $this->render('entry-confirm', ['model' => $model, 'name'=>$user->name]);
                    }
                }
                $model->addError('email','Пользователь не найден в системе.');
            }
            if ($model_reg->load(Yii::$app->request->post()) && $model_reg->validate()) {
                $user = new User([
                    'email' => $model_reg->email,
                    'name' => $model_reg->name,
                    'pass' => Yii::$app->getSecurity()->generatePasswordHash($model_reg->password),

                ]);
               if ($user->save()) {
                   return $this->render('registration-confirm', ['model' => $model_reg, 'model_entry' => $model]);
               }else $model_reg->addError('email','Пользователь с таким Email уже существует.');
            }

            return $this->render('entry', ['model' => $model, 'model_reg' => $model_reg]);
        }
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
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
    public function actionAbout()
    {
        return $this->render('about');
    }
}
