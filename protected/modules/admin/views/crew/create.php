<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление эскортом', 'url'=>array('index')),
);
?>

<h1>Создать эскорт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>