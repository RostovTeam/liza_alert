<?php
/* @var $this CrewController */
/* @var $model Crew */
/* @var $form CActiveForm */
?>



<? Yii::app()->getClientScript()->registerCssFile('/static/css/chosen.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/chosen.jquery.js'); ?>

<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>
    $(function() {
        $('select').chosen();

    });
</script>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'crew-form',
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
        <?php echo $form->labelEx($model, 'active', array('class' => 'control-label')); ?>
    <div class="controls">
<?php echo $form->checkBox($model, 'active'); ?>
<?php echo $form->error($model, 'active'); ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model, 'lost_id', array('class' => 'control-label')); ?>
    <div class="controls">
        <? if ($model->isNewRecord): ?>
            <?=
            $form->dropDownList($model, 'lost_id', CHtml::listData(Lost::model()->active()->findAll(), 'id', 'name'));
            ?>
        <? else: ?>
            <?=$model->lost->name?>
        <? endif; ?>
<?php echo $form->error($model, 'lost_id'); ?>
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
<? if (!$model->isNewRecord): ?>
    <div class="control-group">
        <label  class= 'control-label'>Список волонтеров:</label>
        <div class="controls">
                <? if ($model->volunteer): ?>
                <ul>
                    <? foreach ($model->volunteer as $v): ?>
                        <li><?= $v->name ?>  </li>
                <? endforeach; ?>
                </ul>
    <? endif; ?>
        </div>
    </div>
    <div class="control-group">
        <label  class= 'control-label'>Добавить к поиску</label>
        <div class="controls">
            <?=
            CHtml::dropDownList('Crew[volunteer][]', '', CHTML::listData($model->getAvailableVolunteers(), 'id', 'name'), array('multiple' => true, 'class' => 'chosen')
            );
            ?><br>
            <small>Волонтеров можно добавлять только из числа тех,
                кто учасвует в поиске <?= $model->lost->name ?></small>
        </div>
    </div>
        <? endif; ?>
<div class="control-group">
    <div class="controls">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

