<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление экипажем', 'url'=>array('index')),
);
?>

<h1>Создать экипаж</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>