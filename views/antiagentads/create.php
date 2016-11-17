<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AntiagentAds */

$this->title = Yii::t('app', 'Create Antiagent Ads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Antiagent Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antiagent-ads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
