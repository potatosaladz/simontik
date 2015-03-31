<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Pengaturan</a></li>
            <li><a href="#">Merk</a></li>
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

<a type="button" class="btn btn-primary" href="<?php  echo site_url("merk/rekam");?>" style="text-decoration:none;" id="btn_rekam">Rekam</a>

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
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-hdd"></span>
                    <span>Data Merk</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </a>
                    <a class="expand-link">
                        <span class="glyphicon glyphicon-expand"></span>
                    </a>
                    <a class="close-link">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
        <thead>
            <tr>
                <th>UBAH</th>
                <th>HAPUS</th>
                <th>Merk</th>
                
            </tr>
        </thead>
        <tbody>

               <?php
                    if(isset($merk) && $merk!=null){
                        if(sizeof($merk)>0){
                            foreach ($merk as $row)
                            {
                                $id=$row['id'];
                                echo "<tr>";
                                echo "<td align=\"center\"><a href=\"". site_url("merk/ubah/".$id)."\" style=\"text-decoration:none;\" id=\"btn_ubah\"><span class=\"glyphicon glyphicon-edit\"></span></a></td>";
                                echo "<td align=\"center\"><a href=\"". site_url("merk/hapus/".$id)."\" style=\"text-decoration:none;\" id=\"btn_hapus\"><span class=\"glyphicon glyphicon-floppy-remove\"></span></a></td>";
                                echo "<td>".$row['nmmerk']."</td>";
                                //echo "<td>".$row['date_created']."</td>";
                                echo "</tr>";
                            }
                        }else{
                ?>
                        <tr>
                            <td >Data Kosong</td>
                        </tr>
                <?php           
                        }
                    }else{
                ?>
                        <tr>
                            <td >Data Kosong</td>
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
<!--    <a id="prev" href="">Prev</a>|<span id="hal"></span>|<a id="next" href="">Next</a>-->




    </div>


  


