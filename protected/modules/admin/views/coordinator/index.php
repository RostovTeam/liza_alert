<?php
/* @var $this CoordinatorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Coordinators',
);

$this->menu=array(
	array('label'=>'Create Coordinator', 'url'=>array('create')),
	array('label'=>'Manage Coordinator', 'url'=>array('index')),
);
?>

<h1>Coordinators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
