<?php
/* @var $this CrewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crews',
);

$this->menu=array(
	array('label'=>'Создание эскорта', 'url'=>array('create')),
	array('label'=>'Управление эскортом', 'url'=>array('index')),
);
?>

<h1>Crews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
