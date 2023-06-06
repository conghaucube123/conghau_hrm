<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User list</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        
        <script src="https://cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json"></script>
        <script src="//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json"></script>
        <style>
            .clearfix::after {
                clear: both;
            }
            .body-container {
                margin-bottom: 50px;
                width: 100%;
            }
            .left {
                float: left;
                width: 20%;
            }
            .right {
                float: right;
                margin-top: 8.2%;
                margin-right: 100px;
                width: 70%;
            }

            .search {
                border: solid black 2px;
                margin-top: 50px;
            }
            .table-container {
                margin-top: 50px;
            }
            .add {
                float: right;
            }
            .dataTables_filter { 
                display: none;
            }
        </style>
    </head>
    <body>
        <header>
            <?php
                $this->load->view($header);
            ?>
        </header>

        <div class="body-container">
            <div class="left">
                <?php
                    $this->load->view($sidebar);
                ?>
            </div>
            
            <div class="right">
                <div class="search">
                    <form class="form-horizontal" role="form" style="margin:50px" action="" method="get">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="employeeId"><?php echo lang('employee_id'); ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="employeeId" name="employeeId" value="<?php if ($this->input->get('employeeId')) echo $this->input->get('employeeId'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name"><?php echo lang('name'); ?></label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="name" name="name" value="<?php if ($this->input->get('name')) echo $this->input->get('name'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email"><?php echo lang('email'); ?></label>
                            <div class="col-sm-10">          
                                <input type="text" class="form-control" id="email" name="email" value="<?php if ($this->input->get('email')) echo $this->input->get('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group">   
                            <label class="control-label col-sm-2"><?php echo lang('status'); ?></label>     
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="available" name="available" value="1" <?php if ($this->input->get('available')) echo 'checked=checked'; ?>><?php echo lang('ava'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="unavailable" name="unavailable" value="2" <?php if ($this->input->get('unavailable')) echo 'checked=checked'; ?>><?php echo lang('unava'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-success" style="color:#ffffff" value="<?php echo lang('search'); ?>" name="search-submit">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-container">
                    <div class="add">
                        <a href="create" class="btn btn-success" style="color:#ffffff"><?php echo lang('register'); ?></a>
                    </div>
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th><?php echo lang('login_id'); ?></th>
                                <th><?php echo lang('gender'); ?></th>
                                <th><?php echo lang('fullname'); ?></th>
                                <th><?php echo lang('mail_address'); ?></th>
                                <th><?php echo lang('employ_id'); ?></th>
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('sta') ?></th>
                                <th><?php echo lang('action') ?></th>
                                <th></th>
                            </tr>
                            </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <?php
                        if (isset($message) && !empty($message)) {
                            echo '
                                <div class="form-group" id="message">        
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>'.$message.'</strong>
                                        </div>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>
                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                Modal body..
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <footer>
            <?php $this->load->view($footer); ?>
        </footer>

        <script>
            $( function () {
                if ($("#available").is(":checked")) {
                    var available = $("#available").val();
                } else {
                    var available = '';
                }
                if ($("#unavailable").is(":checked")) {
                    var unavailable = $("#unavailable").val();
                } else {
                    var unavailable = '';
                }
                var lang = getCookie('language');
                if (lang == 'vietnamese') {
                    var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/vi.json';
                } else {
                    var languageUrl = '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json';
                }
                $('#myTable').DataTable({
                    responsive: true,
                    stateSave: true,
                    proccessing: true,
                    serverSide: true,
                    ajax: {
                        url: "http://localhost/conghau_hrm/User_list/filterData", 
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            // Truyền dữ liệu search vào đây
                            employeeId: String($("#employeeId").val()),
                            name: String($("#name").val()),
                            email: String($("#email").val()),
                            available: String(available),
                            unavailable: String(unavailable),
                        },
                    },
                    columns: [
                        { data: "loginId" },
                        { data: "gender" },
                        { data: "fullname" },
                        { data: "email" },
                        { data: "employeeId" },
                        { data: "image", orderable: false, },
                        { data: "status", },
                        {
                            data: "id",
                            render: function (data, type, row, meta) {
                                return '<a class="btn btn-success" href="<?php echo base_url('User_list/edit/'); ?>'+data+'" style="color:#ffffff" id="edit"><?php echo lang('edit'); ?></a>';
                            },
                            orderable: false,
                        },
                        {
                            data: "id",
                            render: function (data, type, row, meta) {
                                // return '<a class="btn btn-danger" href="<?php echo base_url('User_list/delete/'); ?>'+data+'" style="color:#ffffff"><?php echo lang('delete'); ?></a>';
                                return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open modal</button>';
                            },
                            orderable: false,
                        },
                    ],
                    language: {
                        url: languageUrl,
                    },
                    scrollY: 550,
                });
            });

            function getCookie(cname)
            {
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
        </script>
    </body>
</html>