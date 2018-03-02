<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Lga;
use app\models\Party;
use app\models\PollingUnit;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announced-pu-results-form">

    <?php $form = ActiveForm::begin(); ?>
   <?= $form->field($model, 'lga_id')->dropDownList(

        ArrayHelper::map(Lga::find()->all(), 'lga_id','lga_name'),

        [ 
          'prompt'=>'Select LGA',
          'onchange'=>'
          $.post("'.Yii::$app->urlManager->createUrl('pollingunit/lists?id=').'"+$(this).val(), function( data ) {$( "#announcedpuresults-polling_unit_uniqueid") .html( data )
      });'
        ]); ?>

    <?= $form->field($model, 'polling_unit_uniqueid')->dropDownList(

        ArrayHelper::map(PollingUnit::find()->all(), 'uniqueid','polling_unit_name'),

        [ 
          'prompt'=>'Select polling unit',
          
        ]); ?>
 

           <?php

           $models = Party::find()->all();
           foreach ($models as $key) {
             echo  $form->field($key, 'partyid')->textInput(); 
           }

           ?>

    <?= $form->field($model, 'party_score')->textInput() ?>

    <?= $form->field($model, 'entered_by_user')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
