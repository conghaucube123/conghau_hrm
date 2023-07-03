<style>
    .list {
        border: #f1f1f1f1 3px solid;
        border-radius: 20px;
        padding: 20px;
        margin-left: 30px;
        margin-right: 30px;
    }
    .course-detail {
        border: #f1f1f1f1 2px solid;
        border-radius: 5px;
        margin: 20px 0px;
        padding: 10px;
    }
    #success-message {
        display: none;
    }
    .table-container {
        border: #f1f1f1f1 2px solid;
        border-radius: 5px;
        margin: 20px 0px;
        padding: 20px;
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
    .col-md-2 img {
        border-radius: 50%;
        height: 150px;
        width: 150px; 
    }
    #btn {
        float: right;
    }
    .add {
        float: right;
        margin-bottom: 20px;
    }
    .form-group.error input,
    .col-md-8.error input {
        border-color: red;
    }
    .form-group .error-message,
    .col-md-8 .error-message {
        color: red;
        display: none;
    }
    .form-group.error .error-message,
    .col-md-8.error .error-message {
        display: inline;
    }
    .alert a {
        text-decoration: none;
    }
    @media (max-width: 768px) {
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
    <h3><?php echo lang('course_info'); ?></h3>
    <!-- Course detail input -->
    <div class="course-detail">
        <form id="course-info" class="form-horizontal form-label-left" role="form" action="<?php echo $this->uri->segment('3'); ?>" method="post" onsubmit="return validateCourse()">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-11" id="btn">
                    <div class="col-md-12 col-sm-12 col-xs-7" style="text-align: right;">
                        <button type="button" class="btn btn-info" style="color:#ffffff;" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?></button>
                        <button type="submit" class="btn btn-primary" style="color:#ffffff;"><i class="far fa-save"></i> <?php echo lang('save'); ?></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="name"><?php echo lang('course_name_1'); ?><sup style="color: red;">*</sup></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($namer)) {echo $namer;}  else {echo $course['name'];} ?>" onblur="validateName()">
                        <span class="error-message">Error message</span>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="startDate"><?php echo lang('start_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="startDate" name="startDate" style="cursor: pointer;" value="<?php if (isset($startDater)) {echo $startDater;} else {echo $course['start_date'];} ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="time"><?php echo lang('time_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="input-group date" id="timePicker">
                            <input type="text" class="form-control timePicker" id="time" name="time" value="<?php if (isset($timer)) {echo $timer;} else {echo $course['time'];} ?>">
                            <span class="input-group-addon"><i class="far fa-clock"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="endDate"><?php echo lang('end_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="endDate" name="endDate" style="cursor: pointer;" value="<?php if (isset($endDater)) {echo $endDater;} else {echo $course['end_date'];} ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="weekDay"><?php echo lang('week_days_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                    <?php
                        if (isset($weekDayr)) {
                            $weekDays = explode(', ', $weekDayr);
                        }  else {
                            $weekDays = explode(', ', $course['weekdays']);
                        } 
                        $weekDaysArr = ['2', '3', '4', '5', '6', '7', '8',];
                        $weekDaysName = ['mon', 'tue', 'wed', 'thu', 'fri', 'sta', 'sun',];
                        $i = 0;
                        foreach ($weekDaysArr as $weekDay) {
                            $checked = in_array($weekDay, $weekDays) ? 'checked = "checked"' : '';
                            echo '<div class="checkbox checkbox-inline"><input type="checkbox" id="'. $weekDaysName[$i] .'" name="weekDays[]" value="'. $weekDay .'"'. $checked .'><label for="'. $weekDaysName[$i] .'"> '. $weekDay .' </label></div>';
                            $i = $i + 1;
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6"><?php echo lang('course_type_1'); ?><sup style="color: red;">*</sup></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="checkbox radio-inline">
                            <input class="form-check-input" type="radio" id="course" name="type" value="1" <?php if(isset($courseTyper) && ($courseTyper === '1')) {echo 'checked="checked"';} else if ($course['course_type'] === '1') {echo 'checked="checked"';} ?>>
                            <label for="course"><?php echo lang('course_1'); ?></label>
                        </div>
                        <div class="checkbox radio-inline">
                            <input class="form-check-input" type="radio" id="event" name="type" value="2" <?php if(isset($courseTyper) && ($courseTyper === '2')) {echo 'checked="checked"';} else if ($course['course_type'] === '2') {echo 'checked="checked"';} ?>>
                            <label for="event"><?php echo lang('event'); ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-11">
                    <div class="col-md-12 col-sm-12 col-xs-10">
                        <input type="hidden" class="form-control" id="courseId" value="<?php echo $course['id']; ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Datatable serverside -->
    <div class="table-container">  
        <h4><?php echo lang('employee_list'); ?></h4>
        <div class="add">
            <button type="button" class="btn btn-primary" style="color:#ffffff;" data-toggle="modal" data-target="#addEmployeeModal"><i class="fas fa-plus"></i> <?php echo lang('add'); ?></button>
            <button type="button" class="btn btn-success" style="color:#ffffff;" data-toggle="modal" data-target="#uploadEmployeeFileModal"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button>
            <button type="button" id="export-employee-list-template" class="btn btn-info" style="color:#ffffff;"><i class="fas fa-file-export"></i> <?php echo lang('template'); ?></button>
        </div>
        <table id="employeeTable" class="table table-bordered display compact" width="100%">
            <thead>
                <tr>
                    <th class="title"><?php echo lang('employee_id'); ?></th>
                    <th class="title"><?php echo lang('image'); ?></th>
                    <th class="title"><?php echo lang('fullname'); ?></th>
                    <th class="title"><?php echo lang('email'); ?></th>
                    <th class="title"><?php echo lang('birthday'); ?></th>
                    <th class="title"><?php echo lang('gender'); ?></th>
                    <th class="title"><?php echo lang('mobile'); ?></th>
                    <th class="title"><?php echo lang('address'); ?></th>
                    <th class="title"><?php echo lang('action') ?></th>
                </tr>
                </thead>
            <tbody></tbody>
        </table>
    </div>
    
    <!-- The add employee modal -->
    <div id="addEmployeeModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form role="form" action="" method="post">
                    <div class="modal-header"  style="text-align: center;">
                        <button type="button" id="close-add" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                        <h4 class="modal-title"><?php echo lang('add_employee') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div id="add-processing">
                                <button class="btn btn-default"><i class="fas fa-spinner"></i> Loading...</button>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-9">
                                    <div  class="form-group">
                                        <div id="image">
                                            <img src="<?php echo base_url('images/user-2.png'); ?>" class="img-responsive" id="avatar-image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group" id="employee-id-error">
                                        <label for="employeeId_"><?php echo lang('employee_id_1'); ?><sup style="color: red;">*</sup>:</label>
                                        <input type="text" class="flexdatalist form-control" id="employeeId_" name="employeeId_" value="" data-data='<?php echo base_url('Courses/getProfileData') ?>' data-search-in='employeeId' data-min-length='0'>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday_"><?php echo lang('birthday_1'); ?>: </label>
                                        <input type="date" class="form-control" id="birthday_" name="birthday_" value="" style="cursor: pointer;">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('gender_1'); ?>:</label>     
                                        <div class="">
                                            <div class="checkbox radio-inline">
                                                <input class="form-check-input" type="radio" name="gender_" id="male_" value="1">
                                                <label for="male_"><?php echo lang('male'); ?></label>
                                            </div>
                                            <div class="checkbox radio-inline">
                                                <input class="form-check-input" type="radio" name="gender_" id="female_" value="2">
                                                <label for="female_"><?php echo lang('female'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group">
                                        <label for="fullname_"><?php echo lang('fullname_1'); ?>: </label>
                                        <input type="text" class="form-control" id="fullname_" name="fullname_" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_"><?php echo lang('mobile_1'); ?>: </label>
                                        <input type="text" class="form-control" id="mobile_" name="mobile_" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email_"><?php echo lang('email_1'); ?>: </label>
                                        <input type="text" class="form-control" id="email_" name="email_" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-9"></div>
                                <div class="col-md-6 col-sm-9">
                                    <div class="form-group">
                                        <label for="address"><?php echo lang('address_1'); ?>:</label>          
                                        <textarea class="form-control" id="address_" name="address_" rows="3"></textarea>
                                    </div>
                                    <input type="hidden" class="form-control" id="profileId_" name="profileId_" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-add" class="btn btn-primary" style="color:#ffffff" onclick=""><i class="far fa-save"></i> <?php echo lang('save'); ?></button>
                        <button type="button" id="cancle-add" class="btn btn-warning" style="color:#ffffff" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('cancle'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Upload Employee file -->
    <div id="uploadEmployeeFileModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="text-align: center;">
                        <button type="button" id="close-upload" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                        <h4 class="modal-title"><?php echo lang('upload_employee_list') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="file-upload-employee-list" class="col-sm-2 control-label"><?php echo $this->lang->line('excel_file'); ?><sup style="color: red;">*</sup></label>
                                <div class="col-sm-9" id="upload-error">
                                    <div class="input-group file">
                                        <input id="file-upload-employee-list" type="text" class="form-control" name="file-upload-employee-list" placeholder="<?php echo $this->lang->line('file_name'); ?>" readonly>
                                        <span id="choose-file-employee-list" class="btn btn-primary input-group-addon" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"><?php echo $this->lang->line('choose_file'); ?></span>
                                    </div>
                                    <input type="file" id="file-upload-employee-list-hidden" name="file-upload-employee-list-hidden" style="display:none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                            </div>
                            <div id="upload-processing">
                                <button class="btn btn-default"><i class="fas fa-spinner"></i> Loading...</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="upload-file" class="btn btn-success" style="color:#ffffff;"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button>
                        <button type="button" id="cancle-upload" class="btn btn-warning" style="color:#ffffff;" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('cancle'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The delete modal -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title" id="confirm-delete-title"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" style="color:#ffffff" id="confirm-delete"><i class="fas fa-check"></i> <?php echo lang('yes'); ?></button>
                    <button type="button" class="btn btn-warning" style="color:#ffffff" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('no'); ?></button>
                </div>
            </div>
        </div>
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
        function eventCheck()
        {
            $('.checkbox-inline').css('cursor', 'text');
            $('#mon').attr('disabled', 'disabled');
            $('#tue').attr('disabled', 'disabled');
            $('#wed').attr('disabled', 'disabled');
            $('#thu').attr('disabled', 'disabled');
            $('#fri').attr('disabled', 'disabled');
            $('#sta').attr('disabled', 'disabled');
            $('#sun').attr('disabled', 'disabled');
        }
        if ($('#event').is(":checked")) {
            eventCheck();
        }
        $('#event').on('change', function() {
            if ($('#event').is(":checked")) {
                eventCheck();
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

        // Aotucomplete Employee ID when click Add button
        $('#employeeId_').flexdatalist({
            minLength: 0,
            searchIn: 'employeeId',
            data: '<?php echo base_url('Courses/getProfileData') ?>',
        }).on('select:flexdatalist', function(event, data) {
            console.log($('#employeeId_').val());
            $('#employeeId_').val(data.employeeId);
            if ((data.image != null) && (data.image != '')) {
                url = '<?php echo base_url('public/images/'); ?>' + data.image;
                $('#avatar-image').attr('src', url);
            }
            $('#birthday_').val(data.birthday);
            $('#fullname_').val(data.name);
            $('#mobile_').val(data.mobile);
            $('#email_').val(data.email);
            $('#address_').val(data.address);
            if (data.gender === '1') {
                $('#male_').attr('checked', 'checked');
            } else {
                $('#female_').attr('checked', 'checked');
            }
            $('#profileId_').val(data.id);
        });

        // Unset value and error when change Employee ID or close modal
        function unsetEmployeeId()
        {
            $('.data-add-error').remove();
            $('#avatar-image').attr('src', '<?php echo base_url('images/user-2.png'); ?>');
            $('#employeeId_').val('')
            $('#birthday_').val('');
            $('#fullname_').val('');
            $('#mobile_').val('');
            $('#email_').val('');
            $('#address_').val('');
            $('#male_').removeAttr('checked');
            $('#female_').removeAttr('checked');
            $('#profileId_').val('');
        }

        $('#employeeId_').on('change', function() {
            $('.data-add-error').remove();
            if ($('#employeeId_').val() === '') {
                unsetEmployeeId();
            }
        });

        $(document).on('click', function(event) {
            if ($('#addEmployeeModal').is(event.target) && $(event.target).closest('#addEmployeeModal').length) {
                unsetEmployeeId();
            }
            if (!$('#uploadEmployeeFileModal').is(event.target) && ($('#uploadEmployeeFileModal').has(event.target).length === 0)) {
                unsetFileUpload();
            }
        });

        $("#close-add, #cancle-add").on('click', function() {
            unsetEmployeeId();
        });

        // Submit form add Employee
        $('#save-add').on('click', function() {
            if ($('#employeeId_').val() === '') {
                $('#employee-id-error').append('<span class="data-add-error" style="color:red"><?php echo lang('EMPLOYEEID005'); ?></span><br class="data-add-error">');
            } else {
                $('#add-processing').css('display', 'block');
                var formData = new FormData();
                formData.append('courseId_', '<?php echo $course['id']; ?>');
                formData.append('courseName_', '<?php echo $course['name']; ?>');
                formData.append('profileId_', $('#profileId_').val());
                formData.append('fullname_', $('#fullname_').val());
                $.ajax({
                    url: '<?php echo base_url('Courses/addEmployee')?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        $('#add-processing').css('display', 'none');
                        if (!response.success) {
                            var arr = response.message.split('<br>');
                            arr.forEach(function(element) {
                                if (element != '') {
                                    $('#employee-id-error').append('<span class="data-add-error" style="color:red">' + element + '</span><br class="data-add-error">');
                                }
                            });
                            
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });

        // Add file name to input box
        $('#file-upload-employee-list').css('cursor', 'pointer');
        $("#choose-file-employee-list, #file-upload-employee-list").on("click", function() {
            $("#file-upload-employee-list-hidden").trigger("click");
        });

        // Choose file Employee list
        $("#file-upload-employee-list-hidden").on('change', function() {
            if(this.value.length > 0) {
                var pathFile = this.value.replace(/^.*[\\\/]/, '');
                $("#file-upload-employee-list").val(pathFile);
            } else {
                $("#file-upload-employee-list").val('<?php echo $this->lang->line('file_name'); ?>');
            }
            $('.data-upload-error').remove();
        });

        // Unset value and error when close modal
        function unsetFileUpload()
        {
            $("#file-upload-employee-list").val('<?php echo $this->lang->line('file_name'); ?>');
            $('.data-upload-error').remove();
            $('#file-upload-employee-list-hidden').val('');
        }

        // Unset value and error when close upload file Employee list
        $("#close-upload, #cancle-upload").on('click', function() {
            unsetFileUpload();
        });

        // Upload file Employee list
        $('#upload-file').on('click', function() {
            if ($('#file-upload-employee-list-hidden')[0].files[0] === undefined) {
                $('#upload-error').append('<span class="data-upload-error" style="color:red"><?php echo lang('UPLOAD001'); ?></span><br class="data-upload-error">');
            } else {
                $('#upload-processing').css('display', 'block');
                var formData = new FormData();
                formData.append('file-upload-employee-list-hidden', $('#file-upload-employee-list-hidden')[0].files[0]);
                formData.append('courseId', '<?php echo $course['id']; ?>');
                $.ajax({
                    url: '<?php echo base_url('Courses/upload')?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        $('#upload-processing').css('display', 'none');
                        if (!response.success) {
                            var arr = response.message.split('<br>');
                            arr.forEach(function(element) {
                                if (element != '') {
                                    $('#upload-error').append('<span class="data-upload-error" style="color:red">' + element + '</span><br class="data-upload-error">');
                                }
                            });
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        });

        // Export Employee list template
        $('#export-employee-list-template').on('click', function() {
            var form = $('<form/>', {
                action: '<?php echo base_url('Courses/exportEmployeeListTemplate'); ?>',
                method: 'post',
            });
            form.appendTo('body').submit();
        });

        // Get data for Course list datatable serverside
        var lang = '<?php echo $this->session->userdata('site_lang'); ?>';
        console.log(lang);
        if (lang == 'vietnamese') {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json';
        } else {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
        }
        var employeeTable = $('#employeeTable').DataTable({
            fixedHeader: true,
            scrollCollapse: true,
            scrollX: "100%", 
            language: {
                url: languageUrl,
            },
            formatNumber: function ( toFormat ) {
                return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "'");
            },
            paging: false,
            info: false,
            responsive: true,
            stateSave: true,
            stateDuration: 0,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('Courses/filterEmployeeListData') ?>", 
                dataType: 'json',
                type: 'POST',
                data: {
                    // Truyền dữ liệu search vào đây
                    courseId: String($('#courseId').val()),
                },
            },
            columns: [
                { 
                    data: "employeeID",
                    className: "dt-head-center",
                },
                {
                    data: "image",
                    className: "image-group dt-head-center",
                    render: function (data, type, row, meta) {
                        if ((data != null) && (data != '')) {
                            return '<img src="<?php echo base_url('public/images/'); ?>'+ data +'" class="img-responsive" id="face-image" style="width:50px; height: 50px; border-radius: 50%;">';
                        }
                        return '<img src="<?php echo base_url('images/user-2.png'); ?>" class="img-responsive" id="face-image" style="width:50px; height: 50px; border-radius: 50%;">';
                    },
                    orderable: false,
                },
                {
                    data: "name",
                    className: "dt-head-center",
                },
                {
                    data: "email",
                    className: "dt-head-center",
                },
                {
                    data: "birthday",
                    className: "dt-center",
                },
                {
                    data: "gender",
                    className: "dt-center",
                },
                {
                    data: "mobile",
                    className: "dt-center",
                },
                {
                    data: "address",
                    className: "dt-head-center",
                },
                {
                    data: "profileId",
                    className: "button-group dt-head-center",
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="<?php echo lang('delete'); ?>"><span class="glyphicon glyphicon-trash"></span></button>';
                    },
                    createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
                        $(cell).find('button').click(function (e) {
                            $('#deleteModal').modal('show', rowData);
                        });
                    },
                    orderable: false,
                },
            ],
        });

        $('[data-toggle="tooltip"]').tooltip();

        // Show delete modal
        $('#deleteModal').on('show.bs.modal', function (e) {
            const rowData = e.relatedTarget;
            $('#confirm-delete').attr({'name': rowData.profileId, 'value': rowData.courseId});
            $('#confirm-delete-title').html('<?php echo lang('DELETE002'); ?> '+ rowData.name +'?');
        })

        // When click Yes in delete modal
        $('#confirm-delete').on('click', function() {
            var profileId = $('#confirm-delete').attr('name');
            var courseId = $('#confirm-delete').attr('value');
            $.ajax({
                url: "<?php echo base_url('Courses/deleteEmployee') ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    profileId: profileId,
                    courseId: courseId,
                },
                success: function(response) {
                    location.reload();
                },
            });
        });
    });

    // Initialize variable to validate
    const nameEle = document.getElementById('name');

    // Validate when user click "Save" button in Course information and have some error
    function validateCourse()
    {
        let name = validateName();
        if (!name) {
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