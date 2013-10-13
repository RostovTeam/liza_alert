<? Yii::app()->getClientScript()->registerCssFile('/static/css/style.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/example.js', CClientScript::POS_END); ?>
<? Yii::app()->getClientScript()->registerCssFile('/static/css/bootstrap_frame.min.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/bootstrap_frame.min.js', CClientScript::POS_END); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>
    
    $(function(){
        $('#volunteersPhone').mask('+7 (999) 999 9999');
    });
    
</script>

<div class="span12">
    <div class="span8" style="position:relative;">
        <div id="lost_cart" style="position:absolute;right:25px;bottom:25px;z-index:1;
             width:260px;heigth:100px;background: rgba(255,255,255,0.7);border-radius: 3px;padding:10px">
            <div  style="width:100%;text-align:center;
                  color:red;text-transform: uppercase;margin-bottom: 3px">Внимание! Пропал человек</div>
            <div   style="float:left;width:80px">
                <div id ="lost_photo" style="width:100px;height:75px;padding:0px;margin:0px;text-align: center;">
                    
                </div>
            </div>

            <div  style="float:right;width:150px;height:75px;">
                <div id ="lost_name" style="text-align: center; font-weight:bold;
                     font-size:16px;text-overflow: ellipsis"></div>
                <div id="lost_description" style="padding:3px;font-size:12px;text-overflow: ellipsis
                     "></div>
            </div>

            <div  id ="lost_age" style="float:left; width:100px;text-align: center;margin-top:3px;font-weight: bold"> 1995</div>
            <div  id ="lost_forum_link" style="float:right; 
                  width:130px;text-align:right;padding-right:15px;margin-top:3px;">link</div>
            <div></div>
        </div>

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


