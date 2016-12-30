<!DOCTYPE html>
<head>
    <title><?php echo e(isset($meta['title']) ? $meta['title'] : '{missing:meta-title}'); ?></title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo $__env->yieldContent('header-app-css', '/style/app.css'); ?>">

</head>
<body>

  <nav class="navbar navbar-fixed-top navbar-dark bg-primary">
     <button class="navbar-toggler hidden-sm-up pull-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
       ☰
     </button>
     <a class="navbar-brand" href="/">Smarthome - Controlpanel</a>
     <div class="collapse navbar-toggleable-xs" id="collapsingNavbar">
         <ul class="nav navbar-nav pull-right">
             <li class="nav-item active">
                 <a class="nav-link" href="/">Dashboard</a>
             </li>
         </ul>
     </div>
  </nav>

  <div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-item"><a class="nav-link" href="/rooms">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="/lights">Lights</a></li>
                <li class="nav-item"><a class="nav-link" href="/sensors">Sensors</a></li>
                <li class="nav-item"><a class="nav-link" href="/sockets">Sockets</a></li>
                <li class="nav-item"><a class="nav-link" href="/users">Users</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 main">
          <p class="hidden-md-up">
              <button type="button" class="btn btn-primary-outline btn-sm" data-toggle="offcanvas"><i class="fa fa-chevron-left"></i> Menu</button>
          </p>

          <?php echo $__env->yieldContent('placeholder'); ?>
        </div>
    </div>
  </div>

  <div class="modal fade" id="modalDialog">
  	<div class="modal-dialog" id="modalContent"></div>
  </div>

  <script type="text/javascript" src="/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="/javascript/app.min.js"></script>
  <?php echo $__env->yieldContent('lazyload'); ?>
</body>
