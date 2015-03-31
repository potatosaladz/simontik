<html>
    <head>
        <title>Aplikasi Inventarisasi Perangkat TIK</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/menu.css" />
        <link rel="stylesheet" href="<?=base_url()?>public/css/themes/start/jquery-ui.css" />
        <script type="text/javascript" src="<?=base_url()?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/js/pdfobject.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/js/jquery.flot.js"></script>
        <script type="text/javascript" src="<?=base_url()?>public/js/jquery.flot.pie.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="head">
                <div id="stat">
                    <div id="tgl"></div>
                    <div id="isi_stat"><a href="#" ><?php if(isset($kantor)){ echo $kantor;}  ?><img src="<?=base_url()?>public/img/profil.png"/> <span id="profil"></span> </a> <!-- | <span id="akses"></span> --> |
                        <a id='logout' href="<?php echo site_url('login/logout'); ?>" ><img src="<?=base_url()?>public/img/logout.png"/> Logout</a></div>
                </div>
                <div id="header">
                    <div id="logo"><a href="#" ><img src="<?=base_url()?>public/img/logo-small.png"/></a></div>
                    <div id="menu">
                        <ul id="menu_parent">
                            <li class="pressed topfirst topmenu"><a href="<?php echo site_url('monitoring'); ?>"><img src="<?=base_url()?>public/img/home.png"/> Home</a></li>
                            <li class="topmenu"><a  id="link_menu"  ><span><img src="<?=base_url()?>public/img/rekon.png"/> Perangkat TIK</span></a>
                                <ul>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/1'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Server</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/2'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> PC</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/3'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Notebook</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/6'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Printer</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/7'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Proyektor</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('server/show/8'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Scanner</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('jaringan/show/4'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Router</a></li>
                                    <li class="topfirst topmenu" id="server"><a href="<?php echo site_url('jaringan/show/5'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Switch</a></li>
                                    <li class="toplast topmenu" id="server"><a href="<?php echo site_url('jaringan/show/9'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Modem</a></li>
                                    <li class="toplast topmenu" id="server"><a href="<?php echo site_url('server/show/10'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Lainnya</a></li>
                                </ul>
                            </li>
                            <li class="topmenu" id="satker"><a ><span><img src="<?=base_url()?>public/img/laporan.png"/> Laporan</span></a>
                                <ul>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('laporan/show/1'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Per Jenis</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('laporan/show/2'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Per Tahun</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('laporan/show/3'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Per KPPN</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('laporan/show/4'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Per Kanwil</a></li>
                                    <li class="toplast topmenu"><a href="<?php echo site_url('laporan/show/5'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Per Kondisi</a></li>
                                    <li class="toplast topmenu"><a href="<?php echo site_url('laporan/show/6'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Summary</a></li>
                                </ul>
                            </li> 
                            <li class="topmenu"><a  id="link_menu"  ><span><img src="<?=base_url()?>public/img/rekon.png"/>Help Desk</span></a>
                                <ul>
                                    <li class="topfirst topmenu" id="tiket"><a href="<?php echo site_url('tiket/show'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/>Bantuan</a></li>
                                    <!-- <li class="toplast topmenu" id="lapj"><a href="lapj" ><img src="img/doc.png"/> Laporan</a></li> -->
                                </ul>
                            </li>
                            <li class="topmenu" id="satker"><a ><span><img src="<?=base_url()?>public/img/laporan.png"/> Pengaturan</span></a>
                                <ul>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('pengaturan'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Rekam User</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('pengaturan/ubah'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Ubah Password</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('pengaturan/ttd'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Rekam Penandatangan</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('pengaturan/ubahttd'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/> Ubah Penandatangan</a></li>
                                    <li class="topfirst topmenu"><a href="<?php echo site_url('berita/show/1'); ?>" ><img src="<?=base_url()?>public/img/doc.png"/>Pengumuman</a></li>
                                </ul>
                            </li> 
                            <!--<li class="topmenu"><a href="" ><span><img src="img/tools.png"/> Pengaturan</span></a>
                                <ul>
                                    <li class="topfirst toplast topmenu"><a href="ubah" ><img src="img/doc.png"/> Ubah Password</a></li>
                                 
                                </ul>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div id="content">
                <div id="clear"></div>   
                <div id="isinya">