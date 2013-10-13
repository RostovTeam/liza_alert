<?php
/* @var $this CoordinatorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Coordinators',
);

$this->menu=array(
	array('label'=>'Добавить координатора', 'url'=>array('create')),
	array('label'=>'Управление координаторами', 'url'=>array('index')),
);
?>

<h1>Координаторы</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
