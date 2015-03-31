<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Laporan</a></li>
            <li><a href="#">Cetak</a></li>
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
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-hdd"></span>
                    <span>Data Hardware</span>
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
                            <th>ID</th>
                            <th>UNIT</th>
                            <th>MERK</th>
                            <?php echo "<th>JENIS PRINTER</th>"; ?>
                            <th>TIPE</th>
                            <th>SERIAL NUMBER</th>
                            <?php   echo "<th>SISTEM OPERASI</th>"; ?>
                            <th>TAHUN</th>
                            <?php  echo "<th>IP</th>"; ?>
                            <?php   echo "<th>PROSESOR</th>"; ?>
                            <?php  echo "<th>RAM</th>"; ?>
                            <?php  echo "<th>HDD</th>"; ?>
                            <th>KONDISI</th>
            				<?php  echo "<th>ANTIVIRUS</th>"; ?>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>

               <?php
                    if(isset($hasil) && $hasil!=null){
                        if(sizeof($hasil)>0){
                            foreach ($hasil as $row)
                            {
                                $id=$row['id'];
                                echo "<tr>";
                                echo "<td>".$row['id_hardware']."</td>";
                                echo "<td>".$row['kantor']."</td>";
                                echo "<td>".$row['nmmerk']."</td>";
                                if(isset($row['nmprinter']) && $row['nmprinter']!=null) echo "<td>".$row['nmprinter']."</td>";
                                echo "<td>".$row['tipe']."</td>";
                                echo "<td>".$row['sn']."</td>";
                                echo "<td>".$row['nmos']."</td>";
                                echo "<td>".$row['tahun']."</td>";
                                echo "<td>".$row['ip']."</td>";
                                echo "<td>".$row['prosesor']."</td>";
                                echo "<td>".$row['memori']."</td>";
                                echo "<td>".$row['hdd'];
                                echo "<td>".$row['nmkondisi']."</td>";
                                echo "<td>".$row['nmstatus']."</td>";
                                echo "<td>".$row['keterangan']."</td>";
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
    <?php

//}else{
	?>

    <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <span class="glyphicon glyphicon-hdd"></span>
                    <span>Data Jaringan</span>
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
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-2">
			        <thead>
			            <tr>
			                <th>UNIT</th>
			                <th>MERK</th>
			                <th>TIPE</th>
			                <th>PORT</th>
			                <th>IP</th>
			                <th>SERIAL NUMBER</th>
			                <th>TAHUN</th>
			                <th>KONDISI</th>
			                <th>KETERANGAN</th>
			            </tr>
			        </thead>
			        <tbody>

			               <?php
			                    if(isset($jar) && $jar!=null){
			                        if(sizeof($jar)>0){
			                            foreach ($jar as $row)
			                            {
			                                $id=$row['id'];
			                                echo "<tr>";
			                                echo "<td>".$row['kantor']."</td>";
			                                echo "<td>".$row['nmmerk']."</td>";
			                                echo "<td>".$row['tipe']."</td>";
			                                echo "<td>".$row['port']."</td>";
			                                echo "<td>".$row['ip']."</td>";
			                                echo "<td>".$row['sn']."</td>";
			                                echo "<td>".$row['tahun']."</td>";
			                                echo "<td>".$row['nmkondisi']."</td>";
			                                echo "<td>".$row['keterangan']."</td>";
			                                echo "</tr>";
			                            }
			                        }else{
			                ?>
			                        <tr>
			                            <td colspan="18">Data Kosong</td>
			                        </tr>
			                <?php           
			                        }
			                    }else{
			                ?>
			                        <tr>
			                            <td colspan="18">Data Kosong</td>
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
<?php   

    echo form_open('laporan/cetakLaporan2');
    if(isset($filter) && $filter!=null){
        $filter_cetak=$filter;
        $kosong='enabled';
    }else{
        $filter_cetak=0;
        $kosong='disabled';
    }
    if(isset($filter_isi) && $filter_isi!=null){
        $id_cetak=$filter_isi;
    }else{
        $id_cetak=0;
    }
?>
    <select name="opsi">
        <!-- <option value=1 selected>PDF</option> -->
        <option value=2>Excel</option>
    </select>
    <input type="hidden" id="parameter" name="parameter" value="<?php echo $filter_cetak; ?>"/>
    <input type="hidden" id="parameter_id" name="parameter_id" value="<?php echo $id_cetak; ?>"/>
    <input type="submit" value="cetak" <?php echo $kosong; ?>/>
<?php
    echo form_close();
?>
