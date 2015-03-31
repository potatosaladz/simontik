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
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Help Desk</a></li>
            <li><a href="#">Tiket</a></li>
            <li><a href="#">Detail</a></li>
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
    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-search"></span>
                    <span>Detail Tiket</span>
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

<div id="loading_dialog"></div>
<div id="div_grid">
<!--    <input type="text" id="cari" placeHolder="Cari Satker"/>-->
<div class='message'>
    <?php
        if (isset($message_display)) {
            echo $message_display;
        }
        if (isset($error_message)) {
            echo $error_message;
        }
    ?>
</div>
    <table id="grid" >
        <tbody>
            </thead>
                <?php
                    if(isset($tiket) && $tiket!=null){
                        if(sizeof($tiket)>0){
                            foreach ($tiket as $row)
                            {
							$id_tiket=$row['id'];
                ?>
                                 <tr>
                                    <th data-options="field:'id',width:80">ID TIKET</th>
                                    <td><?php echo $row['nomor'];  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'jenis',width:80">JENIS</th>
                                    <td><?php echo $row['nmjenis'];  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'subject',width:250" sortable="true">SUBJECT</th>
                                    <td><?php echo $row['subject'];  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'unit',width:150" sortable="true">UNIT</th>
                                    <td><?php echo $row['kantor'];  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'nama',width:120" sortable="true">PENGIRIM</th>
                                    <td><?php echo $row['nama']." (telp :".$row['telp']." )";  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'status',width:150" sortable="true">STATUS</th>
                                    <td><?php echo $row['nmstatus'];  ?></td>
                                </tr>
                                <?php
                                    if(isset($admin) && $admin==true){
                                ?>
                                <tr>
                                    <th>Ubah Status</th>
                                    <?php
                                        echo form_open('tiket/setstatus');
                                        //$id_tiket=$row['id'];
                                    ?>
                                        <input type="hidden" id="id" name="id" value="<?php echo $row['id'];  ?>">
                                        <td>
                                            <select id="status" name="status">
                                                <?php 
                                                    if(isset($status)){
                                                        foreach ($status as $row2) {
                                                            echo "<option value=".$row2['id']." >".$row2['nmstatus']."</option>";
                                                        }
                                                    }else{
                                                        echo "<option >Status Belum Di Rekam</option>";
                                                    }                                                          
                                                ?>
                                            </select>
                                        <input type="submit" value="Simpan"/></td>
                                    <?php
                                        echo form_close();
                                    ?>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <th data-options="field:'detail',width:150" sortable="true">DETAIL</th>
                                    <td><?php echo $row['detail'];  ?></td>
                                </tr>
                                <tr>
                                    <th data-options="field:'tindakan',width:150" sortable="true">TINDAKAN</th>
                                    <td><?php echo $row['tindakan'];  ?></td>
                                </tr>
                                <thead>
                                    <tr>
                                        <th colspan="2">PIC</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                </tr>
                                <?php 
                                    if(isset($pic_tiket) && $pic_tiket!=null){
                                        foreach ($pic_tiket as $row4) {
                                            echo "<tr>";
                                            echo "<td>".$row4['nama']."</td>";

                                            echo "<td>".$row4['nip'];
                                            if(isset($admin) && $admin==true){
                                                echo "<a href=\"". site_url("tiket/removepic/".$row['id']."/".$row4['id'])."\" style=\"text-decoration:none;\" id=\"btn_ubah\">Hapus";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }else{      
                                ?>
                                <tr>
                                    <td colspan="2">PIC Belum Di Assign</td>
                                </tr>   
                                <?php
                                    }
                                    if(isset($admin) && $admin==true){
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="2">Assign PIC</th>
                                </tr> 
                                </thead>
                                <tr>
                                    <?php
                                        echo form_open('tiket/setpic');
                                    ?>
                                        <input type="hidden" id="id" name="id" value="<?php echo $row['id'];  ?>">
                                        <td>
                                            <select id="pic" name="pic">
                                                <?php 
                                                    if(isset($pic)){
                                                        $i=0;
                                                        foreach ($pic as $row3) {
                                                            if(isset($pic_tiket) && $pic_tiket!=null){
                                                                foreach ($pic_tiket as $row5) {
                                                                    if($row3['id']===$row5['id_pic']){
                                                                        echo "<option value=".$row3['id'].">".$row3['nama']." ->Sudah Di Assign </option>";
                                                                    }
                                                                    else{
                                                                        echo "<option value=".$row3['id'].">".$row3['nama']."</option>";
                                                                    }
                                                                }
                                                            }else{
                                                                echo "<option value=".$row3['id'].">".$row3['nama']."</option>";
                                                            }
                                                        }
                                                    }else{
                                                        echo "<option >PIC Belum Di Rekam</option>";
                                                    }                                                          
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="submit" value="Simpan"/></td>
                                    <?php
                                        echo form_close();
                                    ?>
                                </tr>
                                <?php
                                    }
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="2">File-file terkait</th>
                                </tr>
                                </thead>
                                <?php 
                                    if(isset($file_uploaded) && $file_uploaded!=null){
                                        foreach ($file_uploaded as $row6) {
                                            echo "<tr>";
                                            echo "<td>".$row6['nmfile']."</td>";
                                            echo "<td>".$row6['nmawal']."  <a href=\"". site_url("tiket/download/".$row['id']."/".$row6['id'])."\" style=\"text-decoration:none;\" id=\"btn_ubah\">Download</a>";
                                            if($row6['admin']==true || $admin==true){
                                                echo " || <a href=\"". site_url("tiket/hapus/".$row['id']."/".$row6['id'])."\" style=\"text-decoration:none;\" id=\"btn_ubah\">Hapus</a>";
                                            }
											
                                            if($row6['admin']==false && $admin==false){
                                                echo " || <a href=\"". site_url("tiket/hapus/".$row['id']."/".$row6['id'])."\" style=\"text-decoration:none;\" id=\"btn_ubah\">Hapus</a>";
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }else{      
                                ?>
                                <tr>
                                    <td colspan="2">Belum Ada File</td>
                                </tr>   
                                <?php
                                    }
                                ?>
                                <thead>
                                <tr>
                                    <th colspan="2">Upload File</th>
                                </tr>
                                </thead>
                <?php
                                echo form_open_multipart('tiket/upload');
                ?>
                                <input type="hidden" id="id" name="id" value="<?php echo $row['id'];  ?>">
                                <tr>
                                    <th><label for="user">Nama File</label></td>
                                    <td><input type="text" id="nama_file" name="nama_file" class="text ui-widget-content ui-corner-all" /></th>
                                    
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <input type="file" name="userfile" size="20" />
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <input type="submit" value="upload" />
                                    </th>
                                </tr>
                <?php
                                echo form_close();
                            }
                        }else{
                ?>
                        <tr>
                            <td colspan="8">Data Kosong</td>
                        </tr>
                <?php           
                        }
                    }else{
                ?>
                        <tr>
                            <td colspan="8">Data Kosong</td>
                        </tr>
                <?php
                    }
               ?>
        </tbody>
    </table>
    <?php
        if (isset($message) && $message!=null){
            echo "<div class='message'>";
            echo $message;
            echo "</div>";
        }
        echo validation_errors();
    ?>
<!--    <a id="prev" href="">Prev</a>|<span id="hal"></span>|<a id="next" href="">Next</a>-->

</div>

</div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-search"></span>
                    <span>Diskusi</span>
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
<div id="div_chat">
<?php
    echo form_open('tiket/chat');
?>
        <input type="hidden" name="id_tiket" value="<?php echo $id_tiket; ?>" />
        <textarea name="chat" rows="4"></textarea>
        <input type="submit" value="Kirim">
<?php
    echo form_close();
?>
<table id="grid">
    <thead>
        <th>Pengirim</th>
        <th>Isi</th>
        <th>Tanggal Post</th>
    </thead>
    <tbody>
        <?php
            if(isset($chat) && $chat!=null){
                foreach ($chat as $rowchat) {
        ?>
                    <tr>
                        <td><?php echo $rowchat['username'];  ?></td>
                        <td><?php echo $rowchat['isi'];  ?></td>
                        <td><?php echo $rowchat['date_created'];  ?></td>
                    </tr>
        <?php
                }
            }else{
        ?>
            <tr>
            <td colspan="2">Kosong</td>
            </tr>
        <?php        
            }
        ?>
    </tbody>
</table>
</div>
            </div>
        </div>
    </div>
</div>
