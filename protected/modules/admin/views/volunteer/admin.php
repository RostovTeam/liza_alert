<?php
/* @var $this VolunteerController */
/* @var $model Volunteer */

$this->breadcrumbs=array(
	'Volunteers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Создать волонтера', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#volunteer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Manage Volunteers</h2>



<?php echo CHtml::link('Поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'volunteer-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-striped table-bordered',
        'summaryText'=>'',
        'pagerCssClass'=>'pagination',
        'pager'=>array(
            'selectedPageCssClass'=>'active',
            'cssFile'=>'',
            'header'=>'',
            'hiddenPageCssClass'=>'disabled'	
        ),
    'pager'=>array(
        'selectedPageCssClass'=>'active',
        'cssFile'=>'',
        'header'=>'',
        'hiddenPageCssClass'=>'disabled',
        'nextPageLabel'=>'Вперед',
        'prevPageLabel'=>'Назад',
        'lastPageLabel'=>'Последняя',
        'firstPageLabel'=>'Первая'
    ),
	'columns'=>array(
		'id',
		'name',
		'phone',
		'date_created',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
