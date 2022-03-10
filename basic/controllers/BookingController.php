<?php

namespace app\controllers;

use app\models\Booking;
use yii\rest\ActiveController;

class BookingController extends ActiveController{
    public $modelClass = Booking::class;
}
?>
