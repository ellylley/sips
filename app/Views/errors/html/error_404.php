<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $setting ->nama_setting?></title> 
    
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.css')?>"></script>
    
    <link rel="stylesheet" href="<?= base_url('vendors/chartjs/Chart.min.css')?>"></script>

    <link rel="stylesheet" href="<?= base_url('vendors/perfect-scrollbar/perfect-scrollbar.css')?>"></script>
    <link rel="stylesheet" href="<?= base_url('css/app.css')?>"></script>
    <link rel="shortcut icon" href="<?= base_url('images/' . $setting->logo) ?>" type="image/x-icon">
</head>



<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
    <img src="<?php echo base_url('images/'.$setting->logo) ?>" style="width: 120px; height: auto; display: block; margin: 0 auto;">

    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            
                
                <li class='sidebar-title'>Main Menu</li>
                
            
                
                <li class="sidebar-item <?= ($currentMenu == 'dashboard') ? 'active' : '' ?>">

                    <a href="<?= base_url("home")?>" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>DASHBOARD</span>
                    </a>

                    
                </li>
                
            
                <?php
if(session()->get('level') == 1) 
{
?> 
                <li class="sidebar-item <?= ($currentMenu == 'user') ? 'active' : '' ?>">

                <a href="<?= base_url("home/user")?>" class='sidebar-link'>
                        <i data-feather="user" width="20"></i> 
                        <span>USER</span>
                    </a>

                    
                </li>
                
                <?php
    }else{

    }?> 

<?php
if(session()->get('level') == 1) 
{
?> 
                
                <li class="sidebar-item <?= ($currentMenu == 'kelas') ? 'active' : '' ?>">

                <a href="<?= base_url("home/kelas")?>" class='sidebar-link'>
                        <i data-feather="grid" width="20"></i> 
                        <span>KELAS</span>
                    </a>

                    </li>
                    <?php
    }else{

    }?> 

<?php
if(session()->get('level') == 1 || session()->get('level')==2|| session()->get('level')==3|| session()->get('level')==4|| session()->get('level')==5) 
{
?>
                    
               

                <li class="sidebar-item <?= ($currentMenu == 'pengumuman') ? 'active' : '' ?>">

                <a href="<?= base_url("home/pengumuman")?>" class='sidebar-link'>
                        <i data-feather="file-plus" width="20"></i> 
                        <span>PENGUMUMAN</span>
                    </a>
</li>

<?php
    }else{

    }?> 

<?php
if(session()->get('level') == 1 || session()->get('level')==2|| session()->get('level')==3|| session()->get('level')==4|| session()->get('level')==5|| session()->get('level')==6|| session()->get('level')==7) 
{
?>
                    
               

                <li class="sidebar-item <?= ($currentMenu == 'pemberitahuan') ? 'active' : '' ?>">

                <a href="<?= base_url("home/pemberitahuan")?>" class='sidebar-link'>
                        <i data-feather="clipboard" width="20"></i> 
                        <span>PEMBERITAHUAN</span>
                    </a>
</li>

<?php
    }else{

    }?> 

<?php
if(session()->get('level') == 1) 
{
?> 

<li class="sidebar-item <?= ($currentMenu == 'setting') ? 'active' : '' ?>">

<a href="<?= base_url("home/setting")?>" class='sidebar-link'>
    <i data-feather="settings" width="20"></i> 
    <span>SETTING</span>
</a>
   
    
</li>



<li class="sidebar-item <?= ($currentMenu == 'log') ? 'active' : '' ?>">

<a href="<?= base_url("home/log")?>" class='sidebar-link'>
                        <i data-feather="globe" width="20"></i> 
                        <span>ACTIVITY LOG</span>
                    </a>

    
   
    
</li>
                
            
                
                
                
<li class="sidebar-item has-sub <?= ($currentMenu == 'restore_user' || $currentMenu == 'restore_kelas' || $currentMenu == 'restore_pengumuman' ) ? 'active' : '' ?>">

                <a href="#" class='sidebar-link'>
        <i data-feather="trash" width="20"></i> 
        <span>RESTORE</span>
    </a>

                    
    <ul class="submenu ">
    
    <li>
        <a href="<?= base_url("home/restore_user")?>">RESTORE USER</a>
    </li> 


    
    <li>
        <a href="<?= base_url("home/restore_kelas")?>">RESTORE KELAS</a>
    </li>

    <li>
        <a href="<?= base_url("home/restore_pengumuman")?>">RESTORE PENGUMUMAN</a>
    </li>
    
    
</ul>
                    
                </li>
                
            
                
                <?php
    }else{

    }?> 
        
        </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        
                       
                    <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="<?= base_url("images/". session()->get('foto') )?>" alt="" srcset="">
                                </div>
                                 <div class="d-none d-md-block d-lg-inline-block">Hi, <?= session()->get('nama')?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?= base_url("home/profile/". session()->get('id') )?>"><i data-feather="user"></i>ACCOUNT</a>
                               
                              
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("home/logout")?>"><i data-feather="log-out"></i>LOGOUT</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            

           

            <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Found - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
    <div id="error">
        
<div class="container text-center pt-32">
    <h1 class='error-title'>404</h1>
    <p>we couldn't find the page you are looking for</p>
    <a href="<?= base_url("home")?>" class='btn btn-primary'>Go Home</a>
</div>

       
    </div>
</body>
</html>
           

			<footer>
                <div class="footer clearfix mb-0 text-muted">
                   
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url('js/feather-icons/feather.min.js')?>"></script>
    <script src="<?= base_url('vendors/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>
    <script src="<?= base_url('js/app.js')?>"></script>
    
    <script src="<?= base_url('vendors/chartjs/Chart.min.js')?>"></script>
    <script src="<?= base_url('vendors/apexcharts/apexcharts.min.js')?>"></script>
    <script src="<?= base_url('js/pages/dashboard.js')?>"></script>

    <script src="<?= base_url('js/main.js')?>"></script>
</body>
</html>
