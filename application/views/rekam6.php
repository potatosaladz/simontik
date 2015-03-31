<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Pengaturan</a></li>
            <li><a href="#">Rekam Penanda Tangan</a></li>
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
                    <span>Rekam Penanda Tangan</span>
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
				//print_r($rekam."  ".$update);
                /* if(isset($rekam) && $rekam==1 && $update==false){
                    echo form_open('pengaturan/ttdsimpan');
                }
                if (isset($update) && $update==1 && $rekam==false){ */
                    echo form_open('pengaturan/ttdupdate');
                //
                

                if(isset($ttd) && $ttd!=null){
                     foreach ($ttd as $row2) {
                         $nip_ubah=$row2['nip'];
                         $nama_ubah=$row2['nama'];
                         $jabatan_ubah=$row2['jabatan'];
                         $id_ubah=$row2['id'];
                     }
                }
            
            ?>
                <input type="hidden" id="id" name="id" value="<?php if(isset($ttd) && $ttd!=null) echo $id_ubah;  ?>">
                <table id="tbl" align="center">
                    <tr>
                        <td><label for="user">Nama</label></td>
                        <td><input type="text" id="nama" name="nama" class="text ui-widget-content ui-corner-all" value="<?php if(isset($ttd) && $ttd!=null) echo $nama_ubah;  ?>"/></td>                        
                    </tr>
                    <tr>
                        <td><label for="user">NIP</label></td>
                        <td><input type="text" id="nip" name="nip" class="text ui-widget-content ui-corner-all" value="<?php if(isset($ttd) && $ttd!=null) echo $nip_ubah;  ?>"/></td>                        
                    </tr>
                    <tr>
                        <td><label for="user">Jabatan</label></td>
                        <td><input type="text" id="jabatan" name="jabatan" class="text ui-widget-content ui-corner-all" value="<?php if(isset($ttd) && $ttd!=null) echo $jabatan_ubah;  ?>"/></td>                        
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
                echo validation_errors();
                ?>
            </div>
        </div>
    </div>
</div>
