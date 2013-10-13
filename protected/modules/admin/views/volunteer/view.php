<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */

$this->breadcrumbs=array(
	'Volunteers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Создание волонтера', 'url'=>array('create')),
	array('label'=>'Обновление волонтера', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удаление волонтера', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить волонтера?')),
	array('label'=>'Управление волонтерами', 'url'=>array('index')),
);
?>

<h1>Просмотр волонтера #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'date_created',
	),
)); ?>
