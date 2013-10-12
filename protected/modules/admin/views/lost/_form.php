<?php
/* @var $this LostController */
/* @var $model Lost */
/* @var $form CActiveForm */
?>



<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lost-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal','enctype'=>'multipart/form-data')
        ));
?>

    <? if ($model->hasErrors()): ?><div class="alert alert-error">

    <?php echo $form->errorSummary($model); ?>
    </div>
    <? endif; ?>
<div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
    <div class="controls">
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 200)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
    <div class="controls">
        <?=
        $form->dropDownList($model, 'status', array(0 => 'не требуется ничего',
            '1' => 'требуется информационная поддржка(шаринг)',
            '2' => 'выезд на местность'));
        ?>
<?php echo $form->error($model, 'status'); ?>
    </div>
</div>

<?php echo CHtml::activeFileField($model, 'photo'); ?>
<div class="control-group">
        <?php echo $form->labelEx($model, 'city_id', array('class' => 'control-label')); ?>
    <div class="controls">
        <?=
        $form->dropDownList($model, 'city_id', CHtml::listData(City::model()->findAll(), 'id', 'name'));
        ?>
<?php echo $form->error($model, 'city_id'); ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model, 'coordinator_id', array('class' => 'control-label')); ?>
    <div class="controls">
        <?=
        $form->dropDownList($model, 'coordinator_id', CHtml::listData(Coordinator::model()->findAll(), 'id', 'name'));
        ?>
<?php echo $form->error($model, 'coordinator_id'); ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model, 'age', array('class' => 'control-label')); ?>
    <div class="controls">
<?php echo $form->textField($model, 'age'); ?>
<?php echo $form->error($model, 'age'); ?>
    </div>
</div>
<div class="control-group">
    <div class="controls">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

