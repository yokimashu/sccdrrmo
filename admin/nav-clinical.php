<div class="tab-pane fade" id="nav-clinical" role="tabpanel" aria-labelledby="nav-clinical-tab">
<div class="row">
<div class="col-md-1"></div>
    
        <div class="col-md-2">
            
            <label for="">Disposition at the time of report* </label>
            <select class="form-control select2" style="width: 100%;" id="disposition" name="disposition" value="">
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Unknown">Unknown</option>
            </select>

        </div>

        <div class="col-md-1"> </div>

<div class="col-md-3">
    <label>If Yes:Date of Contact with known COVID-19 Case: </label>
    <input type="date" id="date_case" style="width: 90%;" name="date_case" value="" class="form-control " placeholder="dd/mm/yyyy" />
</div>
        </div>
        <br>
    <div class="row">
        <div class="col-md-1"> </div>

        <div class="col-md-3">
            <label>Date of Onset of Illness: </label>
            <input type="date" id="date_illness" style="width: 90%;" name="date_illness" value="" class="form-control " placeholder="dd/mm/yyyy" />
        </div>

        <div class="col-md-3">

            <label for="">Do you have a fever?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="fever" name="fever" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3">

            <label for="">Are you experiencing cough?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="cough" name="cough" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>



    </div><br>
    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-3">

            <label for="">Experiencing sore throat?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="sore_throat" name="sore_throat" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Colds or cold-like symptoms?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="cold_symptoms" name="cold_symptoms" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Shortness/difficult of breathing?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="breathing" name="breathing" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

    </div><br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label for="">Experiencing diarrhea/LBM?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="diarrhea" name="diarrhea" value="" required>
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Date of XRAY: </label>
            <input type="date" id="date_xray" style="width: 90%;" name="date_xray" value="" class="form-control " placeholder="dd/mm/yyyy" />
            <span id="asstdname"> &nbsp;&nbsp;<i>If XRAY is done.</i></span>
            </div>
        </div>

        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label>Date of Swab Collection: &nbsp;&nbsp; <span id="required">*</span> </label>
            <input type="date" id="date_swab" name="date_swab" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" required />
        </div>

  
   
        
        <div class="col-md-3">
            <label for="">Reasons for swabbing?: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="reasons_swabbing" name="reason_swabbing" value="" required>
                <option selected>Please select</option>
                <option value="Close Contact">Close Contact</option>
                <option value="Workplace Requirement">Workplace Requirement</option>
                <option value="Pregnancy Requirement">Pregnancy Requirement</option>
                <option value="Symptomatic (WENT TO BACOLOD RESPIRATORY OUTPATIENT CENTER)">Symptomatic (WENT TO BACOLOD RESPIRATORY OUTPATIENT CENTER)</option>
                <option value="Symptomatic (WENT TO A HOSPITAL/PRIVATE MOLECULAR LABORATORY)">Symptomatic (WENT TO A HOSPITAL/PRIVATE MOLECULAR LABORATORY)</option>
            </select>
        </div>
        </div>


        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label for="">Date of Quarantine started: </label>
            <input type="date" id="date_quarantine" name="date_quarantine" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
            <span id="asstdname"> &nbsp;&nbsp;<i>If household is on lockdown</i></span>

        </div>
        <div class="col-md-3">
            <label for="">Quarantine Type: &nbsp;&nbsp; <span id="required">*</span> </label>
            <select class="form-control select2" style="width: 90%;" id="type_quarantine" name="type_quarantine" value="" required>
                <option selected>Please select</option>
                <option value="Health Facility">Health Facility </option>
                <option value="Quarantine Facility">Qurantine Facility</option>
                <option value="Home Quarantine">Home Quarantine</option>
                <option value="Not Applicable">Not Applicable</option>
            </select>
            </div>
      
    <br>

  
   
        <div class="col-md-3">
            <label for="">Address of Quarantine Facility: &nbsp;&nbsp; <span id="required">*</span> </label>
            <input type="text" id="add_quarantine" name="add_quarantine" style=" text-transform: uppercase;" class="form-control" placeholder="Same as address" value="" required>
        </div>
     


    </div><br>
    <br>
    <br>



    <div class="box-footer" align="center">


        <button type="submit" <?php echo $btnSave; ?> name="insert_contactcase" id="btnSubmit" class="btn btn-success">
            <i class="fa fa-check fa-fw"> </i> </button>

        <a href="../plugins/jasperreport/entity_id.php?entity_no=<?php echo $entity_no; ?>">
            <button type="button" name="print" class="btn btn-primary">
                <i class="nav-icon fa fa-print"> </i> </button>
        </a>

        <a href="add_contact_case.php">
            <button type="button" name="cancel" class="btn btn-danger">
                <i class="fa fa-close fa-fw"> </i> </button>
        </a>


    </div><br>
</div>

