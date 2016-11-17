<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Antiagent Ads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antiagent-ads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Antiagent Ads'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ads_id',
            'ads_price',
            'ads_img_link',
            'ads_header',
            // 'ads_link',
            // 'ads_text:ntext',
            // 'ads_owner',
            // 'ads_option_price',
            // 'ads_option_owner',
            // 'ads_option_owner_phone',
            // 'ads_option_owner_email:email',
            // 'ads_option_dt_create',
            // 'ads_option_dt_last_update',
            // 'ads_option_views',
            // 'ads_option_district',
            // 'ads_option_address',
            // 'ads_option_apartment_area',
            // 'ads_option_floor',
            // 'ads_option_wall material',
            // 'ads_option_year built',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
