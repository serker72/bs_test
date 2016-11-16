<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * @inheritdoc
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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
    
    // Всплывшее модальное окно заполняем представлением signup.php формы с полями
    public function actionShowClaim($id)
    {
            $model = new \app\models\Claim($id);
            //$model->id =$userid;
            
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string) $model->_id]);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('claim', [
                        'model' => $model
            ]);
        } else {
            return $this->render('claim', [
                        'model' => $model
            ]);
        }
    }

    // По нажатию в модальном окне на Отправить - форма отправляется администратору на почту     
    public function actionSubmitclaim()
    {
            $model = new \app\models\Claim();

            /*if ($model->load(Yii::$app->request->post()) && $model->save()) {

                //save the password
                $success=true;
                return json_encode($success);
            }
            else
            {
                $success=false;
                return json_encode($success);
            }*/

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            if($model->save()) {
                    //return $this->redirect('/site/confirm');
                $success=true;
                return json_encode($success);
            } else { 
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            
            return $this->renderAjax('claim', ['model' => $model]);
        }
    }    
}
