<div class="tab-pane fade show active" id="nav-tracer" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label>Date Registered: </label>
            <div class="input-group date" data-provide="datepicker">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" style="width: 90%;" readonly id="datepicker" name="date_register" placeholder="Date Process" value="<?php echo $now->format('Y-m-d'); ?>">
            </div>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <div class="col-md-2">
            <label> Time Registered:</label>


            <input readonly type="text" class="form-control" name="time" id="time" placeholder="Time Registered" value="<?php echo $time; ?>" required>
        </div>




    </div><br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label>Name of Investigator: &nbsp;&nbsp; <span id="required">*</span> </label>
            <input type="text" class="form-control" name="contact_entity" style=" text-transform: uppercase;" id="contact_entity" placeholder="Investigator's ID" value="<?php echo $db_entity ?>" required><br>
            <input type="text" class="form-control" name="contact_tracer" style=" text-transform: uppercase;" id="contact_tracer" placeholder="Investigator's Name" value="<?php echo $db_fullname ?>" required>
            <span id="asstdname"> &nbsp;&nbsp;<i>Name of Contact Tracer</i></span>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-md-3">
            <label for="">Name of Brgy Contact Tracer: &nbsp;&nbsp; <span id="required">*</span></label>
            <input type="text" class="form-control" name="brgy_contacttracer" style=" text-transform: uppercase;" id="brgy_contacttracer" placeholder="Name of Brgy Contact Tracer" value="" required>
            <span id="asstdname"> &nbsp; &nbsp;<i>Please put NONE if no Brgy CT assisted</i></span>
        </div>




    </div>


</div>