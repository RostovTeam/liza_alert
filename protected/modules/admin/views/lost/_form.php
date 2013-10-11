<?php
/* @var $this LostController */
/* @var $model Lost */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lost-form',
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
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
     </div>
</div>
 <div class="control-group">
		<?php echo $form->labelEx($model,'city_id',array('class'=>'control-label')); ?>
     <div class="controls">
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
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
	<div class="controls">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

