<? Yii::app()->getClientScript()->registerCssFile('/static/css/style.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/example.js'); ?>


<div class="span12">
    <div class="span8">
        <div id="map-canvas" data-editable="<?=$editable?>" data-lost-id="<?=$lost_id?>"></div>
    </div>
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
</div>
<div class="span9">
    <div class="well well-small">
        Имя: <span name="name"></span><br>
        Телефон: <span name="phone"></span>
    </div>
</div>
