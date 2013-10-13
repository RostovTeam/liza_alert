<?php
/* @var $this CoordinatorController */
/* @var $model Coordinator */

$this->breadcrumbs=array(
	'Coordinators'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Создание координатора', 'url'=>array('index')),
);
?>

<h1>Create Coordinator</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>