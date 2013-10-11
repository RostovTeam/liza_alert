<?php
/* @var $this CrewController */
/* @var $model Crew */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crew-form',
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
		<?php echo $form->labelEx($model,'active',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
     </div>
</div>
 <div class="control-group">
		<?php echo $form->labelEx($model,'lost_id',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'lost_id'); ?>
		<?php echo $form->error($model,'lost_id'); ?>
     </div>
</div>
 <div class="control-group">
		<?php echo $form->labelEx($model,'coordinator_id',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'coordinator_id'); ?>
		<?php echo $form->error($model,'coordinator_id'); ?>
     </div>
</div>
 <div class="control-group">
		<?php echo $form->labelEx($model,'date_created',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
     </div>
</div>
 <div class="control-group">
	<div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

