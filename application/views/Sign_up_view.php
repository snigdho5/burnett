<!-- Body -->
<div class="container-fluid pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-3 pt-3">
                <form class="form-horizontal" id="log_in_registration_form" action="<?php echo base_url(); ?>login/submit_data" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name" class="cols-sm-2 control-label">Username or email address <span>*</span></label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="phone_or_email" id="phone_or_email" placeholder="Username or email address" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="submit" onclick="return log_in_form_validation()" class="btn btn-primary btn-lg login-button">Login</button>
                    </div>


                    <div class="form-group ">
                        <button id="login" type="Button" onclick="return fb_login()" class="btn btn-primary btn-lg login-button">Facebook Login</button>
                    </div>




                    <div class="form-group">
                        <div class="cols-sm-10">
                            <div class="checkbox">
                                <!-- <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label><br /> -->
                                <a href="<?php echo base_url() . 'forgotpassword'; ?>">Lost your password?</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-xl-9 col-md-9 pt-3">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#user-registration">User Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#doctor-registration">Doctor Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#distributor-egistration">Distributor Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#stockist-registration">Stockist Registration</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <small>
                        <?php
                        $succ_add = $this->session->flashdata('exist');
                        if ($succ_add) {
                        ?>
                            <br><span style="color:red">
                                <?php echo $succ_add; ?>
                            </span>
                        <?php
                        }
                        ?>
                    </small>
                    <small>
                        <?php
                        $succ_add = $this->session->flashdata('succ');
                        if ($succ_add) {
                        ?>
                            <br><span style="color:green">
                                <?php echo $succ_add; ?>
                            </span>
                        <?php
                        }
                        ?>
                    </small>


                    <div id="user-registration" class="container tab-pane active"><br>
                        <form class="form-horizontal" id="cu_registration_form" action="<?php echo base_url(); ?>sign_up/sign_up_submt_data" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cu_firstname" id="cu_firstname" placeholder="Enter your First Name" />
                                        <input type="hidden" name="user_type" value="CU" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cu_lastname" id="cu_lastname" placeholder="Enter your Last Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="cu_phone" id="cu_phone" placeholder="Enter your Telephone Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="cu_whatsapp" id="cu_whatsapp" placeholder="Enter your Whats App Number" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Email Id <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cu_email" id="cu_email" placeholder="Enter your Email Id" />
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="cu_password" id="cu_password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="cu_confirm" id="cu_confirm" placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" onclick="return cu_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                            </div>
                        </form>
                    </div>
                    <div id="doctor-registration" class="container tab-pane fade"><br>
                        <form class="form-horizontal" id="dr_registration_form" action="<?php echo base_url(); ?>sign_up/sign_up_submt_data" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dr_firstname" id="dr_firstname" placeholder="Enter your First Name" />
                                        <input type="hidden" name="user_type" value="DR" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dr_lastname" id="dr_lastname" placeholder="Enter your Last Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="dr_phone" id="dr_phone" placeholder="Enter your Telephone Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="dr_whatsapp" id="dr_whatsapp" placeholder="Enter your Whats App Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Doctor Email <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="dr_email" id="dr_email" placeholder="Enter your Email" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Have You any registration no <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">

                                        <!-- <select class="form-control" name="dr_have_registration_no" id="dr_have_registration_no" onchange="change_dr_registration();"> 
                                        <option value="">Select registration no</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                        <input type="radio" checked class="form-control" name="dr_have_registration_no" onclick="change_dr_registration();" value="Y">Yes</input>
                                        <input type="radio" onclick="change_dr_registration();" class="form-control" name="dr_have_registration_no" value="N">No</input>




                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="show_dr_registration">

                            </div>


                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="dr_password" id="dr_password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="dr_confirm" id="dr_confirm" placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" onclick="return dr_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                            </div>
                        </form>
                    </div>
                    <div id="distributor-egistration" class="container tab-pane fade"><br>
                        <form class="form-horizontal" id="di_registration_form" action="<?php echo base_url(); ?>sign_up/sign_up_submt_data" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_firstname" id="di_firstname" placeholder="Enter your First Name" />
                                        <input type="hidden" name="user_type" value="DI" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_lastname" id="di_lastname" placeholder="Enter your Last Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Firm Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_firmname" id="di_firmname" placeholder="Enter your Firm Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Drug License No <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_drug_license_no" id="di_drug_license_no" placeholder="Enter your Drug License No" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_gst_pan_no_firm" id="di_gst_pan_no_firm" placeholder="Enter your GST No" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Address <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <textarea class="form-control" name="di_address" id="di_address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="di_phone" id="di_phone" placeholder="Enter your Telephone Number" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Distributor Email <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_email" id="di_email" placeholder="Enter Distributor Email" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="di_whatsapp" id="di_whatsapp" placeholder="Enter your Whats App Number" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Area Name for Work <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_area_of_work" id="di_area_of_work" placeholder="Enter Area Name for Work" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Have You any registration no <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">

                                        <!--   <select class="form-control" name="di_prev_any_delarship" id="di_prev_any_delarship" onchange="change_di_delarship();"> 
                                        <option value="">Select delarship</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                        <input type="radio" checked class="form-control" name="di_prev_any_delarship" onclick="change_di_delarship();" value="Y">Yes</input>
                                        <input type="radio" onclick="change_di_delarship();" class="form-control" name="di_prev_any_delarship" value="N">No</input>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="show_di_delarship">

                            </div>

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Estimated Target of Business – (by amount in lacks) <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="di_target_of_business" id="di_target_of_business" placeholder="Estimated Target of Business – (by amount in lacks)" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">How Many Year of Experience in this Field<span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="di_year_of_experience" id="di_year_of_experience" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="di_password" id="di_password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="di_confirm" id="di_confirm" placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" onclick="return di_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                            </div>
                        </form>
                    </div>
                    <div id="stockist-registration" class="container tab-pane fade"><br>
                        <form class="form-horizontal" id="st_registration_form" action="<?php echo base_url(); ?>sign_up/sign_up_submt_data" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">First Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_firstname" id="st_firstname" placeholder="Enter your First Name" />
                                        <input type="hidden" name="user_type" value="ST" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Last Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_lastname" id="st_lastname" placeholder="Enter your Last Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Firm Name <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_firmname" id="st_firmname" placeholder="Enter your Firm Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Drug License No <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_drug_license_no" id="st_drug_license_no" placeholder="Enter your Drug License No" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">GST No/PAN No Of Firm <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_gst_pan_no_firm" id="st_gst_pan_no_firm" placeholder="Enter your GST No" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Address <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <textarea class="form-control" name="st_address" id="st_address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Telephone Number <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="st_phone" id="st_phone" placeholder="Enter your Telephone Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Whats App Number</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="st_whatsapp" id="st_whatsapp" placeholder="Enter your Whats App Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Stockist Email <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_email" id="st_email" placeholder="Enter Stockist Email" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Licence Number <span>*</span></label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">                                             
                                    <input type="text" class="form-control" name="st_whatsapp" id="st_whatsapp" placeholder="Licence Number" />
                                            </div></div></div> -->
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Area Name for Work <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_area_of_work" id="st_area_of_work" placeholder="Enter Area Name for Work" />
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Have You any delearship no <span>*</span></label>
                                <div class="cols-sm-10 st-set-width">
                                    <div class="input-group">

                                        <!--  <select class="form-control" name="st_prev_any_delarship" id="st_prev_any_delarship" onchange="change_st_delarship();"> 
                                        <option value="">Select delarship</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>

                                        </select> -->

                                        <input type="radio" checked class="form-control" name="st_prev_any_delarship" onclick="change_st_delarship();" value="Y">Yes</input>
                                        <input type="radio" onclick="change_st_delarship();" class="form-control" name="st_prev_any_delarship" value="N">No</input>



                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="show_st_delarship">

                            </div>




                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Estimated Target of Business – (by amount in lacks) <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="st_target_of_business" id="st_target_of_business" placeholder="Estimated Target of Business – (by amount in lacks)" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="st_password" id="st_password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password <span>*</span></label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="st_confirm" id="st_confirm" placeholder="Confirm your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" onclick="return st_sign_up_form_validation()" class="btn btn-primary btn-lg login-button">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Body -->



