<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */
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



<?php echo $form->label($model, 'phone'); ?>
<?php echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50)); ?>


    <div>
    <?php echo CHtml::submitButton('Search', array('class' => 'btn')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->