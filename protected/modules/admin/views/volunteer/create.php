<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */

$this->breadcrumbs=array(
	'Volunteers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление волонтерами', 'url'=>array('index')),
);
?>

<h1>Создать волонтера</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>