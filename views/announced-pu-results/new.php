<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Lga;
use app\models\PollingUnit;


/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polling-unit-form">

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
          'onchange'=>'
           $.post("'.Yii::$app->urlManager->createUrl('announced-pu-results/lists?id=').'"+$(this).val(), function( data ) {$( "#announcedpuresults-result_id") .html( data )
      });'
        ]); ?>

        <ul id="announcedpuresults-result_id"></ul>

         

         
       

       <ul id="results">
           
       </ul>
        

      

    

    <?php ActiveForm::end(); ?>

</div>
