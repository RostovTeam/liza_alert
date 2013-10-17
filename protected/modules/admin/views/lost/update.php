<?php
/* @var $this LostController */
/* @var $model Lost */

$this->breadcrumbs = array(
    'Losts' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Создание потеряшек', 'url' => array('create')),
    array('label' => 'Просмотр потеряшек', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Управление потеряшками', 'url' => array('index')),
);
?>

<h1>Обновление потеряшки №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>

<hr>

<div id="frame_container" style="width:940px;height:650px;">
    <?php echo $this->renderPartial('application.views.site.frame', array('lost_id' => $model->id, 'editable' => 'true')); ?>
</div>

