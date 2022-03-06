<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Booking;
use app\models\BookingSearch;
use app\models\Dataset;
use app\models\DatasetSearch;
use app\models\CoachesMaster;
use app\models\CoachesMasterSearch;

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
        return $this->render('index');
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
    public function getTimeSlot($interval, $start_time, $end_time){
        $start = new \DateTime($start_time);
        $end = new \DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i=0;
        $time = [];
        while(strtotime($startTime) <= strtotime($endTime)){
            $start = $startTime;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $startTime = date('H:i',strtotime('+'.$interval.' minutes',strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)){
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }
    public function actionTimeslots($dataset_id){
        $dataset = Dataset::find()
                        ->where(['id'=>$dataset_id])
                        ->all();
        foreach ($dataset as $value) {
            $slots [] = $this->getTimeSlot(30, $value->available_at, $value->available_until);
        }
        if (!empty($slots)) {
            $response = ['response'=>'ok','message'=>'success', 'data'=>  ($slots[0])];
        }
        else{
            $response = 
                    ['response'=>'error','message'=>'error', 'data'=>   "No time slot avaliable"] ;

        }
        echo json_encode($response);
    }
    public function actionCoches($dataset_name){
        $dataset = Dataset::find()
            ->where(['name'=>$dataset_name])
            ->all();
        foreach ($dataset as $value) {
            $slots [] = $this->getTimeSlot(30, $value->available_at, $value->available_until);
        }
        if (!empty($slots)) {
            $response = ['response'=>'ok','message'=>'success', 'data'=>  ($slots[0])];
        }
        else{
            $response = 
                    ['response'=>'error','message'=>'error', 'data'=>   "No data avaliable"] ;

        }
        echo json_encode($response);
       
    }
    public function actionBooking(){
        $dataset = CoachesMaster::find()
                ->all();
        return $this->render('booking', [
            'cnames' => $dataset,
        ]); 
    }
    public function getDayFullName($day){
        $dayfm='';
        switch ($day) {
            case 'Sun':
                $dayfm = "Sunday";
                break;
             case 'Mon':
                $dayfm = "Monday";
                break;
             case 'Tues':
                $dayfm = "Tuesday";
                break;
             case 'Wed':
                $dayfm = "Wednesday";
                break;
             case 'Thur':
                $dayfm = "Thursday";
                break;
             case 'Fri':
                $dayfm = "Friday";
                break;
             case 'Sat':
                $dayfm = "Saturday";
                break;
            default:
                $dayfm='';
                break;
        }
        return  $dayfm;;
    }
    public function actionGetTimeSlotsByParam(){
        $coaches= $_POST['coaches'];
        $cdate= $_POST['cdate'];
        $day = date('D', strtotime($cdate));
        $dayFm = $this->getDayFullName($day);
        $dataset = Dataset::find()
            ->where(['coaches_master_id'=>$coaches,'day_of_week' => $dayFm ])
            ->one();
        $slots=[];   
        if ($dataset) {
            $slots [] = $this->getTimeSlot(30, $dataset->available_at, $dataset->available_until);
        }     
        if (!empty($slots)) {
            $response = ['status'=>'ok', 'response'=>  ($slots[0])];
        }
        else{
            $response = 
                    ['status'=>'error', 'response'=>  "no time slot avaliable"] ;

        }
        echo json_encode($response);
    }
    public function actionSaveBooking(){
        $coaches= $_POST['coaches'];
        $cdate= $_POST['cdate'];
        $timeslotss= $_POST['timeslotss'];
        $model = new Booking();
        $model->coache_name=$coaches;
        $model->booking_date=$cdate;
        $model->time_slot=$timeslotss;
        if ($model->save(false)) {
            $response = ['status'=>'ok', 'response'=>  "success"];
        }
        else{
            $response = 
                    ['status'=>'error', 'response'=>  "error"] ;

        }
        echo json_encode($response);
    }
   
}
