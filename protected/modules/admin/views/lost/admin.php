<?php
/* @var $this LostController */
/* @var $model Lost */

$this->breadcrumbs = array(
    'Losts' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Создать потеряшек', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lost-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Управление потеряшками</h2>



<?php echo CHtml::link('Поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lost-grid',
    'dataProvider' => $model->search(),
    'emptyText' => 'Данные отсутствуют',
    'itemsCssClass' => 'table table-striped table-bordered',
    'summaryText' => '',
    'pagerCssClass' => 'pagination',
    'pager' => array(
        'selectedPageCssClass' => 'active',
        'cssFile' => '',
        'header' => '',
        'hiddenPageCssClass' => 'disabled',
        'nextPageLabel' => 'Вперед',
        'prevPageLabel' => 'Назад',
        'lastPageLabel' => 'Последняя',
        'firstPageLabel' => 'Первая'
    ),
    'pager' => array(
        'selectedPageCssClass' => 'active',
        'cssFile' => '',
        'header' => '',
        'hiddenPageCssClass' => 'disabled',
        'nextPageLabel' => 'Вперед',
        'prevPageLabel' => 'Назад',
        'lastPageLabel' => 'Последняя',
        'firstPageLabel' => 'Первая'
    ),
    'columns' => array(

        'name',
        array(
            'name' => 'status',
            'value' => 'Yii::app()->params["lost_status"][$data->status];'
        ),
         array(
            'name' => 'Город',
            'value' => '$data->city->name'
        ),
        array(
            'name' => 'Координатор',
            'value' => '$data->coordinator->name'
        ),
        'date_created',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
