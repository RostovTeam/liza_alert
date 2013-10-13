<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */
/* @var $form CActiveForm */
?>

<? Yii::app()->getClientScript()->registerCssFile('/static/css/chosen.css'); ?>

<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/chosen.jquery.js'); ?>

<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>
    $(function() {
        $('select').chosen({'data-placehodler': 'Выберите опцию'});
        $('#Volunteer_phone').mask('+7 (999) 999 9999');
        
    });
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'volunteer-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal')
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
    <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>
</div>
<? if (!$model->isNewRecord): ?>
    <div class="control-group">
        <label  class= 'control-label'>Состоит в экипажах:</label>
        <div class="controls">
            <? if ($model->crew): ?>
                <ul>
                    <? foreach ($model->crew as $crew): ?>
                        <li><?= $crew->name ?>  </li>
                    <? endforeach; ?>
                </ul>
            <? endif; ?>
        </div>
    </div>
    <div class="control-group">
        <label  class= 'control-label'>Добавить в экипаж</label>
        <div class="controls">
            <?=
            CHtml::dropDownList('Volunteer[crew][]', '', CHTML::listData($model->AvailableCrew(), 'id', 'name'), array('multiple' => true, 'class' => 'chosen')
            );
            ?><br>
            <small>Волонтеров можно добавлять только в активные экипажи</small>
        </div>
    </div>
<? endif; ?>

<div class="control-group">
    <div class="controls">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

