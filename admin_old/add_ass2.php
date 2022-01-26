    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   

    <div class="card-body">

       <div class="row">
      
        

       </div>
    </div>





















    <div class="card-header p-2 card-success card-outline">
       <div class="nav nav-pills" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-allergy" role="tab" aria-controls="nav-home" aria-selected="true">ALLERGY INFORMATION</a>
          <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-other" aria-selected="false">MEDICAL INFORMATION</a>
          <a class="nav-item nav-link" id="nav-covid-tab" data-toggle="tab" href="#nav-covid" role="tab" aria-controls="nav-covid" aria-selected="false">COVID INFORMATION</a>
          <a class="nav-item nav-link" id="nav-pregnancy-tab" data-toggle="tab" href="#nav-pregnancy" role="tab" aria-controls="nav-pregnancy" aria-selected="false">PREGNANCY STATUS</a>
       </div>
    </div>

    <div class="card-body">
       <div class="box-body">
          <div class="tab-content" id="nav-tabContent">

             <div class="tab-pane fade show active" id="nav-allergy" role="tabpanel" aria-labelledby="nav-home-tab">
                <div>


                   <div class="row">
                      <div class="col-sm-7">
                         <label>Has no allergies to PEG or polysorbate?</label>
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                         <select class="form-control select2" style="width:100%" name="allergy_PEG" id="allergy_PEG" value="">
                            <!-- <option>Do you have comorbidities?</option> -->
                            <option>Please select</option>
                            <option <?php if ($allergy_PEG == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                            <option <?php if ($allergy_PEG == '02_No') echo 'selected'; ?> value="02_No">No</option>
                         </select>
                      </div>
                   </div><br>

                   <div class="row">
                      <div class="col-sm-7">
                         <label>Has no allergy to food, egg, medicines, and no asthma?</label>
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                         <select class="form-control select2" style="width:100%" name="food_allergy" id="food_allergy" value="">
                            <!-- <option>Do you have comorbidities?</option> -->
                            <option <?php if ($wallergy == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                            <option <?php if ($wallergy == '02_No') echo 'selected'; ?> value="02_No">No </option>
                         </select>
                      </div>
                   </div><br>

                   <?php if ($wallergy == '02_No') { ?>
                      <div class="row" id="allergic">
                      <?php } else { ?>
                         <div hidden class="row" id="allergic">
                         <?php } ?>

                         <div class="col-sm-7">
                            <label>* If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                         </div>
                         <div class="col-sm-2"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="monitor_patient" id="monitor_patient" value="">
                               <!-- <option>Do you have comorbidities?</option> -->
                               <option>Please select</option>
                               <option <?php if ($monitor_patient == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($monitor_patient == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                         </div><br>

                         <div class="row">
                            <div class="col-sm-7">
                               <label>Has no severe allergic reaction after the 1st dose of the vaccine?</label>
                            </div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">
                               <select class="form-control select2" style="width:100%" name="allergic_reaction" id="allergic_reaction" value="">
                                  <!-- <option>Do you have comorbidities?</option> -->
                                  <option>Please select</option>
                                  <option <?php if ($allergic_reaction == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                  <option <?php if ($allergic_reaction == '02_No') echo 'selected'; ?> value="02_No">No</option>
                               </select>
                            </div>
                         </div>


                      </div>

                </div>


                <div class="tab-pane fade" id="nav-covid" role="tabpanel" aria-labelledby="nav-covid-tab">
                   <div>


                      <div class="row">
                         <div class="col-sm-7">
                            <label style="font-size:14px">Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?</label>
                         </div>
                         <div class="col-sm-2"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="covid_exposure" id="covid_exposure" value="">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($no_exposure == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($no_exposure == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>


                      <div class="row">
                         <div class="col-sm-7">
                            <label style="font-size:14px">Has not been previously treated for COVID-19 in the past 90 days?</label>
                         </div>
                         <div class="col-sm-2"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="covid_treated" id="covid_treated" value="">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($no_treated == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($no_treated == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>


                      <div class="row">
                         <div class="col-sm-7">
                            <label style="font-size:14px">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?</label>
                         </div>
                         <div class="col-sm-2"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="covid_antibody" id="covid_antibody" value="">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($no_received_antibodies == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($no_received_antibodies == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                   </div>
                </div>

                <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">

                   <div>
                      <div class="row">
                         <div class="col-sm-8">
                            <label style="font-size:14px">Age more than 16 years old?</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="age_16" id="age_16" value="">
                               <!-- <option>Do you have comorbidities?</option> -->
                               <option>Please select</option>
                               <option <?php if ($age_16 == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($age_16 == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div class="col-sm-8">
                            <label style="font-size:14px">Has no history of bleeding disorders or currently taking anti-coagulants?</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="bleeding_history" id="bleeding_history" value="">
                               <!-- <option>Do you have comorbidities?</option> -->
                               <option>Please select</option>
                               <option <?php if ($bleeding_history == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($bleeding_history == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div hidden class="col-sm-8" id="bleeding">
                            <label style="font-size:14px">* If with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div hidden class="col-sm-3" id="bleeding1">
                            <select class="form-control select2" style="width:100%" name="yes_bleeding" id="yes_bleeding" value="">
                               <!-- <option>Do you have comorbidities?</option> -->
                               <option>Please select</option>
                               <option <?php if ($yes_bleeding == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($yes_bleeding == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div class="col-sm-8">
                            <label style="font-size:14px">Has not received any vaccine in the past 2 weeks?</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="no_received_vaccine" id="no_received_vaccine" value="">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($no_received_vaccine == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($no_received_vaccine == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div class="col-sm-8">
                            <label style="font-size:14px">Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat, Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="manifest_symptoms" id="manifest_symptoms" value="">
                               <!-- <option>Do you have comorbidities?</option> -->
                               <option>Please select</option>
                               <option <?php if ($symptoms == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($symptoms == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div hidden class="col-sm-8" id="symptoms">
                            <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify all that apply</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div hidden class="col-sm-3" id="symptoms1">
                            <select class="form-control select2" id="symptoms" style="width: 100%;" multiple="" name="list_symptoms[]" placeholder="">

                               <?php while ($get_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div class="col-sm-8">
                            <label style="font-size:14px">Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div class="col-sm-3">
                            <select class="form-control select2" style="width:100%" name="no_illness" id="no_illness" value="">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($illness == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($illness == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                         </div>
                      </div><br>

                      <div class="row">
                         <div hidden class="col-sm-8" id="illness">
                            <label style="font-size:14px" for="">* If manifesting any of the mentioned symptom/s, specify.</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div hidden class="col-sm-3" id="illness1">
                            <select class="form-control select2" id="complications" style="width: 100%;" multiple="" name="list_illness[]" placeholder="Select Illness" value="">
                               <!-- <option selected>Choose here...</option> -->
                               <?php while ($get_complications = $get_all_complications_data->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <option value="<?php echo $get_complications['complications']; ?>"><?php echo $get_complications['complications']; ?></option>
                               <?php } ?>
                            </select>
                         </div>
                      </div><br>


                      <div class="row">
                         <div hidden class="col-sm-8" id="clearance">
                            <label style="font-size:14px">* If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                         </div>
                         <div class="col-sm-1"></div>
                         <div hidden class="col-sm-3" id="clearance1">
                            <select class="form-control select2" style="width:100%" name="medical_clearance" id="medical_clearance" value="<?php echo $medical_clearance; ?>">
                               <!-- <option>Choose here</option> -->
                               <option>Please select</option>
                               <option <?php if ($clearance == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                               <option <?php if ($clearance == '02_No') echo 'selected'; ?> value="02_No">No</option>
                            </select>
                            </select>
                         </div>
                      </div>

                   </div>
                </div>

                <div class="tab-pane fade" id="nav-pregnancy" role="tabpanel" aria-labelledby="nav-pregnancy-tab">
                   <div>

                      <div class="row">
                         <div class="col-md-7">
                            <label>Not Pregnant?</label>
                         </div>
                         <div class="col-md-1"></div>
                         <div class="col-md-4">
                            <select class="form-control select2" style="width:100%" name="preg_status" id="preg_status" value="<?php echo $get_pregstatus ?>">
                               <option>Select pregnancy status...</option>
                               <option <?php if ($get_pregstatus == '01_Pregnant') echo 'selected'; ?> value="02_No">No</option>
                               <option <?php if ($get_pregstatus == '02_Not_Pregnant') echo 'selected'; ?> value="01_Yes">Yes</option>

                            </select>
                         </div>
                      </div><br>

                      <?php if ($get_pregstatus == '01_Pregnant') { ?>
                         <div id="preg_sem" class="row">
                         <?php } else { ?>
                            <div hidden id="preg_sem" class="row">
                            <?php } ?>

                            <div class="col-sm-7">
                               <label> If pregnant, 2nd or 3rd trimester?</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                               <select class="form-control select2" style="width:100%" name="preg_semester" id="preg_semester" value="<?php echo $pregnant_semester ?>">
                                  <option>Please select</option>
                                  <option <?php if ($semester == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                                  <option <?php if ($semester == '02_No') echo 'selected'; ?> value="02_No">No</option>
                               </select>
                            </div>
                            </div>


                         </div>
                   </div>


                </div>


             </div>

          </div>
       </div>
    </div>





























    <!-- start of deferral -->
    <div class="card card-success card-outline">
       <div class="card-header">

          <h5 class="m-0">DEFERRAL</h5>
       </div>

       <div class="card-body">

          <div class="row">
             <div class="col-md-6">
                <label for="">Reason:</label>
                <select class="form-control select2" id="deferral" style="width: 100%;" name="deferral" placeholder="" value="<?php echo $deferral; ?>">
                   <option selected value="">Please select</option>
                   <?php while ($get_deferral = $get_all_deferral_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $selected = ($deferral == $get_deferral['deferral']) ? 'selected' : ''; ?>
                      <option <?= $selected; ?> value="<?php echo $get_deferral['deferral']; ?>"><?php echo $get_deferral['deferral']; ?></option>
                   <?php } ?>
                </select>
             </div>
          </div>

       </div>
    </div>
    <!-- end of deferral -->





    <div hidden id="vaccine_info" class="card card-success card-outline">
       <div class="card-header">

          <h5 class="m-0">VACCINE INFORMATION</h5>
       </div>

       <div class="card-body">

          <div class="row">

             <div class="col-md-6">
                <label>Vaccination Date: </label>

                <!-- <div class="input-group date" data-provide="datepicker"> -->
                <!-- <div class="input-group-addon">
                                                                                        <i class="fa fa-calendar"></i>
                                                                                    </div> -->
                <?php if ($vaccination_date == '') { ?>
                   <!-- <input type="date" class="form-control pull-right" style="width: 90%;" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo date('Y-m-d'); ?>"> -->

                   <input type="date" class="form-control pull-right" name="vaccination_date" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo date('Y-m-d'); ?>" />
                <?php } else { ?>

                   <input type="date" class="form-control pull-right" name="vaccination_date" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo $vaccination_date; ?>" />
                   <!-- <input type="date" class="form-control pull-right" style="width: 90%;" id="datepicker" name="vaccination_date" placeholder="Date of Vaccination" value="<?php echo $vaccination_date; ?>"> -->
                <?php } ?>



             </div>
             <input hidden type="text" class="form-control" name="assessment_username" id="assessment_username" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="assessment_username" value="<?php echo $tracer_fullname2; ?>">

             <div class=" col-md-6">
                <label for="">Vaccine Manufacturer: &nbsp;&nbsp; <span id="required">*</span></label>
                <select class="form-control select2" id="vaccine_manufacturer" style="width: 100%;" name="vaccine_manufacturer" placeholder="" value="">
                   <option selected>Select Manufacturer</option>
                   <?php while ($get_manufacturer = $get_all_manufacturer_sql->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $selected = ($vaccine_manufacturer == $get_manufacturer['manufacturer']) ? 'selected' : ''; ?>
                      <option <?= $selected; ?> value="<?php echo $get_manufacturer['manufacturer']; ?>"><?php echo $get_manufacturer['manufacturer']; ?></option>
                   <?php } ?>
                </select>
             </div>

          </div><br>

          <div class="row">

             <div class="col-md-6">
                <label for="">Batch Number: &nbsp;&nbsp; <span id="required">*</span></label>
                <input type="text" class="form-control" name="batch_number" id="batch_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Batch Number" value="<?php echo $batch_number; ?>">
             </div>

             <div class="col-md-6">
                <label for="">Lot Number: &nbsp;&nbsp; <span id="required">*</span></label>
                <input type="text" class="form-control" name="lot_number" id="lot_number" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Lot Number" value="<?php echo $lot_number; ?>">
             </div>
          </div><br>

          <div class="row">
             <div class="col-md-6">
                <label readonly for="">Vaccinator Name: &nbsp;&nbsp; <span id="required">*</span></label>

                <select class="form-control select2 vaccinator" id="vaccinator1" style="width: 100%;" name="vaccinator" placeholder="" value="">
                   <option selected>Select Vaccinator</option>
                   <?php while ($get_vaccinator = $get_all_vaccinator_sql->fetch(PDO::FETCH_ASSOC)) { ?>

                      <?php $selected = ($get_vaccinator_name == $get_vaccinator['l_name'] . ', ' . $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name']) ? 'selected' : ''; ?>
                      <option <?= $selected; ?> value="<?php echo $get_vaccinator['l_name'] . ', ' . $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name']; ?>"><?php echo $get_vaccinator['l_name'] . ', ' . $get_vaccinator['f_name'] . ' ' . $get_vaccinator['m_name']; ?></option>
                   <?php } ?>
                </select>
             </div>

             <div class="col-md-6">
                <label for="">Profession of Vaccinator: &nbsp;&nbsp; <span id="required">*</span></label>
                <input type="text" class="form-control" name="profession_vaccinator" id="profession_vaccinator" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="Profession" value="<?php echo $profession_vaccinator; ?>">

             </div>
          </div><br>

          <div class="row">
             <div class="col-sm-4">
                <label>1st Dose</label>
                <select name="first_dose" id="first_dose" style="width:100%" class="form-control " value="<?php echo $dose_1st; ?>">
                   <option selected>Please select</option>
                   <option <?php if ($dose_1st == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                   <option <?php if ($dose_1st == '02_No') echo 'selected'; ?> value="02_No">No</option>
                </select>
             </div>
             <div class="col-sm-4">
                <label>2nd Dose</label>
                <select name="second_dose" id="second_dose" style="width:100%" class="form-control " value="<?php echo $dose_2nd; ?>">
                   <option selected>Please select</option>
                   <option <?php if ($dose_2nd == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                   <option <?php if ($dose_2nd == '02_No') echo 'selected'; ?> value="02_No">No</option>
                </select>
             </div>
             <div class="col-sm-4">
                <label>3rd Dose</label>
                <select name="third_dose" id="third_dose" style="width:100%" class="form-control " value="<?php echo $dose_3rd; ?>">
                   <option selected>Please select</option>
                   <option <?php if ($dose_3rd == '01_Yes') echo 'selected'; ?> value="01_Yes">Yes </option>
                   <option <?php if ($dose_3rd == '02_No') echo 'selected'; ?> value="02_No">No</option>
                </select>
             </div>

          </div><br>
          <div class="row">
             <div class="col-sm-6">
                <label>Bakuna Center</label>
                <select name="bakuna_center" id="bakuna_center" style="width:100%" class="form-control select2 baks" value="">
                   <option selected>Select Bakuna Center</option>
                   <?php while ($get_center = $bk_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                      <?php $selected = ($bakuna_center_no == $get_center['bc_code']) ? 'selected' : ''; ?>
                      <option <?= $selected; ?> value="<?php echo $get_center['bc_name']; ?>"><?php echo $get_center['bc_name']; ?></option>
                   <?php } ?>
                </select>
             </div>

             <div class="col-md-6">
                <label readonly for="">CBCR No: &nbsp;&nbsp; <span id="required">*</span></label>
                <input type="text" class="form-control" name="cbcr_no" id="cbcr_no" style=" text-transform: uppercase;" onkeyup="this.value = this.value.toUpperCase();" placeholder="CBCR No." value="<?php echo $bakuna_center_no; ?>">

             </div>

          </div>

       </div>

       <input hidden type="text" class="form-control" style="text-align:center;" name="entity_no" id="entity_no" placeholder="entity_no" value="<?php echo $get_entity_no; ?>">

       <!-- end vaccine information -->


       <div class="box-footer" align="center">
          <button type="submit" id="btnSubmit" name="update_assessment" class="btn btn-success">
             <!-- <i class="fa fa-check fa-fw"> </i> -->
             <h4>Submit Form</h4>
          </button>

       </div>
    </div>