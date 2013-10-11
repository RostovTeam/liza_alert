<?php
/* @var $this LostController */
/* @var $model Lost */

$this->breadcrumbs=array(
	'Losts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создание потеряшек', 'url'=>array('create')),
	array('label'=>'Просмотр потеряшек', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление потеряшками', 'url'=>array('index')),
);
?>

<h1>Update Lost <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>