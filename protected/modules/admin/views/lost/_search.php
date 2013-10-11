<?php
/* @var $this LostController */
/* @var $model Lost */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>



		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>



		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>



		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>



		<?php echo $form->label($model,'coordinator_id'); ?>
		<?php echo $form->textField($model,'coordinator_id'); ?>



		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>


	<div>
		<?php echo CHtml::submitButton('Поиск',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->