<script type="text/javascript">
    function cu_data_Submit_fm() {
        var cu_firstname = $("#cu_firstname").val();
        if (cu_firstname == "") {
            $('#cu_firstname').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_firstname').removeClass('red_border').addClass('black_border');
        }

        var cu_lastname = $("#cu_lastname").val();
        if (cu_lastname == "") {
            $('#cu_lastname').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_lastname').removeClass('red_border').addClass('black_border');
        }



        var cu_phone = $("#cu_phone").val();
        if (cu_phone == "" || cu_phone.length < 10) {
            $('#cu_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_phone').removeClass('red_border').addClass('black_border');
        }


        var cu_email = $("#cu_email").val();
        if (!isEmail(cu_email)) {
            $('#cu_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_email').removeClass('red_border').addClass('black_border');
        }


        var cu_password = $("#cu_password").val();
        if (cu_password == "") {
            $('#cu_password').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_password').removeClass('red_border').addClass('black_border');
        }

        //  if (cu_password.length < 6) 
        // {
        //   $('#pass_error').html('<i class="fa fa-exclamation-triangle"></i> Password length should be minimum 6 character').css('color', 'red');

        //     $('#cu_password').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //   $('#pass_error').html('');

        //     $('#cu_password').removeClass('red_border').addClass('black_border');
        // }

        var cu_confirm = $("#cu_confirm").val();
        if (cu_confirm == "" || cu_confirm != cu_password) {
            $('#cu_confirm').removeClass('black_border').addClass('red_border');
        } else {
            $('#cu_confirm').removeClass('red_border').addClass('black_border');
        }


    }

    function cu_sign_up_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#cu_registration_form').attr('onchange', 'cu_data_Submit_fm()');
        $('#cu_registration_form').attr('onkeypress', 'cu_data_Submit_fm()');

        cu_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#cu_registration_form .red_border').length > 0) {

            $('#cu_registration_form .red_border:first').focus();
            $('#cu_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#cu_registration_form").submit();
        }
    }
