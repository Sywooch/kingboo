<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Hotel */

$lang = \common\models\Lang::$current->url;
$hotel_title = $model->{'title_' . $lang};
$this->title = $hotel_title;

$this->params['breadcrumbs'][] = ['label' => $hotel_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('hotels', 'Edit');
?>
<div class="hotel-update">
    <?= \yii\helpers\Html::a(
        '<i class="fa fa-arrow-left"></i> ' . \Yii::t('partner_hotel', 'Back to hotel view'),
        ['view', 'id' => $hotel->id],
        ['class' => 'btn btn-default']) ?>
    <br/>
    <br/>
<!--    <h3 class="box-title">--><?//= Html::encode(Yii::t('hotels', 'Edit')) ?><!--</h3>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
