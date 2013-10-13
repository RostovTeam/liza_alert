<?php
/* @var $this LostController */
/* @var $model Lost */

$this->breadcrumbs = array(
    'Losts' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'Создание потеряшек', 'url' => array('create')),
    array('label' => 'Обновление потеряшек', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Удаление потеряшек', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Удалить потеряшку?')),
    array('label' => 'Управление потеряшек', 'url' => array('index')),
);
?>

<h1>View Lost #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        array(
            'name' => 'status',
            'value' => Yii::app()->params["lost_status"][$model->status]
        ),
        'city.name',
        'coordinator.name',
        'date_created',
    ),
));
?>