</script>






<script type="text/javascript">
    function dr_data_Submit_fm() {
        var dr_firstname = $("#dr_firstname").val();
        if (dr_firstname == "") {
            $('#dr_firstname').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_firstname').removeClass('red_border').addClass('black_border');
        }

        var dr_lastname = $("#dr_lastname").val();
        if (dr_lastname == "") {
            $('#dr_lastname').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_lastname').removeClass('red_border').addClass('black_border');
        }



        var dr_phone = $("#dr_phone").val();
        if (dr_phone == "" || dr_phone.length < 10) {
            $('#dr_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_phone').removeClass('red_border').addClass('black_border');
        }


        var dr_email = $("#dr_email").val();
        if (!isEmail(dr_email)) {
            $('#dr_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_email').removeClass('red_border').addClass('black_border');
        }

        //  var dr_have_registration_no=$("#dr_have_registration_no").val();       

        var dr_have_registration_no = $("input[type='radio'][name='dr_have_registration_no']:checked").val();
        if (dr_have_registration_no == 'Y') {

            var dr_registration_no = $("#dr_registration_no").val();
            if (dr_registration_no == "") {
                $('#dr_registration_no').removeClass('black_border').addClass('red_border');
            } else {
                $('#dr_registration_no').removeClass('red_border').addClass('black_border');
            }


        }


        if (dr_have_registration_no == 'N') {

            var dr_chember_picture = $("#dr_chember_picture").val();
            if (dr_chember_picture == "") {
                $('#dr_chember_picture').removeClass('black_border').addClass('red_border');
            } else {
                $('#dr_chember_picture').removeClass('red_border').addClass('black_border');
            }


        }












        var dr_password = $("#dr_password").val();
        if (dr_password == "") {
            $('#dr_password').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_password').removeClass('red_border').addClass('black_border');
        }

        //  if (cu_password.length < 6) 
        // {
        //   $('#pass_error').html('<i class="fa fa-exclamation-triangle"></i> Password length should be minimum 6 character').css('color', 'red');

        //     $('#cu_password').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //   $('#pass_error').html('');

        //     $('#cu_password').removeClass('red_border').addClass('black_border');
        // }

        var dr_confirm = $("#dr_confirm").val();
        if (dr_confirm == "" || dr_confirm != dr_password) {
            $('#dr_confirm').removeClass('black_border').addClass('red_border');
        } else {
            $('#dr_confirm').removeClass('red_border').addClass('black_border');
        }


    }

    function dr_sign_up_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#dr_registration_form').attr('onchange', 'dr_data_Submit_fm()');
        $('#dr_registration_form').attr('onkeypress', 'dr_data_Submit_fm()');

        dr_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#dr_registration_form .red_border').length > 0) {

            $('#dr_registration_form .red_border:first').focus();
            $('#dr_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#dr_registration_form").submit();
        }
    }



    function change_dr_registration() {

        var change_reg_val = $("input[type='radio'][name='dr_have_registration_no']:checked").val();

        var html = '';

        if (change_reg_val == 'Y') {
            html = ' <label for="email" class="cols-sm-2 control-label">Doctor Registration Id  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="dr_registration_no" id="dr_registration_no" placeholder="Enter your Registration Id" /></div></div>';

        } else {

            html = ' <label for="email" class="cols-sm-2 control-label">Doctor Chember Picture  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="file" class="form-control" name="dr_chember_picture" id="dr_chember_picture"" /></div></div>';

        }

        $("#show_dr_registration").html(html);

    }
