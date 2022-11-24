<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once(dirname(__FILE__) . '/version.php');
try {
    $course = optional_param('course', 0, PARAM_INT);
} catch (coding_exception $e) {
}
$context = context_system::instance();

global $USER, $PAGE, $DB;

// Set PAGE variables.
$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot . '/local/eschoolapi/course_settings.php');

require_login();

$today = new DateTime();
?>

<html lang="en">
    <head>
        <title>ESAPI_cfg_f1</title>
        <style>
            body {
                font-family: "Arial",serif;
            }
            select, input {
                min-width: 100px;
                min-height: 30px;
                border-radius: 0;
                border-width: 1px;
            }
            .hidden{
                display: none !important;
            }
            .lp-grid {
                display: grid;
                grid-column-start: 1;
                grid-column-end: 2;
                justify-items: stretch;
                justify-content: start;
                align-items: baseline;
                grid-row-gap: 10px;
                grid-column-gap: 30px;
                margin-bottom: 15px;
            }
            .row1{
                grid-row: 1;
            }
            .row2{
                grid-row: 2;
            }
            .col1{
                grid-column: 1;
            }
            .col2{
                grid-column: 2;
            }
            button{
                min-height: 30px;
                border-radius: 0;
                border-width: 1px;
                cursor: pointer;
            }
            .mouse-in{
                background: lightblue;
            }
        </style>
    </head>
    <body>
        <div style='display: flex; flex-direction: column; width: fit-content;'>
            <div class="lp-grid">
                <label for='enable' id='enableText' class="row1 col1"><?php echo get_string('mark_autoexport', $plugin->component) ?>:</label>
                <select id="enable" class="row1 col2">
                     <option value="0" selected><?php echo get_string('mark_autoexport_disbaled', $plugin->component) ?></option>
                     <option value="1"><?php echo get_string('mark_autoexport_enabled', $plugin->component) ?></option>
                </select>

                <label for='trigger' id='triggerText' class="row2 col1"><?php echo get_string('mark_autoexport_triggertype', $plugin->component) ?>:</label>
                <select id="trigger" class="row2 col2">
                    <option value="0" selected><?php echo get_string('mark_autoexport_triggertype_manual', $plugin->component) ?></option>
                    <option value="1"><?php echo get_string('mark_autoexport_triggertype_onfinish', $plugin->component) ?></option>
                    <option value="2"><?php echo get_string('mark_autoexport_triggertype_ondate', $plugin->component) ?></option>
                </select>
            </div>
            <div style="display: flex; flex-direction: column" id="trigger_settings">
                <div style="padding-bottom: 15px"><?php echo get_string('mark_autoexport_trigger_settings', $plugin->component) ?>:</div>
                <div id="trigger_settings_onfinishparams" class="lp-grid" style="margin-left: 30px">
                    <label class="row1 col1">Режим оценивания:</label>
                    <select id="trigger_settings_onfinishparams_marking" class="row1 col2">
                        <option value="0" selected>Первая попытка</option>
                        <option value="1">Каждая попытка (Обновление)</option>
                    </select>
                    <label class="row2 col1">При закрытии теста:</label>
                    <select id="trigger_settings_onfinishparams_on_test_close" class="row2 col2">
                        <option value="0" selected>Обнулить не завершённые попытки</option>
                        <option value="1">Не учитывать не завершённые попытки</option>
                    </select>
                </div>
                <div id="trigger_settings_ondateparams" class="lp-grid hidden" style="margin-left: 30px"><label class="col1">Дата выставления:</label>
                    <div style="display: flex; flex-direction: row; gap: 10px">
                        <select id="trigger_settings_ondateparams_date_day" style="min-width: 40px;">
                            <?php
                            for($i = 1; $i <= 31; $i++){
                                $selected = "";
                                if($i == $today->format("j"))
                                    $selected = "selected";
                                echo "<option value='{$i}' {$selected}>{$i}</option>";
                            }
                            ?>
                        </select>
                        <select id="trigger_settings_ondateparams_date_month" style="min-width: 40px;">
                            <?php
                            for($i = 1; $i <= 12; $i++){
                                $selected = "";
                                if($i == $today->format("n"))
                                    $selected = "selected";
                                echo "<option value='{$i}' {$selected}>" . get_string("month_{$i}", $plugin->component) . "</option>";
                            }
                            ?>
                        </select>
                        <select id="trigger_settings_ondateparams_date_year" style="min-width: 40px;">
                            <?php
                            for($i = 1900; $i < 2051; $i++){
                                $selected = "";
                                if($i == $today->format("Y"))
                                    $selected = "selected";
                                echo "<option value='{$i}' {$selected}>{$i}</option>";
                            }
                            ?>
                        </select>
                        <select id="trigger_settings_ondateparams_date_hour" style="min-width: 40px;">
                            <?php
                            for($i = 0; $i < 24; $i++){
                                $selected = "";
                                if($i == $today->format("G"))
                                    $selected = "selected";
                                if($i > 9)
                                    echo "<option value='{$i}' {$selected}>{$i}</option>";
                                else
                                    echo "<option value='{$i}' {$selected}>0{$i}</option>";
                            }
                            ?>
                        </select>
                        <select id="trigger_settings_ondateparams_date_minute" style="min-width: 40px;">
                            <?php
                            for($i = 0; $i < 60; $i++){
                                $selected = "";
                                if($i == $today->format("i"))
                                    $selected = "selected";
                                if($i > 9)
                                    echo "<option value='{$i}' {$selected}>{$i}</option>";
                                else
                                    echo "<option value='{$i}' {$selected}>0{$i}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <label class="col1">Режим оценивания:</label>
                    <select id="trigger_settings_ondateparams_marking" class="col2">
                        <option value="0" selected>Первая попытка</option>
                        <option value="1">Лучшая попытка</option>
                    </select>
                    <label class="col1">При выставлении отметок:</label>
                    <select id="trigger_settings_ondateparams_on_test_processing" class="col2">
                        <option value="0">Обнулить не завершённые попытки</option>
                        <option value="1">Не учитывать не завершённые попытки</option>
                    </select>
                </div>
            </div>
            <div style="display: flex; flex-direction: column" id="mark_settings">
                <div style="padding-bottom: 15px">Параметры оценивания:</div>
                <div class="lp-grid" style="margin-left: 30px">
                    <label class="row1 col1">Шкала оценивания:</label>
                    <select id="mark_settings_scale_type" class="row1 col2">
                        <option value="0" selected>По умолчанию</option>
                        <option value="1">Переопределённая</option>
                    </select>
                    <label id="mark_settings_m5_t" class="col1">Отметка "5": </label>
                    <input id="mark_settings_m5" class="col2" type="number" min="0" max="100" value="0"/>
                    <label id="mark_settings_m4_t" class="col1">Отметка "4": </label>
                    <input id="mark_settings_m4" class="col2" type="number" min="0" max="100" value="0"/>
                    <label id="mark_settings_m3_t" class="col1">Отметка "3": </label>
                    <input id="mark_settings_m3" class="col2" type="number" min="0" max="100" value="0"/>
                    <label id="mark_settings_m2_t" class="col1">Отметка "2": </label>
                    <input id="mark_settings_m2" class="col2" type="number" min="0" max="100" value="0"/>
                    <label id="mark_settings_m1_t" class="col1">Отметка "1" если не сдано: </label>
                    <select id="mark_settings_m1" class="col2">
                        <option value="0" selected>Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; gap: 10px; width: 100%;">
                <button style="width: calc(50% - 5px)" id="save">Сохранить</button>
                <button style="width: calc(50% - 5px)" id="cancel">Отменить</button>
            </div>
        </div>
        <script>
            function updateEnabled() {
                let state = document.getElementById('enable').value;
                if(state == 0){
                    document.getElementById('trigger').classList.add('hidden');
                    document.getElementById('triggerText').classList.add('hidden');
                    document.getElementById('trigger_settings').classList.add('hidden');
                    document.getElementById('mark_settings').classList.add('hidden');
                } else {
                    document.getElementById('trigger').classList.remove('hidden');
                    document.getElementById('triggerText').classList.remove('hidden');
                    document.getElementById('trigger_settings').classList.remove('hidden');
                    document.getElementById('mark_settings').classList.remove('hidden');
                    updateTrigger();
                    updateMark();
                }
            }
            function updateTrigger() {
                let value = document.getElementById('trigger').value;
                if(value == 0){
                    document.getElementById('trigger_settings').classList.add('hidden');
                    document.getElementById('trigger_settings_onfinishparams').classList.add('hidden');
                    document.getElementById('trigger_settings_ondateparams').classList.add('hidden');
                } else if(value == 1){
                    document.getElementById('trigger_settings').classList.remove('hidden');
                    document.getElementById('trigger_settings_onfinishparams').classList.remove('hidden');
                    document.getElementById('trigger_settings_ondateparams').classList.add('hidden');
                } else {
                    document.getElementById('trigger_settings').classList.remove('hidden');
                    document.getElementById('trigger_settings_onfinishparams').classList.add('hidden');
                    document.getElementById('trigger_settings_ondateparams').classList.remove('hidden');
                }
            }
            function updateMark() {
                let value = document.getElementById('mark_settings_scale_type').value;
                if(value == 0){
                    document.getElementById('mark_settings_m1').classList.add('hidden');
                    document.getElementById('mark_settings_m2').classList.add('hidden');
                    document.getElementById('mark_settings_m3').classList.add('hidden');
                    document.getElementById('mark_settings_m4').classList.add('hidden');
                    document.getElementById('mark_settings_m5').classList.add('hidden');
                    document.getElementById('mark_settings_m1_t').classList.add('hidden');
                    document.getElementById('mark_settings_m2_t').classList.add('hidden');
                    document.getElementById('mark_settings_m3_t').classList.add('hidden');
                    document.getElementById('mark_settings_m4_t').classList.add('hidden');
                    document.getElementById('mark_settings_m5_t').classList.add('hidden');
                } else {
                    document.getElementById('mark_settings_m1').classList.remove('hidden');
                    document.getElementById('mark_settings_m2').classList.remove('hidden');
                    document.getElementById('mark_settings_m3').classList.remove('hidden');
                    document.getElementById('mark_settings_m4').classList.remove('hidden');
                    document.getElementById('mark_settings_m5').classList.remove('hidden');
                    document.getElementById('mark_settings_m1_t').classList.remove('hidden');
                    document.getElementById('mark_settings_m2_t').classList.remove('hidden');
                    document.getElementById('mark_settings_m3_t').classList.remove('hidden');
                    document.getElementById('mark_settings_m4_t').classList.remove('hidden');
                    document.getElementById('mark_settings_m5_t').classList.remove('hidden');
                }
            }
            function onLoad() {
                let e = document.querySelectorAll('button');
                for (let i = 0; i < e.length; i++) {
                    e[i].addEventListener('mouseenter', x => {
                        x.target.classList.add('mouse-in');
                    });
                    e[i].addEventListener('mouseleave', x => {
                        x.target.classList.remove('mouse-in');
                    });
                }
                document.getElementById('enable').addEventListener('change', (e) => {updateEnabled()});
                document.getElementById('trigger').addEventListener('change', (e) => {updateTrigger()});
                document.getElementById('mark_settings_scale_type').addEventListener('change', (e) => {updateMark()});
                updateEnabled();
                document.getElementById('cancel').addEventListener('click', (e) => {
                    location.reload();
                });
                document.getElementById('save').addEventListener('click', (e) => {
                    fetch(window.location.href, {
                        method: "POST",
                        body: JSON.stringify({
                            enable: Number(document.getElementById('enable').value),
                            trigger: Number(document.getElementById('trigger').value),
                            trigger_params: {
                                trigger_settings_onfinishparams: {
                                    marking: Number(document.getElementById('trigger_settings_onfinishparams_marking').value),
                                    on_test_close: Number(document.getElementById('trigger_settings_onfinishparams_on_test_close').value)
                                },
                                trigger_settings_ondateparams: {
                                    date: {
                                        day: Number(document.getElementById('trigger_settings_ondateparams_date_day').value),
                                        month: Number(document.getElementById('trigger_settings_ondateparams_date_month').value),
                                        year: Number(document.getElementById('trigger_settings_ondateparams_date_year').value),
                                        hour: Number(document.getElementById('trigger_settings_ondateparams_date_hour').value),
                                        minute: Number(document.getElementById('trigger_settings_ondateparams_date_minute').value),
                                    },
                                    marking: Number(document.getElementById('trigger_settings_ondateparams_marking').value),
                                    on_test_processing: Number(document.getElementById('trigger_settings_ondateparams_on_test_processing').value)
                                }
                            },
                            mark_params: {
                                mark_settings_scale_type: Number(document.getElementById('mark_settings_scale_type').value),
                                mark_redefined: {
                                    1: Number(document.getElementById('mark_settings_m1').value),
                                    2: Number(document.getElementById('mark_settings_m2').value),
                                    3: Number(document.getElementById('mark_settings_m3').value),
                                    4: Number(document.getElementById('mark_settings_m4').value),
                                    5: Number(document.getElementById('mark_settings_m5').value)
                                }
                            }
                        })
                    });
                });
            }
            onLoad();
        </script>
    </body>
</html>
