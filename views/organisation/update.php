<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Organisation */

$this->title = 'ແກ້ໄຂຂໍ້ມູນ ອົງການຈັດຕັ້ງ';
$this->params['breadcrumbs'][] = ['label' => 'ອົງການຈັດຕັ້ງ', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ແກ້ໄຂຂໍ້ມູນ';
?>
<div class="card">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
