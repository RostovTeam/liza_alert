<?php
/* @var $this LostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Losts',
);

$this->menu=array(
	array('label'=>'Создание потеряшек', 'url'=>array('create')),
	array('label'=>'Управление потеряшками', 'url'=>array('index')),
);
?>

<h1>Losts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
