<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>


	<div>
		<?php echo CHtml::submitButton('Поиск',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->