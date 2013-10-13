<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление пользователями', 'url'=>array('index')),
);
?>

<h1>Добавить пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>