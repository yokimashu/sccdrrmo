<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <!-- //PRINT 2 -->
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <label> Select Individual: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" id="entity2" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                <option>Please select...</option>

            </select>


        </div>

    </div><br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label for="">Entity ID: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" readonly class="form-control" id="entity_no7" name="patient_id" placeholder="entity_no" required>
        </div>
        <div class="col-md-3">
            <label for="">Patient #: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" readonly name="patient_no" id="patient_no" placeholder="Patient #" value="" required>
        </div>


    </div><br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label for="">First Name: &nbsp;&nbsp; <span id="required">*</span></label>
            <input hidden type="text" class="form-control" name="patient_fullname" id="fullname" style=" text-transform: uppercase;" placeholder="First Name" value="" required>
            <input type="text" class="form-control" name="firstname" id="firstname" style=" text-transform: uppercase;" placeholder="First Name" value="" required>
        </div>
        <div class="col-md-3">
            <label for="">Middle Initial: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="middlename" id="middlename" style="text-transform: uppercase;" placeholder="Middle Initial" value="" required>
        </div>

        <div class="col-md-3">
            <label for="">Last Name: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="lastname" id="lastname" style="text-transform: uppercase;" placeholder="Last Name" value="" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label for="">Street: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="street" id="street" style=" text-transform: uppercase;" placeholder="Street" value="" required>
        </div>

        <div class="col-md-3">
            <label for="">Barangay: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="barangay" id="barangay" style="text-transform: uppercase;" placeholder="Barangay" value="" required>
        </div>

        <div class="col-md-3">
            <label for="">Mobile Number: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="mobile_no" id="mobile_no" style="text-transform: uppercase;" placeholder="Mobile Number" value="" required>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label> OTHER INFO: </label></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <label for="">PHILHEALTH Number: &nbsp;&nbsp; </label>
            <input type="text" class="form-control" name="phil_no" id="phil_no" style=" text-transform: uppercase;" placeholder="Philhealth Number" value="N/A">
        </div>

    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <label for="">Occupation: &nbsp;&nbsp; </label>
            <input type="text" class="form-control" name="occupation" id="occupation" style=" text-transform: uppercase;" placeholder="Occupation" value="N/A">
        </div>

    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <label for="">Place of work: &nbsp;&nbsp; </label>
            <input type="text" class="form-control" name="placeofwork" id="placeofwork" style=" text-transform: uppercase;" placeholder="Place of work" value="N/A">
        </div>

    </div>

</div><br>