</script>



<script type="text/javascript">
    function di_data_Submit_fm() {
        var di_firstname = $("#di_firstname").val();
        if (di_firstname == "") {
            $('#di_firstname').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_firstname').removeClass('red_border').addClass('black_border');
        }

        var di_lastname = $("#di_lastname").val();
        if (di_lastname == "") {
            $('#di_lastname').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_lastname').removeClass('red_border').addClass('black_border');
        }


        var di_firmname = $("#di_firmname").val();
        if (di_firmname == "") {
            $('#di_firmname').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_firmname').removeClass('red_border').addClass('black_border');
        }

        var di_drug_license_no = $("#di_drug_license_no").val();
        if (di_drug_license_no == "") {
            $('#di_drug_license_no').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_drug_license_no').removeClass('red_border').addClass('black_border');
        }





        var di_gst_pan_no_firm = $("#di_gst_pan_no_firm").val();
        if (di_gst_pan_no_firm == "") {
            $('#di_gst_pan_no_firm').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_gst_pan_no_firm').removeClass('red_border').addClass('black_border');
        }
        var di_address = $("#di_address").val();
        if (di_address == "") {
            $('#di_address').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_address').removeClass('red_border').addClass('black_border');
        }
        var di_phone = $("#di_phone").val();
        if (di_phone == "") {
            $('#di_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_phone').removeClass('red_border').addClass('black_border');
        }
        var di_email = $("#di_email").val();

        if (!isEmail(di_email)) {
            $('#di_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_email').removeClass('red_border').addClass('black_border');
        }
        var di_area_of_work = $("#di_area_of_work").val();
        if (di_area_of_work == "") {
            $('#di_area_of_work').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_area_of_work').removeClass('red_border').addClass('black_border');
        }








        // var di_prev_any_delarship=$("#di_prev_any_delarship").val(); 
        var di_prev_any_delarship = $("input[type='radio'][name='di_prev_any_delarship']:checked").val();


        if (di_prev_any_delarship == 'Y') {

            var di_name_of_company = $("#di_name_of_company").val();
            if (di_name_of_company == "") {
                $('#di_name_of_company').removeClass('black_border').addClass('red_border');
            } else {
                $('#di_name_of_company').removeClass('red_border').addClass('black_border');
            }


        }









        var di_target_of_business = $("#di_target_of_business").val();
        if (di_target_of_business == "") {
            $('#di_target_of_business').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_target_of_business').removeClass('red_border').addClass('black_border');
        }
        var di_year_of_experience = $("#di_year_of_experience").val();
        if (di_year_of_experience == "") {
            $('#di_year_of_experience').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_year_of_experience').removeClass('red_border').addClass('black_border');
        }



















        var di_password = $("#di_password").val();
        if (di_password == "") {
            $('#di_password').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_password').removeClass('red_border').addClass('black_border');
        }

        //  if (cu_password.length < 6) 
        // {
        //   $('#pass_error').html('<i class="fa fa-exclamation-triangle"></i> Password length should be minimum 6 character').css('color', 'red');

        //     $('#cu_password').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //   $('#pass_error').html('');

        //     $('#cu_password').removeClass('red_border').addClass('black_border');
        // }

        var di_confirm = $("#di_confirm").val();
        if (di_confirm == "" || di_confirm != di_password) {
            $('#di_confirm').removeClass('black_border').addClass('red_border');
        } else {
            $('#di_confirm').removeClass('red_border').addClass('black_border');
        }


    }

    function di_sign_up_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#di_registration_form').attr('onchange', 'di_data_Submit_fm()');
        $('#di_registration_form').attr('onkeypress', 'di_data_Submit_fm()');

        di_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#di_registration_form .red_border').length > 0) {

            $('#di_registration_form .red_border:first').focus();
            $('#di_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#di_registration_form").submit();
        }
    }












    function change_di_delarship() {

        // var di_prev_any_delarship=  $("#di_prev_any_delarship").val();
        var di_prev_any_delarship = $("input[type='radio'][name='di_prev_any_delarship']:checked").val();

        var di_html = '';

        if (di_prev_any_delarship == 'Y') {
            di_html = ' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="di_name_of_company" id="di_name_of_company" placeholder="Name of company" /></div></div>';

        } else {

            di_html = '';

        }

        $("#show_di_delarship").html(di_html);

    }
