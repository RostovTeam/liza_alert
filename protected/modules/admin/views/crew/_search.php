<?php
/* @var $this CrewController */
/* @var $model Crew */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>


    <?php echo $form->label($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 200)); ?>



    <?php echo $form->label($model, 'active'); ?>
    <?php echo $form->checkBox($model, 'active'); ?>



    <?php echo $form->label($model, 'lost_id'); ?>
    <?=
    $form->dropDownList($model, 'lost_id', CHtml::listData(Lost::model()->findAll(), 'id', 'name'));
    ?>



    <?php echo $form->label($model, 'coordinator_id'); ?>
    <?php echo $form->textField($model, 'coordinator_id'); ?>


    <div>
        <?php echo CHtml::submitButton('Поиск', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->