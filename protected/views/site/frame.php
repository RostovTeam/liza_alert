<? Yii::app()->getClientScript()->registerCssFile('/static/css/style.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/example.js', CClientScript::POS_END); ?>
<? Yii::app()->getClientScript()->registerCssFile('/static/css/bootstrap_frame.min.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/bootstrap_frame.min.js', CClientScript::POS_END); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/share-panel.js', CClientScript::POS_END); ?>

<div class="span12">
    <div class="span8">
        <div id="map-canvas" data-editable="<?= $editable ?>" data-lost-id="<?= $lost_id ?>"></div>
    </div>
    <? if ($editable): ?>
        <div class="span3">
            <form>
                <fieldset>
                    <label>Тип: </label>
                    <select name="type">
                        <option value="balloon">Метка</option>
                        <option value="radius">Окружность</option>
                        <option value="area">Произвольная область</option>
                    </select>
                    <label>Цвет: </label>
                    <select name="color">
                        <option value="green">Зеленый</option>
                        <option value="lightblue">Светло-голубой</option>
                        <option value="blue">Голубой</option>
                        <option value="yellow">Желтый</option>
                        <option value="purple">Фиолетовый</option>
                        <option value="pink">Розовый</option>
                    </select>
                    <input name="element_id" type="hidden" value="" />
                    <input type="text" name="title" placeholder="Заголовок">
                    <textarea rows="3" name="description" placeholder="Описание"></textarea>
                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn" id="save-element">Сохранить</button>
                            <button type="button" class="btn btn-danger" id="delete-select">Удалить</button>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn" id="save-map">Сохранить карту</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    <? else: ?>
        <div id="share_buttons" class="share-buttons-panel invisible">
            <a class="vkontakte" href="javascript: void(0);"></a>
            <a class="facebook" href="javascript: void(0);">Расказать в facebook</a>
            <a class="mailru" href="javascript: void(0);">Рассказать на mail.ru</a>
            <a class="odnoklassniki" href="javascript: void(0);">Рассказать на Одноклассники.ру</a>
            <a class="twitter" href="javascript: void(0);">Рассказать на twitter</a>
        </div>
    <? endif; ?>
</div>

<div id="popup-alert" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Регистрация волонтёров</h3>
    </div>
    <div class="modal-body">
        <input id="volunteersName" type="text" placeholder="Ф.И.О">&nbsp;&nbsp;&nbsp;
        <input id="volunteersPhone" type="text" placeholder="Телефон">


    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
        <button id="saveVolunteers" class="btn btn-primary">Сохранить</button>
    </div>
</div>


