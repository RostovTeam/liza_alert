<? Yii::app()->clientScript->registerCssFile('/static/css/style.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/widget.js?ver8', CClientScript::POS_END); ?>
<? Yii::app()->clientScript->registerCssFile('/static/css/bootstrap_frame.min.css'); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/bootstrap_frame.min.js', CClientScript::POS_END); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/share-panel.js', CClientScript::POS_END); ?>
<? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery.maskedinput.min.js'); ?>

<script>

    $(function() {
        $('#volunteersPhone').mask('+7 (999) 999 9999');
        $('#close_lost_card').click(function() {
            $('#lost_cart').hide();
        });//t = t.replace(/{r_id}/g, this.r_id);

        $('#frame_width').change(function() {
            var value = parseInt($(this).val());
            if (!value)
                return false;
            $('#iframe_code').text($('#iframe_code').text().replace(/width="[\d]*"/g, 'width="' + value + '"'));
        });
        $('#frame_height').change(function() {
            var value = parseInt($(this).val());
            if (!value)
                return false;
            $('#iframe_code').text($('#iframe_code').text().replace(/height="[\d]*"/g, 'height="' + value + '"'));
        });
    });

</script>
<? if ($editable): ?>
    <div class="control-group">
        <label class="control-label">Код для вставки:</label>

        <div class="controls">
            <input type="text" id="frame_width" placeholder="Ширина фрейма" >
            <input type="text" id="frame_height" placeholder="Высота фрейма"><br />
            <span class="label label-info" id="iframe_code">
                <?=
                CHtml::encode('<iframe width="500" height="300" src="' .
                        $this->createAbsoluteUrl('/site/frame', array('id' => $lost_id)) . '"></iframe>');
                ?>
            </span>
        </div>
    </div>
<? endif; ?>
<div class="row-fluid" style="position:relative;height:100%;overflow: hidden">
    <div class="row-fluid" style="position:relative;height:100%">
        <div id="lost_cart" style="position:absolute;right:25px;bottom:25px;z-index:1;width:260px;heigth:100px;background: rgba(255,255,255,0.7);border-radius: 3px;padding:10px;display:none;">
            <div  id="close_lost_card" style="position:absolute;right:5px;top:3px;cursor:pointer">×</div>
            <div style="width:100%;text-align:center;color:red;text-transform: uppercase;margin-bottom: 3px">Внимание! Пропал человек</div>
            <div style="float:left;width:80px">
                <div id ="lost_photo" style="width:80px;height:75px;padding:0px;margin:0px;text-align: center;">
                    <img src="" />
                </div>
            </div>

            <div  style="float:right;width:165px;height:75px;">
                <div id ="lost_name" style="text-align: left; font-weight:bold;
                     font-size:16px;text-overflow: ellipsis;line-height: 90%;"></div>
                <div  style="padding:3px;font-size:12px;text-overflow: ellipsis;line-height: 150%;
                      width:150px;height:64px;
                      ">
                    Город: <span id="lost_city"></span><br />
                    Год рождения: <span id="lost_age"></span>
                </div>
            </div>

            <div id ="lost_forum_link" style="float:right; width:130px;text-align:right;padding-right:15px;margin-top:3px;"></div>
            <div id="share_buttons" class="share-buttons-panel">
                <a class="i16x16 vkontakte" href="javascript: void(0);" title="Рассказать Vkontakte"></a>
                <a class="i16x16 facebook" href="javascript: void(0);" title="Расказать в Facebook"></a>
                <a class="i16x16 odnoklassniki" href="javascript: void(0);" title="Рассказать в Одноклассниках"></a>
                <a class="i16x16 twitter" href="javascript: void(0);" title="Рассказать в Twitter"></a>
            </div>
        </div>
        <div id="map-canvas" data-editable="<? if ($editable): ?>true<? else: ?>false<? endif; ?>" data-lost-id="<?= $lost_id ?>"></div>
    </div>
    <? if ($editable): ?>
        <div class="" style="position:absolute;right:5px;top:55px;z-index:100;
             background:rgba(255,255,255,0.7);border-radius: 3px;padding:3px;border: solid 1px rgba(0,0,0,0.2);">
            <form class="form" style="margin: 0px">
                <fieldset>
                    <div class="control-group" style="margin-bottom: 0px;">
                        <label>Тип: </label>
                        <div class="controls">
                            <select name="type" style="margin-bottom: 0px;">
                                <option value="balloon">Метка</option>
                                <option value="radius">Окружность</option>
                                <option value="area">Произвольная область</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label>Цвет:</label>
                        <div class="controls">
                            <select name="color" style="margin-bottom: 0px;">
                                <option value="purple">Фиолетовый</option>
                                <option value="green">Зеленый</option>
                                <option value="lightblue">Светло-голубой</option>
                                <option value="blue">Голубой</option>
                                <option value="yellow">Желтый</option>
                                <option value="pink">Розовый</option>
                            </select>
                        </div>
                    </div>

                    <input name="element_id" type="hidden" value="" />
                    <div class="control-group">
                        <div class="controls">
                            <input type="text" name="title" placeholder="Заголовок" style="margin-bottom: 0px;">
                        </div>
                    </div>
                    <textarea rows="3" name="description" placeholder="Описание"></textarea>
                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn btn-small" id="save-element">Добавить</button>
                            <button type="button" class="btn btn-danger btn-small" id="delete-select" disabled="disabled">Удалить</button>
                        </div>
                    </div>
                    <div class="control-group" style="margin: 0px;">
                        <div class="controls">
                            <button type="button" class="btn btn-small" id="save-map">Сохранить карту</button>
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


