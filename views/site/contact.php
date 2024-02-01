<?php
/* @var $model app\models\ContactForm */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact bg-white p-5 rounded shadow mb-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>
    <?php else: ?>
        <p>
            If you have any inquiries or other questions, please fill out the following form to contact us.
        </p>

        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 10]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
