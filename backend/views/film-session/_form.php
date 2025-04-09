<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bs\Flatpickr\FlatpickrWidget;

/** @var yii\web\View $this */
/** @var common\models\FilmSession $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="film-session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'film_id')->dropDownList($filmList, ['prompt' => 'Выберите фильм']) ?>

    <?= $form->field($model, 'start_time')->widget(FlatpickrWidget::class, [
        'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'allowInput' => true,
            'enableTime' => true,
            'time_24hr' => true,
            'minDate' => 'today',

            'altInput' => true,
            'altFormat' => 'Y-m-d H:i',
            'dateFormat' => 'U',
        ],
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>