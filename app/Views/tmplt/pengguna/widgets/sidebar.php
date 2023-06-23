  <!-- Sidebar -->
  <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion"  id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon ">
    <img src="<?=base_url('assets/img/logomotorcuy.png')?>" width="80" height="80"  alt=""></img>
    </div>
    <div class="sidebar-brand-text mx-3 text-light">Reservasi Bengkel</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=base_url('pengguna/dashboard')?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading text-light">
    Pengguna
</div>

<!-- Nav Item - Pages Collapse Menu -->


<!-- Divider -->

<!-- Nav Item - Utilities Collapse Menu -->

<!-- Divider -->

<!-- Heading -->
<div class="sidebar-heading">
    
</div>

<!-- Nav Item - Pages Collapse Menu -->



<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?=site_url('pengguna/datareservasi')?>">
        <i class="fas fa-fw fa-bell"></i>
        <span class="text-light">Reservasi Saya</span></a>
</li>

<!-- Nav Item - Tables -->


<li class="nav-item">
    <a class="nav-link" href="<?=site_url('pengguna/registhsv')?>">
        <i class="fas fa-fw fa-table"></i>
        <span class="text-light">List Bengkel</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?=site_url('pengguna/reservasihsv')?>">
        <i class="fas fa-fw fa-table"></i>
        <span class="text-light">Reservasi HomeService Saya</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->