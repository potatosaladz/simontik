 <div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Pengaturan</a></li>
            <li><a href="#">Rekam User</a></li>
        </ol>
<!--         <div id="social" class="pull-right">
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>
        </div> -->
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-search"></span>
                    <span>Rekam User</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </a>
                    <a class="expand-link">
                        <span class="glyphicon glyphicon-expand"></span>
                    </a>
                    <a class="close-link">
                        <span class="glyphicon glyphicon-times"></span>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>

            <div class="box-content">
    <fieldset>
            <?php 
                $attributes = array('class' => 'frm_rekam', 'id' => 'frm_rekam'); 
                if(isset($rekam) && $rekam==true && $update==false){
                    echo form_open('pengaturan/simpan');
                }
                if (isset($update) && $update==true && $rekam==false){
                    echo form_open('pengaturan/update');
                }
                

                if(isset($user)){
                     foreach ($user as $row2) {
                         $unit_ubah=$row2['unit'];
                         $nip_ubah=$row2['nip'];
                         $username_ubah=$row2['username'];
                         $admin_ubah=$row2['fl_admin'];
                         $id_ubah=$row2['id'];
                     }
                }
            
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($user)) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label>Unit</label></td>
                        <td colspan="2" >
                            <select name="unit">
                                <?php 
                                    foreach ($unitAll as $row) {
                                        if(isset($user)){
                                            if($row['unit2']==$unit_ubah){
                                                echo "<option value=".$row['unit2']." selected>".$row['kantor']."</option>";
                                            }else{
                                                echo "<option value=".$row['unit2'].">".$row['kantor']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['unit2'].">".$row['kantor']."</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                        if(isset($admin) && $admin==1){
                    ?>
                        <tr>
                            <td><label>Admin</label></td>
                            <td colspan="2" >
                                <select id="admin" name="admin">
                                    <?php
                                    if(isset($user) && $admin_ubah==1)
                                    {
                                    ?>
                                    <option value="0">Biasa</option>
                                    <option value="1" selected>Admin</option>
                                    <?php
                                    }else{
                                    ?>
                                    <option value="0" selected>Biasa</option>
                                    <option value="1">Admin</option>
                                    <?php    
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td><label for="user">Username</label></td>
                        <td><input type="text" id="username" name="username" class="text ui-widget-content ui-corner-all" <?php if(isset($user)) echo "value=\"".$username_ubah."\" readonly disabled";  ?>/></td>                        
                    </tr>
                    <tr>
                        <td><label for="user">NIP</label></td>
                        <td><input type="text" id="nip" name="nip" class="text ui-widget-content ui-corner-all" value="<?php if(isset($user)) echo $nip_ubah;  ?>"/></td>                        
                    </tr>
                    <tr>
                        <td><label for="user">Password</label></td>
                        <td><input type="password" id="password" name="password" class="text ui-widget-content ui-corner-all"/ ></td>  
                    </tr>
                    <tr>
                        <td><input type="submit" value="Simpan"/></td>
                        <td><input type="reset" value="Reset"/></td>
                    </tr>
                
                </table>
            <?php echo form_close(); ?>
    </fieldset>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-search"></span>
                    <span>Info</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </a>
                    <a class="expand-link">
                        <span class="glyphicon glyphicon-expand"></span>
                    </a>
                    <a class="close-link">
                        <span class="glyphicon glyphicon-times"></span>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                
                <?php
                if (isset($message_display)) {
                    echo "<p class=\"bg-success\">";
                    echo $message_display;
                    echo "</p>";
                }
                if (isset($error_message)) {
                    echo "<p class=\"bg-danger\">";
                    echo $error_message;
                    echo "</p>";
                }
                echo "<p class=\"bg-danger\">";
                echo validation_errors();
                echo "</p>";
                ?>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
// Run Select2 plugin on elements
function DemoSelect2(){
    $('#s2_with_tag').select2({placeholder: "Select OS"});
    $('#s2_country').select2();
}
// Run timepicker
function DemoTimePicker(){
    $('#input_time').timepicker({setDate: new Date()});
}
$(document).ready(function() {
    // Create Wysiwig editor for textare
    TinyMCEStart('#wysiwig_simple', null);
    TinyMCEStart('#wysiwig_full', 'extreme');
    // Add slider for change test input length
    FormLayoutExampleInputLength($( ".slider-style" ));
    // Initialize datepicker
    $('#input_date').datepicker({setDate: new Date()});
    // Load Timepicker plugin
    LoadTimePickerScript(DemoTimePicker);
    // Add tooltip to form-controls
    $('.form-control').tooltip();
    LoadSelect2Script(DemoSelect2);
    // Load example of form validation
    LoadBootstrapValidatorScript(DemoFormValidator);
    // Add drag-n-drop feature to boxes
    WinMove();
});
</script> 