<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */

$this->breadcrumbs=array(
	'Volunteers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление волонтеров', 'url'=>array('index')),
);
?>

<h1>Create Volunteer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>