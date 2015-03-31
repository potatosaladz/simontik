

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

    <fieldset>
            <?php 
                $attributes = array('class' => 'frm_rekam', 'id' => 'frm_rekam'); 
                if(isset($tiket)){
                    echo form_open('tiket/update');
                }else{
                    echo form_open('tiket/simpan');
                }
                 
            if(isset($tiket)){
                foreach ($tiket as $row) {
                    $jenis_ubah=$row['jenis'];
                    $nama_ubah=$row['nama'];
                    $nip_ubah=$row['nip'];
                    $telp_ubah=$row['telp'];
                    $sifat_ubah=$row['sifat'];
                    $subject_ubah=$row['subject'];
                    $detail_ubah=$row['detail'];
                    $tindakan_ubah=$row['tindakan'];
                    $id_ubah=$row['id'];
                }
            }
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($tiket)) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label>Jenis Hardware</label></td>
                        <td colspan="2" >
                            <select name="jenis">
                                <?php 
                                    foreach ($jenis as $row) {
                                        if(isset($tiket)){
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
                        <td><label for="user">Nama</label></td>
                        <td><input type="text" id="nama" name="nama" class="text ui-widget-content ui-corner-all" value="<?php if(isset($tiket)) echo $nama_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">NIP</label></td>
                        <td><input type="text" id="nip" name="nip" class="text ui-widget-content ui-corner-all" value="<?php if(isset($tiket)) echo $nip_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label for="user">Telepon</label></td>
                        <td><input type="text" id="telp" name="telp" class="text ui-widget-content ui-corner-all" value="<?php if(isset($tiket)) echo $telp_ubah;  ?>"/></td>
                        
                    </tr>
                    <tr>
                        <td><label>Sifat Permasalahan</label></td>
                        <td colspan="2" >
                            <select id="sifat" name="sifat">
                                <?php 
                                    foreach ($sifat as $row) {
                                        if(isset($tiket)){
                                            if($row['id']==$sifat_ubah){
                                                echo "<option value=".$row['id']." selected>".$row['nmsifat']."</option>";
                                            }else{
                                                echo "<option value=".$row['id'].">".$row['nmsifat']."</option>";
                                            }
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['nmsifat']."</option>";
                                        } 
                                        
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="user">Subject Bantuan</label></td>
                        <td><input type="text" id="subject" name="subject" class="text ui-widget-content ui-corner-all" /><?php if(isset($tiket)) echo $subject_ubah;  ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="user">Detail Permasalahan</label></td>
                        <td><textarea row="10" id="detail" name="detail" class="text ui-widget-content ui-corner-all" value="<?php if(isset($tiket)) echo $detail_ubah;  ?>" /></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="user">Tindakan Yang Sudah Dilakukan</label></td>
                        <td><textarea row="10" id="tindakan" name="tindakan" class="text ui-widget-content ui-corner-all" ><?php if(isset($tiket)) echo $tindakan_ubah;  ?></textarea></td>
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

<script type="text/javascript" src="<?=base_url()?>public/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/tinymce/js/tinymce/tinymce.dev.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/tinymce/js/tinymce/plugins/table/plugin.dev.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/tinymce/js/tinymce/plugins/paste/plugin.dev.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>

<script>
    tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "save table contextmenu directionality emoticons template paste textcolor importcss colorpicker textpattern"
    ],
    external_plugins: {
    //"moxiemanager": "/moxiemanager-php/plugin.js"
    },
    content_css: "css/development.css",
    add_unload_trigger: false,
    menubar : false,
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor table",
    image_advtab: true,
    style_formats: [
    {title: 'Bold text', format: 'h1'},
    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
    {title: 'Example 1', inline: 'span', classes: 'example1'},
    {title: 'Example 2', inline: 'span', classes: 'example2'},
    {title: 'Table styles'},
    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    template_replace_values : {
    username : "Jack Black"
    },
    template_preview_replace_values : {
    username : "Preview user name"
    },
    link_class_list: [
    {title: 'Example 1', value: 'example1'},
    {title: 'Example 2', value: 'example2'}
    ],
    image_class_list: [
    {title: 'Example 1', value: 'example1'},
    {title: 'Example 2', value: 'example2'}
    ],
    templates: [
    {title: 'Some title 1', description: 'Some desc 1', content: '<strong class="red">My content: {$username}</strong>'},
    {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
    ],
    setup: function(ed) {
    /*ed.on(
    'Init PreInit PostRender PreProcess PostProcess BeforeExecCommand ExecCommand Activate Deactivate ' +
    'NodeChange SetAttrib Load Save BeforeSetContent SetContent BeforeGetContent GetContent Remove Show Hide' +
    'Change Undo Redo AddUndo BeforeAddUndo', function(e) {
    console.log(e.type, e);
    });*/
    },
    spellchecker_callback: function(method, data, success) {
    if (method == "spellcheck") {
    var words = data.match(this.getWordCharPattern());
    var suggestions = {};
    for (var i = 0; i < words.length; i++) {
    suggestions[words[i]] = ["First", "second"];
    }
    success({words: suggestions, dictionary: true});
    }
    if (method == "addToDictionary") {
    success();
    }
    }
    });


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