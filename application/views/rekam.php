<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Hardware</a></li>
            <li><a href="#">Rekam</a></li>
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
                    <span>Rekam Hardware</span>
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
                $attributes = array('class' => 'frm_rekam', 'id' => 'frm_rekam'); 
                if(isset($hardware)){
                    echo form_open('server/update');
                }else{
                    echo form_open('server/simpan');
                }
                 

            if(isset($hardware)){
                foreach ($hardware as $row) {
                    $jenis_ubah=$row['jenis'];
                    $merk_ubah=$row['merk'];
                    $tipe_ubah=$row['tipe'];
                    $sn_ubah=$row['sn'];
                    $os_ubah=$row['os'];
                    $ip_ubah=$row['ip'];
                    $prosesor_ubah=$row['prosesor'];
                    $memori_ubah=$row['memori'];
                    $hdd_ubah=$row['hdd'];
                    $kondisi_ubah=$row['kondisi'];
                    $tahun_ubah=$row['tahun'];
                    $antivirus_ubah=$row['antivirus'];
                    $ket_ubah=$row['keterangan'];
                     $bmn_ubah=$row['bmn'];
                    $id_ubah=$row['id'];
                }
            }
            
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($hardware)) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label class="col-sm-4 control-label">Jenis</label></td>
                        <td colspan="2" >
                            <select class="form-control" name="jenis" >
                                <?php 
                                    foreach ($jenis as $row) {
                                        if(isset($hardware)){
                                            if($row['id']==$jenis_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmjenis']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmjenis']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmjenis']."</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label">Merk</label></td>
                        <td colspan="2" >
                            <select class="form-control" id="merk" name="merk">
                                <?php 
                                    foreach ($merk as $row) {
                                        if(isset($hardware)){
                                            if($row['id']==$merk_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmmerk']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmmerk']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmmerk']."</option>";
                                        } 
                                        
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Tipe</label></td>
                        <td><input class="form-control" type="text" id="tipe" name="tipe" class="text ui-widget-content ui-corner-all" value="<?php if(isset($hardware)) echo $tipe_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Nomor Seri</label></td>
                        <td><input class="form-control" type="text" id="sn" name="sn" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($hardware)) echo $sn_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Kode BMN</label></td>
                        <td><input class="form-control" type="text" id="bmn" name="bmn" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($hardware)) echo $bmn_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label">Sistem Operasi</label></td>
                        <td colspan="2" >
                            <select class="form-control" id="os" name="os">
                                <?php 
                                    foreach ($os as $row) {
                                        if(isset($hardware)){
                                            if($row['id']==$os_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmos']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmos']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmos']."</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">IP</label></td>
                        <td><input class="form-control" type="text" id="ip" name="ip" class="text ui-widget-content ui-corner-all" value="<?php if(isset($hardware)) echo $ip_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Prosesor</label></td>
                        <td><input class="form-control" type="text" id="prosesor" name="prosesor" class="text ui-widget-content ui-corner-all" value="<?php if(isset($hardware)) echo $prosesor_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Memori</label></td>
                        <td><input class="form-control" type="text" id="memori" name="memori" class="text ui-widget-content ui-corner-all" value="<?php if(isset($hardware)) echo $memori_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Harddisk</label></td>
                        <td><input class="form-control" type="text" id="hdd" name="hdd" class="text ui-widget-content ui-corner-all" value="<?php if(isset($hardware)) echo $hdd_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label">Kondisi</label></td>
                        <td colspan="2" >
                            <select class="form-control" id="kondisi" name="kondisi">
                                <?php 
                                    foreach ($kondisi as $row) {
                                        if(isset($hardware)){
                                            if($row['id']==$kondisi_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmkondisi']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmkondisi']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmkondisi']."</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label">Tahun Pengadaan</label></td>
                        <td colspan="2" >
                            <select class="form-control" id="tahun" name="tahun">
                                <?php 
                                    $year = date("Y") - 11; 
                                    for ($i = 0; $i <= 10; $i++) {
                                        $year++; 
                                        if(isset($hardware)){
                                            if($year==$tahun_ubah){
                                                echo "<option selected>$year</option>";
                                            }else{
                                                echo "<option>$year</option>";
                                            }
                                        }else{
                                            echo "<option>$year</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label">Antivirus</label></td>
                        <td colspan="2" >
                            <select class="form-control" id="antivirus" name="antivirus">
                                <?php 
                                    foreach ($antivirus as $row) {
                                        if(isset($hardware)){
                                            if($row['id']==$kondisi_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmstatus']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmstatus']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmstatus']."</option>";
                                        } 
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="col-sm-4 control-label" for="user">Keterangan</label></td>
                        <td><textarea class="form-control" row="3" id="ket" name="ket" class="text ui-widget-content ui-corner-all"><?php if(isset($hardware)) echo $ket_ubah;  ?></textarea></td>
                    </tr>
                    <tr>
                        <td><input class="btn btn-primary btn-label-left" type="submit" value="Simpan"/></td>
                        <td><input class="btn btn-warning btn-label-left" type="reset" value="Reset"/></td>
                    </tr>
                
                </table>
            <?php echo form_close(); ?>

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
                    echo "<p class=\"bg-success\">Message success</p>";
                    echo $message_display;
                    echo "</p>";
                }
                if (isset($error_message)) {
                    echo "<p class=\"bg-danger\">";
                    echo $error_message;
                    echo "</p>";
                }
                echo validation_errors();
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