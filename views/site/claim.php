<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Claim */
/* @var $form yii\widgets\ActiveForm */
?>

<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<div id="success"> </div> <!-- For success message -->

<div class="claim-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-claim-form'
        ]        
    ]); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 3]) ?>

    <!--?= $form->field($model, 'created_at')->textInput() ?-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
