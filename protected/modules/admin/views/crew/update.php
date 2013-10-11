<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создание эскорта', 'url'=>array('create')),
	array('label'=>'Просмотр эскорта', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление эскортом', 'url'=>array('index')),
);
?>

<h1>Update Crew <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>