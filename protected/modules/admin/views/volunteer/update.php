<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */

$this->breadcrumbs=array(
	'Volunteers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создать волонтера', 'url'=>array('create')),
	array('label'=>'Просмотр волонтера', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление волонтерами', 'url'=>array('index')),
);
?>

<h1>Update Volunteer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>