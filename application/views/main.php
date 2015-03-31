<?php
// if(!isset($_SESSION['logged_in'])){
//     $this->redirect('login/user_login_show');
// }
?>
<html>
    <head>
        <title>Aplikasi Inventarisasi Perangkat TIK</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/menu.css" />
        <link rel="stylesheet" href="<?=base_url()?>public/css/themes/start/jquery-ui.css" />
        <script type="text/javascript" src="<?=base_url()?>../public/js/jquery.js"></script>
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
                    <div id="isi_stat"><a href="#" ><?php if(isset($unit)){echo $unit;} else { echo "Tidak Ada";}  ?><img src="<?=base_url()?>public/img/profil.png"/> <span id="profil"></span> </a> <!-- | <span id="akses"></span> --> |
                        <a id='logout' href="<?=base_url()?>login/logout" ><img src="<?=base_url()?>public/img/logout.png"/> Logout</a></div>
                </div>
                <div id="header">
                    <div id="logo"><a href="#" ><img src="<?=base_url()?>public/img/logo-small.png"/></a></div>
                    <div id="menu">
                        <ul id="menu_parent">
                            <li class="pressed topfirst topmenu"><a href="monitoring" ><img src="<?=base_url()?>public/img/home.png"/> Home</a></li>
                            <li class="topmenu"><a  id="link_menu" href="" ><span><img src="<?=base_url()?>public/img/rekon.png"/> Hardware</span></a>
                                <ul>
                                    <li class="topfirst topmenu" id="server"><a href="server" ><img src="<?=base_url()?>public/img/doc.png"/> Hardware</a></li>
                                    <li class="toplast topmenu" id="laph"><a href="laph" ><img src="<?=base_url()?>public/img/doc.png"/> Laporan</a></li>
                                </ul>
                            </li>
                            <li class="topmenu"><a  id="link_menu" href="" ><span><img src="<?=base_url()?>public/img/rekon.png"/>Jaringan</span></a>
                                <ul>
                                    <li class="topfirst topmenu" id="jaringan"><a href="jaringan" ><img src="<?=base_url()?>public/img/doc.png"/> Status Migrasi</a></li>
                                    <!--<li class="toplast topmenu" id="lapj"><a href="lapj" ><img src="img/doc.png"/>--> Laporan</a></li>
                                </ul>
                            </li>
                            <!-- <li class="topmenu" id="satker"><a href="" ><span><img src="img/laporan.png"/> Laporan</span></a>
                                <ul>
                                    <li class="topfirst topmenu"><a href="bar" ><img src="img/doc.png"/> BAR</a></li>
                                    <li class="toplast topmenu"><a href="lampiran" ><img src="img/doc.png"/> Lampiran BAR</a></li>
                                </ul>
                            </li> -->
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
                           
                </div>
            </div>
            <div id="footer">
                <div id="copyright">Copyright 2013 by Eko Sigit Purnomo</div>
            </div>
        </div>
    </body>
</html>