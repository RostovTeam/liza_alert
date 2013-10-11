<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Создание эскорта', 'url'=>array('create')),
	array('label'=>'Обновление эскорта', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление эскорта', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить эскорт?')),
	array('label'=>'Управление эскортом', 'url'=>array('index')),
);
?>

<h1>View Crew #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'active',
		'lost_id',
		'coordinator_id',
		'date_created',
	),
)); ?>
