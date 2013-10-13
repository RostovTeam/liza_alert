<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */

$this->breadcrumbs=array(
	'Coordinators'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Добавление координатора', 'url'=>array('create')),
	array('label'=>'Просмотр координатора', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление координаторам', 'url'=>array('index')),
);
?>

<h1>Обновление координатора #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>