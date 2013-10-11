<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Update City', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete City', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить город?')),
	array('label'=>'Manage City', 'url'=>array('index')),
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
