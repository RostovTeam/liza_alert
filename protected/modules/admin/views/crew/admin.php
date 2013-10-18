<?php
/* @var $this CrewController */
/* @var $model Crew */

$this->breadcrumbs = array(
    'Crews' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Создание экипажа', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#crew-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Экипаж</h2>



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
    'id' => 'crew-grid',
    'dataProvider' => $model->search(),
    'emptyText' => 'Данные отсутствуют',
    'itemsCssClass' => 'table table-striped table-bordered',
    'summaryText' => '',
    'pagerCssClass' => 'pagination',
    'pager' => array(
        'selectedPageCssClass' => 'active',
        'cssFile' => '',
        'header' => '',
        'hiddenPageCssClass' => 'disabled'
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
            'name'=>'Активен',
            'value' => '$data->active==1?"Да":"Нет"'
        ),
        array(
            'name' => 'Потеряшка',
            'value' => '$data->lost->name'
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
