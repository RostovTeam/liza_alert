<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Добавить город', 'url'=>array('create')),
	array('label'=>'Посмотреть города', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление городами', 'url'=>array('index')),
);
?>

<h1>Обновление города <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>