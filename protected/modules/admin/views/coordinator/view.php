<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */

$this->breadcrumbs=array(
	'Coordinators'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Добавление координатора', 'url'=>array('create')),
	array('label'=>'Обновление координатора', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить координатора', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить координатора?')),
	array('label'=>'Управление координаторами', 'url'=>array('index')),
);
?>

<h1>Просмотр координатора #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'date_created',
	),
)); ?>
