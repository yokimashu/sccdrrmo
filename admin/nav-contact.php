<div class="tab-pane fade show" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="row">

        <div class="col-md-1"> </div>
        <div class="col-md-5">
            <label for="">Transaction Code: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" id="transaction_code" name="transaction_code" placeholder="Transaction Code" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-5">
            <label for="">Close Contact?: &nbsp;&nbsp; <span id="required">*</span></label>
            <select class=" form-control select2" style="width: 100%;" id="close_contact" name="close_contact" value="" required>

                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <label>If YES, who is the Index Case: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" id="entity1" style="width: 100%;" name="entity_no" value="<?php echo $entity_no; ?>">
                <option>Please select...</option>

            </select>
        </div>



    </div><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <input type="text" readonly class="form-control" id="entity_no1" name="index_id" placeholder="index_id">
        </div>

        <div class="col-md-3">
            <input type="text" readonly class="form-control" id="fullname1" name="index_name" placeholder="patient_fullname">

        </div>

    </div>



</div>