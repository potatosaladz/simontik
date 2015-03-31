<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <span class="glyphicon glyphicon-tag"></span>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="#">Home</a></li>
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
                    <span>Pengumuman</span>
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

            <div class="box-content">
            	<table id="grid">
				    <tbody>
				                <?php
				                    if(isset($berita) && $berita!=null){
				                        foreach ($berita as $row) {
				                ?>
				                <tr>
				                    <td>
				                        <h2>
				                    <?php
				                                //echo $row['judul'];
				                    ?>
				                        </h2>
				                    </td>
				                </tr>
				                <tr>
				                    <td>
				                    <?php
				                                echo $row['isi'];
				                    ?>
				                    </td>
				                </tr>
				                <?php
				                        }
				                    }
				                ?>
				    </tbody>
				</table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
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
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                
					<table id="grid">
					<tbody>
					<?php
					if(isset($bio) && $bio!=null){
						foreach ($bio as $row) {
							echo "<tr>";
							echo "<th>";
							echo "Kantor : ";
							echo "</th>";
							echo "<td>";
							echo $row['kantor'];
							echo "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>";
							echo "Kanwil : ";
							echo "</th>";
							echo "<td>";
							echo $row['nmkanwil'];
							echo "</td>";
							echo "</tr>";
						}
					}
					?>
					</tbody>
					</table>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<span class="glyphicon glyphicon-search"></span>
					<span><h4 class="page-header">Monitoring</h4></span>
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
			<div class="box-content">
				
				<table id="grid" style="border:1px solid #D3D3D3;">
					<thead style="border:1px solid #D3D3D3;">
						<th style="border:1px solid #D3D3D3;">
							Jenis Perangkat
						</th>
						<th style="border:1px solid #D3D3D3;">
							Kondisi Perangkat
						</th>
						<th style="border:1px solid #D3D3D3;">
							Jumlah
						</th>
					</thead>
					<tbody style="border:1px solid #D3D3D3;">
					<?php
					if(isset($server) && $server!=null){
						foreach ($server as $row2) {
							echo "<tr style=\"border:1px solid #D3D3D3;\">";
							echo "<td>";
							echo $row2['jenis'];
							echo "</td>";
							echo "<td>";
							echo $row2['kondisi'];
							echo "</td>";
							echo "<td>";
							echo $row2['jml'];
							echo "</td>";
							echo "</tr>";
						}
					}
					if(isset($jaringan) && $jaringan!=null){
						foreach ($jaringan as $row3) {
							echo "<tr>";
							echo "<td>";
							echo $row3['jenis'];
							echo "</td>";
							echo "<td>";
							echo $row3['kondisi'];
							echo "</td>";
							echo "<td>";
							echo $row3['jml'];
							echo "</td>";
							echo "</tr>";
						}
					}
					if($jaringan==null && $server==null){
					?>
						<tr>
						<td colspan="3">Data Kosong
						</td>
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

