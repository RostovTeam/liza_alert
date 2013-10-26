<?php
/* @var $this LostController */
/* @var $model Lost */
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


    <?php echo $form->label($model, 'city_id'); ?>
    <?=
    $form->dropDownList($model, 'city_id', CHtml::listData(City::model()->findAll(), 'id', 'name'));
    ?>


<?php echo $form->label($model, 'coordinator_id'); ?>
        <?=
        $form->dropDownList($model, 'coordinator_id', CHtml::listData(Coordinator::model()->findAll(), 'id', 'name'));
        ?>

    <div>
    <?php echo CHtml::submitButton('Поиск', array('class' => 'btn')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->