<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage City', 'url'=>array('index')),
);
?>

<h1>Добавление города</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>