<div class="modal fade  bd-example-modal-lg" id="verify_modal" role="dialog" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verify User</h4>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                        <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
                            <div class="col-6">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Entity No:</span>
                                    </div>
                                    <input type="text" class="form-control" name = "entityno" readonly id = "entityno" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Username:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "username" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">First Name:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "fname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Middle Name:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "mname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Last Name:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "lname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Gender:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "gender" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Birth Date:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "bday" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Barangay:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "brgy" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Contact No.:</span>
                                    </div>
                                    <input type="text" class="form-control" readonly id = "contacts" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                                <input type = "text" hidden id = "photolink" name = "photolink">

                            </div>
                            <div class ="col-6">
                            <img src="..." class="img-fluid rounded image" id = "userimage" alt="Responsive image">      
                            <img src="..." class="img-fluid rounded image" id = "userverification" alt="Responsive image">      
                            
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">

                    <input type="submit"  id = "deny" name = "deny" class="btn btn-danger pull-left bg-olive" value = "DENY">
                    <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
                    <input type="submit"  id = "approve" name="approve" class="btn btn-primary"  value="APPROVE">
                    <input type="button" class="btn btn-default" dadata-dismiss="modal" data-dismiss="modal" value="CANCEL">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<style>
.image{
margin-left:50px;
margin-right:60px;
height: 300px;
width:300px;
}
</style>