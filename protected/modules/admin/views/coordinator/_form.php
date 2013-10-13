<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */
/* @var $form CActiveForm */
?>


<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>
    $(function() {
        
        $('#Coordinator_phone').mask('+7 (999) 999 9999');;
    });
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coordinator-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>

<?if($model->hasErrors()):?><div class="alert alert-error">

	<?php echo $form->errorSummary($model); ?>
</div>
<? endif;?>
 <div class="control-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
     </div>
</div>
 <div class="control-group">
		<?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
     </div>
</div>

 <div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

