<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Jaringan</a></li>
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
                    <span>Rekam Jaringan</span>
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
                if(isset($jaringan)){
                    echo form_open('jaringan/update');
                }else{
                    echo form_open('jaringan/simpan');
                }
                 
            if(isset($jaringan)){
                foreach ($jaringan as $row) {
                    $jenis_ubah=$row['jenis'];
                    $merk_ubah=$row['merk'];
                    $tipe_ubah=$row['tipe'];
                    $sn_ubah=$row['sn'];
                    $kondisi_ubah=$row['kondisi'];
                    $tahun_ubah=$row['tahun'];
                    $ket_ubah=$row['keterangan'];
                    $port_ubah=$row['port'];
                    $ip_ubah=$row['ip'];
                    $bmn_ubah=$row['bmn'];
                    $id_ubah=$row['id'];
                }
            }
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($jaringan)) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label>Jenis</label></td>
                        <td colspan="2" >
                            <select name="jenis">
                                <?php 
                                    foreach ($jenis as $row) {
                                        if(isset($jaringan)){
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
                        <td><label>Merk</label></td>
                        <td colspan="2" >
                            <select id="merk" name="merk">
                                <?php 
                                    foreach ($merk as $row) {
                                        if(isset($jaringan)){
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
                        <td><label for="user">Tipe</label></td>
                        <td><input type="text" id="tipe" name="tipe" class="text ui-widget-content ui-corner-all" value="<?php if(isset($jaringan)) echo $tipe_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">Nomor Seri</label></td>
                        <td><input type="text" id="sn" name="sn" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($jaringan)) echo $sn_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">Kode BMN</label></td>
                        <td><input type="text" id="bmn" name="bmn" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($jaringan)) echo $bmn_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">Jumlah Port</label></td>
                        <td><input type="text" id="port" name="port" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($jaringan)) echo $port_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">IP</label></td>
                        <td><input type="text" id="ip" name="ip" class="text ui-widget-content ui-corner-all"/ value="<?php if(isset($jaringan)) echo $ip_ubah;  ?>"></td>
                        
                    </tr>
                    <tr>
                        <td><label>Kondisi</label></td>
                        <td colspan="2" >
                            <select id="kondisi" name="kondisi">
                                <?php 
                                    foreach ($kondisi as $row) {
                                        if(isset($jaringan)){
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
                        <td><label>Tahun Pengadaan</label></td>
                        <td colspan="2" >
                            <select id="tahun" name="tahun">
                                <?php 
                                    $year = date("Y") - 11; 
                                    for ($i = 0; $i <= 10; $i++) {
                                        $year++; 
                                        if(isset($jaringan)){
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
                        <td><label for="user">Keterangan</label></td>
                        <td><textarea row="3" id="ket" name="ket" class="text ui-widget-content ui-corner-all" ><?php if(isset($jaringan)) echo $ket_ubah;  ?></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Simpan"/></td>
                        <td><input type="reset" value="Reset"/></td>
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