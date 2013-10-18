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
    array('label' => 'Удалить потеряшку', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Удалить потеряшку?')),
    array('label' => 'Управление потеряшек', 'url' => array('index')),
);
?>

<h1>Просмотр потеряшки #<?php echo $model->id; ?></h1>
<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'description',
        'forum_link',
        array(
            'name' => 'status',
            'value' => Yii::app()->params["lost_status"][$model->status]
        ),
        array(
            'label' => 'Город',
            'type' => 'raw',
            'value' => CHtml::encode($model->city->name)
        ),
        array(
            'label' => 'Фотография',
            'type' => 'raw',
            'value' => $model->photo != null ? '<img src="' . Yii::app()->params['photosRelative'] . CHtml::encode($model->photo) . '">' : ''
        ),
        array(
            'label' => 'Ориентировка',
            'type' => 'raw',
            'value' => $model->flyer != null ? '<img src="' . Yii::app()->params['flyerRelative'] . CHtml::encode($model->flyer) . '">' : ''
        ),
        'date_created',
    ),
));
?>

<hr>
<div style="height:500px;">
<?php echo $this->renderPartial('application.views.site.frame', array('lost_id' => $model->id, 'editable' => 'false')); ?>
</div>