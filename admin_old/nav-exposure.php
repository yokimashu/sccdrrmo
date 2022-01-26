<div class="tab-pane fade" id="nav-exposure" role="tabpanel" aria-labelledby="nav-exposure-tab">



    <div class="row">

        <div class="col-md-1"></div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-md-3">
       
            <label for="">History of exposure to known COVID-19 Case 14 days before the onset of sign and symptoms * </label>
            <select class="form-control select2" style="width: 100%;" id="exposure" name="exposure" value="">
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Unknown">Unknown</option>
            </select>

        </div>
        


        <div class="col-md-2"></div>
        <div class="col-md-3">
        <div id="exposure1" hidden>
            <label for="">If Yes: Date of Contact with known COVID-19 Case: </label>
            <input type="date" id="date_exposure" name="date_exposure" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
        </div>
        </div>
    </div><br>
    <div class="row">

        <div class="col-md-1"></div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-md-3">
            
            <label for="">Have you been in a place with a known COVID-19 transmission 14 days before the onset of signs and symptoms * </label>
            <select class="form-control select2" style="width: 100%;" id="transmission" name="transmission_name" value="">
                <option selected>Please select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Unknown">Unknown</option>
            </select>

        </div>

        <div class="col-md-2"></div>
        <div class="col-md-3">
            <div id="sample" hidden>
                <label for="">If Yes: Place you have been to</label>
                <select class="form-control select2" style="width: 100%;" id="transmission1"  name="transmission1" value="">
                    <option selected>Please select</option>
                    <option value="WORK PLACE">WORK PLACE</option>
                    <option value="HEALTH FACILITY">HEALTH FACILITY</option>
                    <option value="RELIGIOUS GATHERING">RELIGIOUS GATHERING</option>
                    <option value="OTHER">OTHER</option>
                </select>

                <div id="OTHER" hidden>
                <input type="text" class="form-control" name="facility_name1" id="name_facility1" style=" text-transform: uppercase;" placeholder="Other" value="">
                <span id="other"> &nbsp;&nbsp;<i>If other</i></span>
            </div>
            </div>

        </div>
        <div class="col-md-0"></div>
        <div class="col-md-2">
            <div id="sample1" hidden>
                <label for="">Date of Visit : </label>
                <input type="date" id="date_visit" name="date_visit" style="width: 90%;" value="" class="form-control " placeholder="dd/mm/yyyy" />
            </div>
        </div>
    </div><br>

    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-5">
            <div id="sample2" hidden>
                <label for=""> Name of Place </label>
                <input type="text" id="name_place" name="name_place" style=" text-transform: uppercase;" class="form-control" placeholder="Name of place" value="">
            </div>

        </div><br>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
            <div id="sample3" hidden>
                <label> LIST THE NAMES OF THE PERSON WHO WHERE WITH YOU DURING THIS(THESE) OCCASION(S) AND THEIR CONTACT NUMBERS &nbsp;&nbsp; <span id="required">*</span> </label>

                <label> PERSON 1 </label>
                <select class="form-control select2" id="person1" style="width: 100%;" name="person1" value=" ">
                    <option>Please select...</option>

                </select>
                <input type="text" class="form-control" id="person_entity1" name="person_entity1" value="">
                <input type="text" class="form-control" id="person_fullname1" name="person_fullname1" value="">
                <input type="text" class="form-control" id="person_street1" name="person_street1" value="">
                <input type="text" class="form-control" id="person_barangay1" name="person_barangay1" value="">
                <input type="text" class="form-control" id="person_mobile1" name="person_mobile1" value="">

                <label> PERSON 2 </label>
                <select class="form-control select2" id="person2" style="width: 100%;" name="person2" value=" ">
                    <option>Please select...</option>

                </select>
                <input type="text" class="form-control" id="person_entity2" name="person_entity2" value="">
                <input type="text" class="form-control" id="person_fullname2" name="person_fullname2" value="">
                <input type="text" class="form-control" id="person_street2" name="person_street2" value="">
                <input type="text" class="form-control" id="person_barangay2" name="person_barangay2" value="">
                <input type="text" class="form-control" id="person_mobile2" name="person_mobile2" value="">

                <label> PERSON 3 </label>
                <select class="form-control select2" id="person3" style="width: 100%;" name="person3" value=" ">
                    <option>Please select...</option>

                </select>
                <input type="text" class="form-control" id="person_entity3" name="person_entity3" value="">
                <input type="text" class="form-control" id="person_fullname3" name="person_fullname3" value="">
                <input type="text" class="form-control" id="person_street3" name="person_street3" value="">
                <input type="text" class="form-control" id="person_barangay3" name="person_barangay3" value="">
                <input type="text" class="form-control" id="person_mobile3" name="person_mobile3" value="">

                <label> PERSON 4 </label>
                <select class="form-control select2" id="person4" style="width: 100%;" name="person4" value=" ">
                    <option>Please select...</option>

                </select>
                <input type="text" class="form-control" id="person_entity4" name="person_entity4" value="">
                <input type="text" class="form-control" id="person_fullname4" name="person_fullname4" value="">
                <input type="text" class="form-control" id="person_street4" name="person_street4" value="">
                <input type="text" class="form-control" id="person_barangay4" name="person_barangay4" value="">
                <input type="text" class="form-control" id="person_mobile4" name="person_mobile4" value="">

                <label> PERSON 5 </label>
                <select class="form-control select2" id="person5" style="width: 100%;" name="person5" value=" ">
                    <option>Please select...</option>

                </select>
                <input type="text" class="form-control" id="person_entity5" name="person_entity5" value="">
                <input type="text" class="form-control" id="person_fullname5" name="person_fullname5" value="">
                <input type="text" class="form-control" id="person_street5" name="person_street5" value="">
                <input type="text" class="form-control" id="person_barangay5" name="person_barangay5" value="">
                <input type="text" class="form-control" id="person_mobile5" name="person_mobile5" value="">


            </div>
            </div>
        </div><br>
    </div>
    </div>
    <script>
 


    </script>