</script>





<script type="text/javascript">
    function st_data_Submit_fm() {
        var st_firstname = $("#st_firstname").val();
        if (st_firstname == "") {
            $('#st_firstname').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_firstname').removeClass('red_border').addClass('black_border');
        }

        var st_lastname = $("#st_lastname").val();
        if (st_lastname == "") {
            $('#st_lastname').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_lastname').removeClass('red_border').addClass('black_border');
        }


        var st_firmname = $("#st_firmname").val();
        if (st_firmname == "") {
            $('#st_firmname').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_firmname').removeClass('red_border').addClass('black_border');
        }

        var st_drug_license_no = $("#st_drug_license_no").val();
        if (st_drug_license_no == "") {
            $('#st_drug_license_no').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_drug_license_no').removeClass('red_border').addClass('black_border');
        }





        var st_gst_pan_no_firm = $("#st_gst_pan_no_firm").val();
        if (st_gst_pan_no_firm == "") {
            $('#st_gst_pan_no_firm').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_gst_pan_no_firm').removeClass('red_border').addClass('black_border');
        }
        var st_address = $("#st_address").val();
        if (st_address == "") {
            $('#st_address').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_address').removeClass('red_border').addClass('black_border');
        }
        var st_phone = $("#st_phone").val();
        if (st_phone == "") {
            $('#st_phone').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_phone').removeClass('red_border').addClass('black_border');
        }
        var st_email = $("#st_email").val();

        if (!isEmail(st_email)) {
            $('#st_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_email').removeClass('red_border').addClass('black_border');
        }
        var st_area_of_work = $("#st_area_of_work").val();
        if (st_area_of_work == "") {
            $('#st_area_of_work').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_area_of_work').removeClass('red_border').addClass('black_border');
        }








        // var st_prev_any_delarship=$("#st_prev_any_delarship").val();   
        var st_prev_any_delarship = $("input[type='radio'][name='st_prev_any_delarship']:checked").val();


        if (st_prev_any_delarship == 'Y') {

            var st_name_of_company = $("#st_name_of_company").val();
            if (st_name_of_company == "") {
                $('#st_name_of_company').removeClass('black_border').addClass('red_border');
            } else {
                $('#st_name_of_company').removeClass('red_border').addClass('black_border');
            }


        }









        var st_target_of_business = $("#st_target_of_business").val();
        if (st_target_of_business == "") {
            $('#st_target_of_business').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_target_of_business').removeClass('red_border').addClass('black_border');
        }




        var st_password = $("#st_password").val();
        if (st_password == "") {
            $('#st_password').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_password').removeClass('red_border').addClass('black_border');
        }

        //  if (cu_password.length < 6) 
        // {
        //   $('#pass_error').html('<i class="fa fa-exclamation-triangle"></i> Password length should be minimum 6 character').css('color', 'red');

        //     $('#cu_password').removeClass('black_border').addClass('red_border');            
        // } 
        // else 
        // {
        //   $('#pass_error').html('');

        //     $('#cu_password').removeClass('red_border').addClass('black_border');
        // }

        var st_confirm = $("#st_confirm").val();
        if (st_confirm == "" || st_confirm != st_password) {
            $('#st_confirm').removeClass('black_border').addClass('red_border');
        } else {
            $('#st_confirm').removeClass('red_border').addClass('black_border');
        }


    }

    function st_sign_up_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#st_registration_form').attr('onchange', 'st_data_Submit_fm()');
        $('#st_registration_form').attr('onkeypress', 'st_data_Submit_fm()');

        st_data_Submit_fm();

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#st_registration_form .red_border').length > 0) {

            $('#st_registration_form .red_border:first').focus();
            $('#st_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#st_registration_form").submit();
        }
    }












    function change_st_delarship() {

        //  var st_prev_any_delarship=  $("#st_prev_any_delarship").val();
        var st_prev_any_delarship = $("input[type='radio'][name='st_prev_any_delarship']:checked").val();

        var st_html = '';

        if (st_prev_any_delarship == 'Y') {
            st_html = ' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="st_name_of_company" id="st_name_of_company" placeholder="Name of company" /></div></div>';

        } else {

            st_html = '';

        }

        $("#show_st_delarship").html(st_html);

    }
