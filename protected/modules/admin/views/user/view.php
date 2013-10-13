<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'Создать пользователя', 'url'=>array('create')),
	array('label'=>'Обновить пользователя', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Удалить пользователя?')),
	array('label'=>'Управление пользователями', 'url'=>array('index')),
);
?>

<h1>Просмотр пользователя #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'login',
	),
)); ?>
