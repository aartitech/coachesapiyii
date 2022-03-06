<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CoachesMaster */

$this->title = 'Create Coaches Master';
$this->params['breadcrumbs'][] = ['label' => 'Coaches Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaches-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
