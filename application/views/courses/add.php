<style>
    .list {
        border: #f1f1f1f1 2px solid;
        border-radius: 20px;
        padding: 20px;
        margin-left: 30px;
        margin-right: 30px;
    }
    .dataTables_filter { 
        display: none;
    }
    .image-group img {
        margin-left: auto;
        margin-right: auto;
    }
    .button-group {
        text-align: center;
    }
    .col-md-3 img {
        border-radius: 50%;
        height: 150px;
        width: 150px; 
    }
    #btn {
        float: right;
        margin-bottom: 30px;
    }
    .col-md-5 {
        margin-bottom: 20px;
    }
    .col-md-8.error input {
        border-color: red;
    }
    .col-md-8 .error-message {
        color: red;
        display: none;
    }
    .col-md-8.error .error-message {
        display: inline;
    }
    .alert a {
        text-decoration: none;
    }
    @media (max-width: 768px) {
        /* #btn {
            float: right;
            width: 23%;
        } */
        .col-md-3 img {
            height: 250px;
            width: 250px; 
        }
        #image{
            display: flex;
            justify-content: center;
        }
    }
</style>

<div class="list">
    <!-- Add course detail input -->
    <div class="add-course-detail">
        <h3><?php echo lang('add_new_course'); ?></h3>
        <form class="form-horizontal form-label-left" role="form" action="add" method="post" onsubmit="return validate()">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-11" id="btn">
                    <div class="col-md-12 col-sm-7 col-xs-7" style="text-align: right;">
                        <button type="button" class="btn btn-info" style="color:#ffffff;" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?></button>
                        <!-- <button type="button" class="btn btn-primary" style="color:#ffffff;"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button> -->
                        <button type="submit" class="btn btn-primary" style="color:#ffffff;"><i class="fas fa-plus"></i> <?php echo lang('add'); ?></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="name"><?php echo lang('course_name_1'); ?><sup style="color: red;">*</sup></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($namer)) {echo $namer;} ?>" onblur="validateName()">
                        <span class="error-message">Error message</span>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="startDate"><?php echo lang('start_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="startDate" name="startDate" style="cursor: pointer;" value="<?php if (isset($startDater)) {echo $startDater;} ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="time"><?php echo lang('time_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="input-group date" id="timePicker">
                            <input type="text" class="form-control timePicker" id="time" name="time" value="<?php if (isset($timer)) {echo $timer;} ?>">
                            <span class="input-group-addon"><i class="far fa-clock"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="endDate"><?php echo lang('end_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="endDate" name="endDate" style="cursor: pointer;" value="<?php if (isset($endDater)) {echo $endDater;} ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="weekDay"><?php echo lang('week_days_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <?php
                            if (isset($weekDaysr) && !empty($weekDaysr)) { 
                                $weekDaysArr = ['2', '3', '4', '5', '6', '7', '8',];
                                $weekDaysName = ['mon', 'tue', 'wed', 'thu', 'fri', 'sta', 'sun',];
                                $i = 0;
                                foreach ($weekDaysArr as $weekDay) {
                                    $checked = in_array($weekDay, $weekDaysr) ? 'checked = "checked"' : '';
                                    echo '<div class="checkbox checkbox-inline"><input type="checkbox" id="'. $weekDaysName[$i] .'" name="weekDays[]" value="'. $weekDay .'"'. $checked .'><label for="'. $weekDaysName[$i] .'"> '. $weekDay .' </label></div>';
                                    $i = $i + 1;
                                }
                            } else {
                                $weekDaysArr = ['2', '3', '4', '5', '6', '7', '8',];
                                $weekDaysName = ['mon', 'tue', 'wed', 'thu', 'fri', 'sta', 'sun',];
                                $i = 0;
                                foreach ($weekDaysArr as $weekDay) {
                                    echo '<div class="checkbox checkbox-inline"><input type="checkbox" id="'. $weekDaysName[$i] .'" name="weekDays[]" value="'. $weekDay .'"><label for="'. $weekDaysName[$i] .'"> '. $weekDay .' </label></div>';
                                    $i = $i + 1;
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6"><?php echo lang('course_type_1'); ?><sup style="color: red;">*</sup></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <span id="type"></span>
                        <div class="checkbox radio-inline">
                            <input class="form-check-input" type="radio" id="course" name="type" value="1" <?php if(isset($courseTyper) && ($courseTyper === '1')) echo 'checked="checked"'; ?>>
                            <label for="course"><?php echo lang('course_1'); ?></label>
                        </div>
                        <div class="checkbox radio-inline">
                            <input class="form-check-input" type="radio" id="event" name="type" value="2" <?php if(isset($courseTyper) && ($courseTyper === '2')) echo 'checked="checked"'; ?>>
                            <label for="event"><?php echo lang('event'); ?></label>
                        </div>
                        <div>
                            <span class="error-message">Error message</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
           
<script>
    $(function ()
    {
        // Custom time input
        $('#timePicker').datetimepicker({
            useCurrent: false,
            format: "HH:mm",
        });

        // Disabled Week days if Course Type is event
        $('#event').on('change', function() {
            if ($('#event').is(":checked")) {
                $('.checkbox-inline').css('cursor', 'text');
                $('#mon').attr('disabled', 'disabled');
                $('#tue').attr('disabled', 'disabled');
                $('#wed').attr('disabled', 'disabled');
                $('#thu').attr('disabled', 'disabled');
                $('#fri').attr('disabled', 'disabled');
                $('#sta').attr('disabled', 'disabled');
                $('#sun').attr('disabled', 'disabled');
            }
        });

        $('#course').on('change', function() {
            if ($('#course').is(":checked")) {
                $('.checkbox-inline').css('cursor', 'pointer');
                $('#mon').removeAttr('disabled');
                $('#tue').removeAttr('disabled');
                $('#wed').removeAttr('disabled');
                $('#thu').removeAttr('disabled');
                $('#fri').removeAttr('disabled');
                $('#sta').removeAttr('disabled');
                $('#sun').removeAttr('disabled');
            }
        });
    });

    // Initialize variable to validate
    const nameEle = document.getElementById('name');
    const typeEle = document.getElementById('type');

    // Validate when user click "Add" button and have some error
    function validate()
    {
        let name = validateName();
        let type = validateType();
        if (!name || !type) {
            return false;
        }
        return true;
    };

    // Validate Course Name
    function validateName()
    {
        let parentEle = nameEle.parentNode;
        parentEle.classList.remove('success', 'error');
        return checkName();
    }

    function checkName()
    {
        let nameValue = nameEle.value;
        let isCheck = true;

        if (nameValue === '') {
            setError(nameEle, '<?php echo lang('C_NAME001'); ?>');
            isCheck = false;
        } else if (nameValue.length > 255) {
            setError(nameEle, '<?php echo lang('C_NAME002'); ?>');
            isCheck = false;
        } else {
            setSuccess(nameEle);
        }

        return isCheck;
    }

    // Validate Course Type
    function validateType()
    {
        let parentEle = typeEle.parentNode;
        parentEle.classList.remove('success', 'error');
        return checkTypeame();
    }

    function checkTypeame()
    {
        let typeValue = typeEle.value;
        let isCheck = true;

        if (!$('#course').is(":checked") && !$('#event').is(":checked")) {
            setError(typeEle, '<?php echo lang('C_TYPE001'); ?>');
            isCheck = false;
        } else {
            setSuccess(typeEle);
        }

        return isCheck;
    }

    function setSuccess(ele)
    {
        ele.parentNode.classList.add('success');
    }

    function setError(ele, message)
    {
        let parentEle = ele.parentNode;
        parentEle.classList.add('error');
        parentEle.querySelector('.error-message').innerHTML = message;
    }
</script>