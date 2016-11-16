<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Claim */

$this->title = Yii::t('app', 'Create Claim');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Claims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->context->layout = 'main_0';
?>
<div class="claim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
