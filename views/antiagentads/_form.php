<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AntiagentAds */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="antiagent-ads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ads_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_price')->textInput() ?>

    <?= $form->field($model, 'ads_img_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ads_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_price')->textInput() ?>

    <?= $form->field($model, 'ads_option_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_owner_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_owner_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_dt_create')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_dt_last_update')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_views')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_apartment_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_floor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_wall material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ads_option_year built')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
