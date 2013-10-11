<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */

$this->breadcrumbs=array(
	'Coordinators'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Coordinator', 'url'=>array('create')),
	array('label'=>'Update Coordinator', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Coordinator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Coordinator', 'url'=>array('index')),
);
?>

<h1>View Coordinator #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'date_created',
	),
)); ?>
