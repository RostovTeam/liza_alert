<?php
/* @var $this VolunteerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Volunteers',
);

$this->menu=array(
	array('label'=>'Создать волонтера', 'url'=>array('create')),
	array('label'=>'Управление волонтерами', 'url'=>array('index')),
);
?>

<h1>Волонтёры</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
