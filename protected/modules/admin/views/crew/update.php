<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создание экипаж', 'url'=>array('create')),
	array('label'=>'Просмотр экипаж', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление экипаж', 'url'=>array('index')),
);
?>

<h1>Обновить экипаж <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>