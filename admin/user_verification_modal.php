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
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Username</span>
                                    </div>
                                    <input type="text" class="form-control" id = "username" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">First Name</span>
                                    </div>
                                    <input type="text" class="form-control" id = "fname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Middle Name</span>
                                    </div>
                                    <input type="text" class="form-control" id = "mname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Last Name</span>
                                    </div>
                                    <input type="text" class="form-control" id = "lname" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Gender</span>
                                    </div>
                                    <input type="text" class="form-control" id = "gender" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Birth Date</span>
                                    </div>
                                    <input type="text" class="form-control" id = "bday" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Barangay</span>
                                    </div>
                                    <input type="text" class="form-control" id = "username" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Contact No.</span>
                                    </div>
                                    <input type="text" class="form-control" id = "contacts" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>

                            </div>
                            <div class ="col-6">
                            <img src="..." class="img-fluid" id = "userimage" alt="Responsive image">      
                            <img src="..." class="img-fluid" id = "userverification" alt="Responsive image">      
                            
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
                    <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
                    <input type="submit" name="delete_pum" class="btn btn-danger" value="Yes">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>