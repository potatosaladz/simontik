<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Pengaturan</a></li>
            <li><a href="#">Rekam Merk</a></li>
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
                    <span>Rekam Merk</span>
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
                    echo form_open('merk/simpan');
                }
                if (isset($update) && $update==true && $rekam==false){
                    echo form_open('merk/update');
                }
                

                if(isset($merk) && $merk!=null){
                     foreach ($merk as $row2) {
                         $merk_ubah=$row2['nmmerk'];
                         //$isi_ubah=$row2['isi'];
                         $id_ubah=$row2['id'];
                     }
                }
            
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($merk) && $merk!=null) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label for="user">Merk</label></td>
                        <td><input type="text" id="merk" name="merk" class="text ui-widget-content ui-corner-all" value="<?php if(isset($merk) && $merk!=null) echo $merk_ubah;  ?>"/></td>                        
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
</script>
