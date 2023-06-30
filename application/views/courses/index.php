<style>
    .courses {
        margin-left: 30px;
        margin-right: 30px;
    }
    .table-container {
        border: #f1f1f1f1 2px solid;
        border-radius: 20px;
        margin-top: 30px;
        padding: 20px;
    }
    .add {
        float: right;
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
    @media (min-width: 769px) {
        #btn {
            margin-top: -50px;
            float: right;
            width: 10%;
        }
    }
</style>

<div class="courses">
    <!-- Search input -->
    <div class="search">
        <form class="form-horizontal form-label-left" role="form" action="" method="get">
            <div class="form-group">
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="name"><?php echo lang('course_name_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="name" name="name" value="<?php if ($this->input->get('name')) echo $this->input->get('name'); ?>">
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="startDate"><?php echo lang('start_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="startDate" name="startDate" style="cursor: pointer;" value="<?php if ($this->input->get('startDate')) echo $this->input->get('startDate'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="time"><?php echo lang('time_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="input-group date" id="timePicker">
                            <input type="text" class="form-control timePicker" id="time" name="time" value="<?php if ($this->input->get('time')) echo $this->input->get('time'); ?>">
                            <span class="input-group-addon"><i class="far fa-clock"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="endDate"><?php echo lang('end_date_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="date" class="form-control" id="endDate" name="endDate" style="cursor: pointer;" value="<?php if ($this->input->get('endDate')) echo $this->input->get('endDate'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="weekDay"><?php echo lang('week_days_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="mon" name="mon" value="2" <?php if ($this->input->get('mon')) echo 'checked=checked'; ?>>
                            <label for="mon">2</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="tue" name="tue" value="3" <?php if ($this->input->get('tue')) echo 'checked=checked'; ?>>
                            <label for="tue">3</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="wed" name="wed" value="4" <?php if ($this->input->get('wed')) echo 'checked=checked'; ?>>
                            <label for="wed">4</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="thu" name="thu" value="5" <?php if ($this->input->get('thu')) echo 'checked=checked'; ?>>
                            <label for="thu">5</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="fri" name="fri" value="6" <?php if ($this->input->get('fri')) echo 'checked=checked'; ?>>
                            <label for="fri">6</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="sta" name="sta" value="7" <?php if ($this->input->get('sta')) echo 'checked=checked'; ?>>
                            <label for="sta">7</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="sun" name="sun" value="8" <?php if ($this->input->get('sun')) echo 'checked=checked'; ?>>
                            <label for="sun">8</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6"><?php echo lang('course_type_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="course" name="course" value="1" <?php if ($this->input->get('course')) echo 'checked=checked'; ?>>
                            <label for="course"><?php echo lang('course_1'); ?></label>
                        </div>
                        <div class="checkbox checkbox-inline">
                            <input type="checkbox" id="event" name="event" value="2" <?php if ($this->input->get('event')) echo 'checked=checked'; ?>>
                            <label for="event"><?php echo lang('event'); ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-sm-12 col-xs-9">
                    <div id="btn" class="col-md-12 col-sm-12 col-xs-7" style="text-align: right;">
                        <button type="submit" id="search" class="btn btn-info" style="margin-right: 0;"><i class="fa fa-search"></i> <?php echo lang('search'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Datatable serverside -->
    <div class="table-container">
        <h3><?php echo lang('courses'); ?></h3>
        <div class="add">
            <a href="Courses/add" class="btn btn-primary" style="color:#ffffff;"><i class="fas fa-plus"></i> <?php echo lang('courses_1'); ?></a>
        </div>
        <table id="courseTable" class="table table-bordered display compact" width="100%">
            <thead>
                <tr>
                    <th class="title"><?php echo lang('course_name'); ?></th>
                    <th class="title"><?php echo lang('course_type'); ?></th>
                    <th class="title"><?php echo lang('time'); ?></th>
                    <th class="title"><?php echo lang('week_days'); ?></th>
                    <th class="title"><?php echo lang('start_date'); ?></th>
                    <th class="title"><?php echo lang('end_date'); ?></th>
                    <th class="title"><?php echo lang('action') ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
    $(function () {
        // Custom time input
        $('#timePicker').datetimepicker({
            useCurrent: false,
            format: "HH:mm",
        });

        // Get data for Course list datatable serverside
        var weekDay = '';
        var course = '';
        var event = '';
        var mon = '';
        var tue = '';
        var wed = '';
        var thu = '';
        var fri = '';
        var sta = '';
        var sun = '';

        if ($('#mon').is(":checked")) {
            var mon = $('#mon').val();
            weekDay = weekDay + mon;
        }
        if ($('#tue').is(":checked")) {
            var tue = $('#tue').val();
            if (mon != '') {
                weekDay = weekDay + ', ' + tue;
            } else {
                weekDay = weekDay + tue;
            }
        }
        if ($('#wed').is(":checked")) {
            var wed = $('#wed').val();
            if ((mon != '') | (tue != '')) {
                weekDay = weekDay + ', ' + wed;
            } else {
                weekDay = weekDay + wed;
            }
        }
        if ($('#thu').is(":checked")) {
            var thu = $('#thu').val();
            if ((mon != '') || (tue != '') || (wed != '')) {
                weekDay = weekDay + ', ' + thu;
            } else {
                weekDay = weekDay + thu;
            }
        }
        if ($('#fri').is(":checked")) {
            var fri = $('#fri').val();
            if ((mon != '') || (tue != '') || (wed != '') || (thu != '')) {
                weekDay = weekDay + ', ' + fri;
            } else {
                weekDay = weekDay + fri;
            }
        }
        if ($('#sta').is(":checked")) {
            var sta = $('#sta').val();
            if ((mon != '') || (tue != '') || (wed != '') || (thu != '') || (fri != '')) {
                weekDay = weekDay + ', ' + sta;
            } else {
                weekDay = weekDay + sta;
            }
        }
        if ($('#sun').is(":checked")) {
            var sub = $('#sun').val();
            if ((mon != '') || (tue != '') || (wed != '') || (thu != '') || (fri != '') || (sta != '')) {
                weekDay = weekDay + ', ' + sun;
            } else {
                weekDay = weekDay + sun;
            }
        }
        
        if ($('#course').is(":checked")) {
            var course = $('#course').val();
        }
        if ($('#event').is(":checked")) {
            var event = $('#event').val();
        }

        var lang = '<?php echo $this->session->userdata('site_lang'); ?>';
        console.log(lang);
        if (lang == 'vietnamese') {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json';
        } else {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
        }
        $('#courseTable').DataTable({
            fixedHeader: true,
            scrollCollapse: true,
            scrollY: "700px",
            scrollX: "100%", 
            language: {
                url: languageUrl,
            },
            formatNumber: function ( toFormat ) {
                return toFormat.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "'");
            },
            responsive: true,
            stateSave: true,
            stateDuration: 0,
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo base_url('Courses/filterCourseData') ?>", 
                dataType: 'json',
                type: 'POST',
                data: {
                    // Truyền dữ liệu search vào đây
                    name: String($('#name').val()),
                    weekDay: weekDay,
                    time: $('#time').val(),
                    startDate: $('#startDate').val(),
                    endDate: $('#endDate').val(),
                    course: String(course),
                    event: String(event),
                },
            },
            columns: [
                { 
                    data: "name",
                    className: "dt-head-center",
                },
                {
                    data: "type",
                    className: "dt-head-center",
                },
                {
                    data: "time",
                    className: "dt-center",
                },
                {
                    data: "weekDay",
                    className: "dt-center",
                },
                {
                    data: "startDate",
                    className: "dt-center",
                },
                {
                    data: "endDate",
                    className: "dt-center",
                },
                {
                    data: "id",
                    className: "button-group dt-head-center",
                    render: function (data, type, row, meta) {
                        var edit = '<a class="btn btn-primary" href="<?php echo base_url('Courses/edit/'); ?>'+ data +'" data-toggle="tooltip" data-placement="right" title="<?php echo lang('edit'); ?>" style="color:#ffffff; margin-right:5px" id="edit"><span class="glyphicon glyphicon-edit"></span></a>';
                        var del = '<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="<?php echo lang('delete'); ?>"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $('<div></div>')
                            .append(edit)
                            .append(del)
                            .prop('outerHTML');
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
            $('#confirm-delete').attr({'name': rowData.name, 'value': rowData.id});
            $('#confirm-delete-title').html('<?php echo lang('DELETE003'); ?> '+ rowData.name +'?');
            
        })

        // When click Yes in delete modal
        $('#confirm-delete').on('click', function() {
            var name = $('#confirm-delete').attr('name');
            var id = $('#confirm-delete').attr('value');
            $.ajax({
                url:"<?php echo base_url("Courses/deleteCourse") ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    name: name,
                },
                success: function(response) {
                    location.reload();
                },
            });
        });
    });
</script>