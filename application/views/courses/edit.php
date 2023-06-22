<style>
    .list {
        border: #f1f1f1f1 3px solid;
        border-radius: 20px;
        padding: 10px;
        margin-left: 30px;
        margin-right: 30px;
    }
    .course-detail {
        border: #f1f1f1f1 2px solid;
        border-radius: 5px;
        padding: 10px;
    }
    .table-container {
        border: #f1f1f1f1 2px solid;
        border-radius: 5px;
        margin: 20px 10px;
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
        /* #btn {
            float: right;
            width: 50%;
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
    <h3><?php echo lang('course_info'); ?></h3>
    <!-- Course detail input -->
    <div class="course-detail">
        <form class="form-horizontal form-label-left" role="form" action="<?php echo $this->uri->segment('3'); ?>" method="post" onsubmit="return validateCourse()">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-11" id="btn">
                    <div class="col-md-12 col-sm-12 col-xs-7" style="text-align: right;">
                        <button type="button" class="btn btn-primary" style="color:#ffffff;" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?></button>
                        <!-- <button type="button" class="btn btn-warning" style="color:#ffffff;"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button> -->
                        <button type="submit" class="btn btn-success" style="color:#ffffff;"><i class="far fa-save"></i> <?php echo lang('save'); ?></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-1">
                    <?php
                        if (isset($course_message) && !empty($course_message)) {
                            echo '       
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close"><i class="fas fa-times"></i></button>
                                    <strong><i class="fas fa-check"></i> '.$course_message.'</strong>
                                </div>';
                        }
                    ?>
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
                            echo '<label class="checkbox-inline"><input type="checkbox" id="'. $weekDaysName[$i] .'" name="weekDays[]" value="'. $weekDay .'"'. $checked .'> '. $weekDay .' </label>';
                            $i = $i + 1;
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6"><?php echo lang('course_type_1'); ?><sup style="color: red;">*</sup></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <label class="radio-inline">
                            <input class="form-check-input" type="radio" id="course" name="type" value="1" <?php if(isset($courseTyper) && ($courseTyper === '1')) {echo 'checked="checked"';} else if ($course['course_type'] === '1') {echo 'checked="checked"';} ?>>
                            <?php echo lang('course_1'); ?>
                        </label>
                        <label class="radio-inline">
                            <input class="form-check-input" type="radio" id="event" name="type" value="2" <?php if(isset($courseTyper) && ($courseTyper === '2')) {echo 'checked="checked"';} else if ($course['course_type'] === '2') {echo 'checked="checked"';} ?>>
                            <?php echo lang('event'); ?>
                        </label>
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
        <div class="">
            <?php
                if (isset($employee_message) && !empty($employee_message)) {
                    echo '       
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close"><i class="fas fa-times"></i></button>
                            <strong><i class="fas fa-check"></i> '.$employee_message.'</strong>
                        </div>';
                }
            ?>
        </div>
        <div class="add">
            <button type="button" class="btn btn-warning" style="color:#ffffff;" data-toggle="modal" data-target="#uploadEmployeeFileModal"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button>
            <button type="button" class="btn btn-success" style="color:#ffffff;" data-toggle="modal" data-target="#addEmployeeModal" ><i class="fas fa-plus"></i> <?php echo lang('add'); ?></button>
        </div>
        <table id="employeeTable" class="table table-bordered display compact" width="100%">
            <thead>
                <tr>
                    <th class="title"><?php echo lang('employee_id'); ?></th>
                    <th class="title"><?php echo lang('image'); ?></th>
                    <th class="title"><?php echo lang('fullname'); ?></th>
                    <th class="title"><?php echo lang('birthday'); ?></th>
                    <th class="title"><?php echo lang('gender'); ?></th>
                    <th class="title"><?php echo lang('address'); ?></th>
                    <th class="title"><?php echo lang('email'); ?></th>
                    <th class="title"><?php echo lang('mobile'); ?></th>
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
                <form role="form" action="<?php echo $this->uri->segment('3'); ?>" method="post" onsubmit="return validateEmployee()">
                    <div class="modal-header"  style="text-align: center;">
                        <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                        <h4 class="modal-title"><?php echo lang('add_employee') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-sm-9">
                                    <div  class="form-group">
                                        <label for="image"><?php echo lang('image_1'); ?>:</label>
                                        <div id="image">
                                            <img src="<?php echo base_url('images/user-2.png'); ?>" class="img-responsive" id="avatar-image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group">
                                        <label for="employeeId_"><?php echo lang('employee_id_1'); ?><sup style="color: red;">*</sup>:</label>
                                        <input type="text" class="flexdatalist form-control" id="employeeId_" name="employeeId_" value="" data-data='<?php echo base_url('Courses/getProfileData') ?>' data-search-in='employeeId' data-min-length='0'>
                                        <span class="error-message">Error message</span>
                                        <?php
                                            if (isset($profileId) && !empty($profileId)) {
                                                echo '<div style="color:red">'.$profileId.'</div>';
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthday_"><?php echo lang('birthday_1'); ?>: </label>
                                        <input type="date" class="form-control" id="birthday_" name="birthday_" value="" style="cursor: pointer;">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('gender_1'); ?>:</label>     
                                        <div class="">
                                            <label class="radio-inline" for="male">
                                                <input class="form-check-input" type="radio" name="gender_" id="male_" value="1">
                                                <?php echo lang('male'); ?>
                                            </label>
                                            <label class="radio-inline" for="female">
                                                <input class="form-check-input" type="radio" name="gender_" id="female_" value="2">
                                                <?php echo lang('female'); ?>
                                            </label>
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
                                    <input type="hidden" class="form-control" id="courseName_" name="courseName_" value="<?php echo $course['name']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="color:#ffffff" id="save"><i class="far fa-save"></i> <?php echo lang('save'); ?></button>
                        <button type="button" class="btn btn-danger" style="color:#ffffff" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('cancle'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Upload Employee file -->
    <div id="uploadEmployeeFileModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="text-align: center;">
                        <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                        <h4 class="modal-title"><?php echo lang('upload_employee_list') ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="file-upload-employee-list" class="col-sm-2 control-label"><?php echo $this->lang->line('excel_file'); ?><sup style="color: red;">*</sup></label>
                                <div class="col-sm-9">
                                    <div class="input-group file">
                                        <input id="file-upload-employee-list" type="text" class="form-control" name="file-upload-employee-list" placeholder="<?php echo $this->lang->line('file_name'); ?>" readonly>
                                        <span id="choose-file-employee-list" class="btn btn-primary input-group-addon" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"><?php echo $this->lang->line('choose_file'); ?></span>
                                    </div>
                                    <input type="file" id="file-upload-employee-list-hidden" name="file-upload-employee-list-hidden" style="display:none" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" style="color:#ffffff;"><i class="fas fa-upload"></i> <?php echo lang('upload'); ?></button>
                        <button type="button" class="btn btn-danger" style="color:#ffffff;" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('cancle'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete user successfully -->
    <div id="deleteSuccessModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" href="<?php echo current_url(); ?>"><i class="fas fa-times"></i></a>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title" id="delete-message"></h4>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" style="color:#ffffff" href="<?php echo current_url(); ?>"><i class="fas fa-check"></i> <?php echo lang('confirm') ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- The delete modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title" id="confirm-delete-title"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" style="color:#ffffff" id="confirm-delete" onclick="deleteOnclick()"><i class="fas fa-check"></i> <?php echo lang('yes'); ?></button>
                    <button type="button" class="btn btn-danger" style="color:#ffffff" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('no'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
           
<script>
    $(function () {
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

        // Show avatar and add file name to input box
        $('#file-upload-employee-list').css('cursor', 'pointer');
        $("#choose-file-employee-list, #file-upload-employee-list").on("click", function() {
            $("#file-upload-employee-list-hidden").trigger("click");
        });
        $("#file-upload-employee-list-hidden").change(function() {
            if(this.value.length > 0){
                var pathFile = this.value.replace(/^.*[\\\/]/, '');
                $("#file-upload-employee-list").val(pathFile);
            }
            
        });

        // Get data for Course list datatable serverside
        var lang = '<?php echo $this->session->userdata('site_lang'); ?>';
        console.log(lang);
        if (lang == 'vietnamese') {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json';
        } else {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
        }
        $('#employeeTable').DataTable({
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
                    data: "birthday",
                    className: "dt-center",
                },
                {
                    data: "gender",
                    className: "dt-center",
                },
                {
                    data: "address",
                    className: "dt-head-center",
                },
                {
                    data: "email",
                    className: "dt-head-center",
                },
                {
                    data: "mobile",
                    className: "dt-center",
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

        // Show error when add duplicate Employee to Course Detail
        var errorMessage = '<?php
                                if (isset($profileId) && !empty($profileId)) {
                                    echo $profileId;
                                } else {
                                    echo '';
                                }
                            ?>';
        if (errorMessage != '') {
            $('#addEmployeeModal').modal('show');
        }
        
        // Aotucomplete Employee ID when click Add button
        $('#employeeId_').flexdatalist({
            minLength: 0,
            searchIn: 'employeeId',
            data: '<?php echo base_url('Courses/getProfileData') ?>',
        }).on('select:flexdatalist', function(event, data) {
            // console.log(data);
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

        $('#employeeId_').on('change', function() {
            // console.log($('#employeeId_').val());
            if ($('#employeeId_').val() == '') {
                $('#avatar-image').attr('src', '<?php echo base_url('images/user-2.png'); ?>');
                $('#birthday_').val('');
                $('#fullname_').val('');
                $('#mobile_').val('');
                $('#email_').val('');
                $('#address_').val('');
                $('#male_').removeAttr('checked');
                $('#female_').removeAttr('checked');
                $('#profileId_').val('');
            }
        });

        // Show delete modal
        $('#deleteModal').on('show.bs.modal', function (e) {
            const rowData = e.relatedTarget;
            // console.log(rowData);
            $('#confirm-delete').attr({'name': rowData.profileId, 'value': rowData.courseId});
            $('#confirm-delete-title').html('<?php echo lang('DELETE002'); ?> '+ rowData.name +'?');
        })

        // When click Yes in delete modal
        function deleteOnclick() {
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
                success: function(result) {
                    $('#deleteModal').modal('hide');
                    $('#deleteSuccessModal').modal('show', result.message);
                },
            });
        }

        // Show if delete user successfully
        $('#deleteSuccessModal').on('show.bs.modal', function (e) {
            console.log(e.relatedTarget);
            $('#delete-message').html(e.relatedTarget);
        })
    });

    // Initialize variable to validate
    const nameEle = document.getElementById('name');
    const employeeIdEle = document.getElementById('employeeId_');

    // Validate when user click "Save" button in Course information and have some error
    function validateCourse() {
        let name = validateName();
        if (!name) {
            return false;
        }
        return true;
    };

    // Validate when user click "Add" button in Employee list and have some error
    function validateEmployee() {
        let employeeId = validateEmployeeId();
        if (!employeeId) {
            return false;
        }
        return true;
    };

    // Validate Employee ID
    function validateEmployeeId()
    {
        let parentEle = employeeIdEle.parentNode;
        parentEle.classList.remove('success', 'error');
        return checkEmployeeId();
    }

    function checkEmployeeId()
    {
        let employeeIdValue = employeeIdEle.value;
        let isCheck = true;

        if (employeeIdValue == '') {
            setError(employeeIdEle, '<?php echo lang('EMPLOYEEID005'); ?>');
            isCheck = false;
        } else {
            setSuccess(employeeIdEle);
        }

        return isCheck;
    }

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