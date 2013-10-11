<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */

$this->breadcrumbs=array(
	'Coordinators'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Coordinator', 'url'=>array('create')),
	array('label'=>'View Coordinator', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Coordinator', 'url'=>array('index')),
);
?>

<h1>Update Coordinator <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>