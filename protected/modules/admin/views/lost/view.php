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

<h1><?php echo $model->name; ?></h1>

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#info" data-toggle="tab">Общая информация</a></li>
    <li ><a href="#dashboard" data-toggle="tab">Поисковые работы</a></li>
    <li ><a href="#maptab" data-toggle="tab">Карта</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="info">
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
                    'value' => $model->photo != null ? '<img width="400" src="' . Yii::app()->params['photosRelative'] . CHtml::encode($model->photo) . '">' : ''
                ),
                array(
                    'label' => 'Ориентировка',
                    'type' => 'raw',
                    'value' => $model->flyer != null ? '<img width="400" src="' . Yii::app()->params['flyerRelative'] . CHtml::encode($model->flyer) . '">' : ''
                ),
                'date_created',
            ),
        ));
        ?>
    </div>
    <div class="tab-pane " id="dashboard">
        <legend>Координатор</legend>
        <span7> <?= $model->coordinator->name ?>(<?= $model->coordinator->phone ?>)</span7>
        <legend>Список Волонтеров</legend>
        <?php
        $volunteers = $model->volunteer;
        $dataProvider = new CArrayDataProvider('Volunteer', array(
            'totalItemCount' => count($volunteers),
            'pagination' => array(
                'pageSize' => 1,
            ),)
        );
        $dataProvider->setData($volunteers);

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'lost-grid',
            'dataProvider' => $dataProvider,
            'emptyText' => 'Данные отсутствуют',
            'itemsCssClass' => 'table table-striped table-bordered',
            'summaryText' => ' Всего: {count}',
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
                'firstPageLabel' => 'Первая',
            ),
            'columns' => array(
                'name',
                'phone'
            ),
        ));
        ?>
    </div>
    <div class="tab-pane " id="maptab">
        <div style="height:500px;">
            <?php echo $this->renderPartial('application.views.site.frame', array('lost_id' => $model->id, 'editable' => 'false')); ?>
        </div>
    </div>
</div>

<script>
    $('a[href="#maptab"]').on('shown', function(e) {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(centerMap);
    })
</script>