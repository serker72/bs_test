<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AntiagentAds */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Antiagent Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antiagent-ads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ads_id',
            'ads_price',
            'ads_img_link',
            'ads_header',
            'ads_link',
            'ads_text:ntext',
            'ads_owner',
            'ads_option_price',
            'ads_option_owner',
            'ads_option_owner_phone',
            'ads_option_owner_email:email',
            'ads_option_dt_create',
            'ads_option_dt_last_update',
            'ads_option_views',
            'ads_option_district',
            'ads_option_address',
            'ads_option_apartment_area',
            'ads_option_floor',
            'ads_option_wall material',
            'ads_option_year built',
            'created_at',
        ],
    ]) ?>

</div>
