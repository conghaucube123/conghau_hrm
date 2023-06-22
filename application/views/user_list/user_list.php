<style>
    .list {
        margin-left: 50px;
        margin-right: 50px;
    }
    .table-container {
        border: #f1f1f1f1 3px solid;
        border-radius: 10px;
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
    .col-md-2 img {
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
<div class="list">
    <!-- Search input -->
    <div class="search">
        <form class="form-horizontal form-label-left" role="form" action="" method="get">
            <div class="form-group">
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="employeeId"><?php echo lang('employee_id_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?php if ($this->input->get('employeeId')) echo $this->input->get('employeeId'); ?>">
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="name"><?php echo lang('name'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="name" name="name" value="<?php if ($this->input->get('name')) echo $this->input->get('name'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6" for="email"><?php echo lang('email_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <input type="text" class="form-control" id="email" name="email" value="<?php if ($this->input->get('email')) echo $this->input->get('email'); ?>">
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-6">
                    <label class="control-label col-md-4 col-sm-5 col-xs-6"><?php echo lang('status_1'); ?></label>
                    <div class="col-md-8 col-sm-7 col-xs-7">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="available" name="available" value="1" <?php if ($this->input->get('available')) echo 'checked=checked'; ?>>
                            <?php echo lang('available'); ?>
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="unavailable" name="unavailable" value="2" <?php if ($this->input->get('unavailable')) echo 'checked=checked'; ?>>
                            <?php echo lang('unavailable'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-sm-12 col-xs-9">
                    <div class="col-md-12 col-sm-12 col-xs-7" style="text-align: right;" id="btn">
                        <button type="submit" id="search" class="btn btn-info" style="margin-right: 0;"><i class="fa fa-search"></i> <?php echo lang('search'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- User list datatable serverside -->
    <div class="table-container">
        <h3><?php echo lang('user_list'); ?></h3>
        <div class="add">
            <a href="add" class="btn btn-success" style="color:#ffffff;"><i class="fas fa-plus"></i> <?php echo lang('register'); ?></a>
        </div>
        <table id="userTable" class="table table-bordered display compact" width="100%">
            <thead>
                <tr>
                    <th class="title"><?php echo lang('employee_id'); ?></th>
                    <th class="title"><?php echo lang('login_id'); ?></th>
                    <th class="title"><?php echo lang('image'); ?></th>
                    <th class="title"><?php echo lang('fullname'); ?></th>
                    <th class="title"><?php echo lang('gender'); ?></th>
                    <th class="title"><?php echo lang('email'); ?></th>
                    <th class="title"><?php echo lang('status') ?></th>
                    <th class="title"><?php echo lang('action') ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <!-- The user info modal -->
    <div id="infoModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"  style="text-align: center;">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <h4 class="modal-title"><?php echo lang('user_info') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            <div class="row">
                                <div class="col-md-2 col-sm-9">
                                    <div  class="form-group">
                                        <label for="image"><?php echo lang('image_1'); ?>:</label>
                                        <div id="image">
                                            <img src="" class="img-responsive" id="avatar-image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-9">
                                    <div  class="form-group">
                                        <label><?php echo lang('login_id_1'); ?>: </label>
                                        <span id="loginId_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('fullname_1'); ?>: </label>
                                        <span id="fullname_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('gender_1'); ?>: </label>
                                        <span id="gender_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('birthday_1'); ?>: </label>
                                        <span id="birthday_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('mobile_1'); ?>: </label>
                                        <span id="mobile_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('email_1'); ?>: </label>
                                        <span id="email_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('recent_login'); ?>: </label>
                                        <span id="recentLogin_"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-9">
                                    <div class="form-group">
                                        <label><?php echo lang('employee_id_1'); ?>: </label>
                                        <span id="employeeId_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('contract_type'); ?>: </label>
                                        <span id="contractType_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('position'); ?>: </label>
                                        <span id="position_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('department'); ?>: </label>
                                        <span id="department_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('status_1'); ?>: </label>
                                        <span id="status_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('created_time'); ?>: </label>
                                        <span id="createdTime_"></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('created_user'); ?>: </label>
                                        <span id="createdUser_"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="user_info_modal_btn" class="btn btn-success" style="color:#ffffff" data-dismiss="modal"><i class="fas fa-times"></i> <?php echo lang('close'); ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete user successfully -->
    <div id="deleteSuccessModal" class="modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" href="<?php echo base_url('User_list/list'); ?>"><i class="fas fa-times"></i></a>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4 class="modal-title" id="delete-message"></h4>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" style="color:#ffffff" href="<?php echo base_url('User_list/list'); ?>"><?php echo lang('confirm') ?></a>
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
    $( function () {
        // Get data for User list datatable serverside
        if ($('#available').is(":checked")) {
            var available = $('#available').val();
        } else {
            var available = '';
        }
        if ($('#unavailable').is(":checked")) {
            var unavailable = $('#unavailable').val();
        } else {
            var unavailable = '';
        }
        var lang = '<?php echo $this->session->userdata('site_lang'); ?>';
        console.log(lang);
        if (lang == 'vietnamese') {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json';
        } else {
            var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
        }
        $('#userTable').DataTable({
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
                url: "<?php echo base_url('User_list/filterUserListData') ?>", 
                dataType: 'json',
                type: 'POST',
                data: {
                    // Truyền dữ liệu search vào đây
                    employeeId: String($('#employeeId').val()),
                    name: String($('#name').val()),
                    email: String($('#email').val()),
                    available: String(available),
                    unavailable: String(unavailable),
                },
            },
            columns: [
                { 
                    data: "employeeId",
                    className: "dt-head-center",
                    render: function (data, type, row, meta) {
                        return '<a style="cursor: pointer;">'+data+'</a>';
                    },
                    createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
                        $(cell).find('a').click(function (e) {
                            $('#infoModal').modal('show', rowData);
                        });
                    },
                },
                {
                    data: "loginId",
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
                        return '';
                    },
                    orderable: false,
                },
                {
                    data: "fullname",
                    className: "dt-head-center",
                },
                {
                    data: "gender",
                    className: "dt-center",
                },
                {
                    data: "email",
                    className: "dt-head-center",
                },
                {
                    data: "status",
                    className: "dt-head-center",
                },
                {
                    data: "id",
                    className: "button-group dt-head-center",
                    render: function (data, type, row, meta) {
                        var edit = '<a class="btn btn-primary" href="<?php echo base_url('User_list/edit/'); ?>'+ data +'" data-toggle="tooltip" data-placement="right" title="<?php echo lang('edit'); ?>" style="color:#ffffff; margin-right:5px" id="edit"><span class="glyphicon glyphicon-edit"></span></a>';
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

        // Show user information modal when click Employee ID
        $('#infoModal').on('show.bs.modal', function (e) {
            const rowData = e.relatedTarget;
            console.log(rowData);
            var url = '';
            if ((rowData.image != null) && (rowData.image != '')) {
                url = '<?php echo base_url('public/images/'); ?>' + rowData.image;
            } else {
                url = '<?php echo base_url('images/user-2.png'); ?>';
            }
            $('#avatar-image').attr('src', url);
            $('#loginId_').html(rowData.loginId);
            $('#fullname_').html(rowData.fullname);
            $('#gender_').html(rowData.gender);
            $('#birthday_').html(rowData.birthday);
            $('#mobile_').html(rowData.mobile);
            $('#email_').html(rowData.email);
            $('#recentLogin_').html(rowData.recentLogin.slice(0, 19));
            $('#employeeId_').html(rowData.employeeId);
            $('#contractType_').html(rowData.contractType)
            $('#position_').html(rowData.position)
            $('#department_').html(rowData.department)
            $('#status_').html(rowData.status)
            $('#createdTime_').html(rowData.createdTime.slice(0, 19));
            $('#createdUser_').html(rowData.createdUser);
        })

        // Show delete modal
        $('#deleteModal').on('show.bs.modal', function (e) {
            const rowData = e.relatedTarget;
            $('#confirm-delete').attr({'name': rowData.id, 'value': rowData.loginId});
            $('#confirm-delete-title').html('<?php echo lang('DELETE001'); ?> '+ rowData.loginId +'?');
        })

        // When click Yes in delete modal
        function deleteOnclick() {
            var id = $('#confirm-delete').attr('name');
            var loginId = $('#confirm-delete').attr('value');
            $.ajax({
                url:"<?php echo base_url("User_list/delete") ?>",
                dataType: 'json',
                type: 'POST',
                data: {
                    id: id,
                    login_id: loginId,
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
</script>