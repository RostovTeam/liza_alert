<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs=array(
	'Crews'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Создание экипаж', 'url'=>array('create')),
	array('label'=>'Обновление экипаж', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить экипаж', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить эскорт?')),
	array('label'=>'Управление экипаж', 'url'=>array('index')),
);
?>

<h1>Просмотр экипажа #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'active',
		'lost_id',
        array(
            'label'=>'Координатор',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->coordinator->name),
                array('coordinator/view','id'=>$model->coordinator->id)),
        ),
		'date_created',
	),
)); ?>
