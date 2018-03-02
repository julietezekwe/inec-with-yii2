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
          $.post("'.Yii::$app->urlManager->createUrl('announced-pu-results/add?id=').'"+$(this).val(), function( data ) {$( "#announcedpuresults-polling_unit_uniqueid") .html( data )
      });'
        ]); ?>

    

        <ul id="announcedpuresults-polling_unit_uniqueid"></ul>
       
         

         
       

       
        

      

    

    <?php ActiveForm::end(); ?>

</div>
