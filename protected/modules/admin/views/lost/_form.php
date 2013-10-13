<?php
/* @var $this LostController */
/* @var $model Lost */
/* @var $form CActiveForm */
?>


<? Yii::app()->getClientScript()->registerCssFile('/static/css/chosen.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/chosen.jquery.js'); ?>

<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>
    $(function() {
        $('.form-horizontal select').chosen();
        
    });
</script>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lost-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')
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
        $form->dropDownList($model, 'status', Yii::app()->params['lost_status']);
        ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
</div>

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
    <?php echo $form->labelEx($model, 'forum_link', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'forum_link'); ?>
        <?php echo $form->error($model, 'forum_link'); ?>
    </div>
</div>


<div class="control-group">
    <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model, 'description'); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Фотография</label>
    <div class="controls">
    <?php if(!empty($model->photo)): ?>
        <div>
            <img src="<?= Yii::app()->params['photosRelative'].$model->photo ?>">
        </div>
    <?php endif; ?>
    <?php echo CHtml::activeFileField($model, 'photo'); ?>
        </div>
</div>


<div class="control-group">
    <label class="control-label">Ориентировка</label>
    <div class="controls">
        <?php if(!empty($model->flyer)): ?>
            <div>
                <img src="<?= Yii::app()->params['flyerRelative'].$model->flyer ?>">
            </div>
        <?php endif; ?>
        <?php echo CHtml::activeFileField($model, 'flyer'); ?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

