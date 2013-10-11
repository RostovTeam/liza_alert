<?php
/* @var $this CityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cities',
);

$this->menu=array(
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Manage City', 'url'=>array('index')),
);
?>

<h1>Города</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