</script>




<script type="text/javascript">
    function log_in_data_Submit_fm() {
        var phone_or_email = $("#phone_or_email").val();
        if (phone_or_email == "") {
            $('#phone_or_email').removeClass('black_border').addClass('red_border');
        } else {
            $('#phone_or_email').removeClass('red_border').addClass('black_border');
        }

        var password = $("#password").val();
        if (password == "") {
            $('#password').removeClass('black_border').addClass('red_border');
        } else {
            $('#password').removeClass('red_border').addClass('black_border');
        }





    }

    function log_in_form_validation() {
        //alert('ok');

        // var cat_ids=[];
        //   $(':checkbox[id^="chk_bx"]:checked').each(function(){        
        //    cat_ids.push($(this).val());              
        // });



        $('#log_in_registration_form').attr('onchange', 'log_in_data_Submit_fm()');
        $('#log_in_registration_form').attr('onkeypress', 'log_in_data_Submit_fm()');

        log_in_data_Submit_fm();
        3

        //  alert($('#user_registration_form_id .red_border').size());

        if ($('#log_in_registration_form .red_border').length > 0) {

            $('#cu_registration_form .red_border:first').focus();
            $('#log_in_registration_form .alert-error').show();
            return false;
        }

        // else if(cat_ids.length==0){              
        //   alert("Please agree with our terms and conditions.");              
        //   return false;            
        // }
        else {

            $("#log_in_registration_form").submit();
        }
    }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        ready_dr_have_registration_no_fun();
        ready_di_have_registration_no_fun();
        ready_st_have_registration_no_fun();


    });



    function ready_dr_have_registration_no_fun() {


        var ready_dr_have_registration_no = $("input[type='radio'][name='dr_have_registration_no']:checked").val();
        // alert(ready_dr_have_registration_no);
        var dr_ready_html = ''

        if (ready_dr_have_registration_no == 'Y') {

            dr_ready_html = ' <label for="email" class="cols-sm-2 control-label">Doctor Registration Id  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="dr_registration_no" id="dr_registration_no" placeholder="Enter your Registration Id" /></div></div>';
        }



        $("#show_dr_registration").html(dr_ready_html);

    }



    function ready_di_have_registration_no_fun() {


        var ready_di_prev_any_delarship = $("input[type='radio'][name='di_prev_any_delarship']:checked").val();
        // alert(ready_dr_have_registration_no);
        var di_ready_html = ''

        if (ready_di_prev_any_delarship == 'Y') {

            di_ready_html = ' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="di_name_of_company" id="di_name_of_company" placeholder="Name of company" /></div></div>';
        }



        $("#show_di_delarship").html(di_ready_html);

    }



    function ready_st_have_registration_no_fun() {


        var ready_st_prev_any_delarship = $("input[type='radio'][name='st_prev_any_delarship']:checked").val();

        // alert(ready_dr_have_registration_no);
        var st_ready_html = ''

        if (ready_st_prev_any_delarship == 'Y') {

            st_ready_html = ' <label for="email" class="cols-sm-2 control-label">Name of company  <span>*</span></label><div class="cols-sm-10"><div class="input-group"><input type="text" class="form-control" name="st_name_of_company" id="st_name_of_company" placeholder="Name of company" /></div></div>';
        }



        $("#show_st_delarship").html(st_ready_html);

    }
</script>




<!-------------facebook login ---------------------------------->

<script type="text/javascript">
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;

        js.src = "https://connect.facebook.net/es_LA/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function fb_login() {
        FB.login(function(response) {
            if (response.authResponse) {
                console.log('Authenticated!');

                testAPI()
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: 'email,user_checkins'
        });
    }

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId: '3678283242184763',
            cookie: true,

            xfbml: true,
            version: 'v3.1',
            auth_type: 'rerequest',
            "permission": "public_profile",
            "status": "granted"
        });

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };


    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', {
            fields: 'id, first_name, last_name, email, gender, birthday,picture,permissions '
        }, function(response) {


            console.log(response);


        });
    }
</script>