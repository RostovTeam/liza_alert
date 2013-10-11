<?php
/* @var $this LostController */
/* @var $model Lost */

$this->breadcrumbs=array(
	'Losts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление потеряшками', 'url'=>array('index')),
);
?>

<h1>Create Lost</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>