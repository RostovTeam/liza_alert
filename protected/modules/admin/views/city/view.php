<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Добавление города', 'url'=>array('create')),
	array('label'=>'Обновление города', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление города', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить город?')),
	array('label'=>'Управление городами', 'url'=>array('index')),
);
?>

<h1>Просмотр города #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
