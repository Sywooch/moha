<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Legal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="legal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'legal_type_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\LegalType::find()->where(['deleted' => 0])->all(), 'id', 'name'), [
                'prompt' => ''
        ]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'deleted')->dropDownList(Yii::$app->params['YESNO']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>