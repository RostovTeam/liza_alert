<?php
/* @var $this CrewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crews',
);

$this->menu=array(
	array('label'=>'Создание экипаж', 'url'=>array('create')),
	array('label'=>'Управление экипаж', 'url'=>array('index')),
);
?>

<h1>Экипажи</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
