<?php $__env->startSection('header-app-css'); ?>
/style/app-login.css
<?php $__env->stopSection(); ?>

<?php $__env->startSection('placeholder'); ?>
<div class="login-container">
  <div id="dialogToolbar"></div>

  <div class="avatar"></div>
  <div class="form-box">
    <form action="" method="">
      <input id="username" type="text" placeholder="username">
      <input type="password" id="password" placeholder="password">
      <button class="btn btn-info btn-block login" id="login-btn" type="button" onclick="$.users.push.login()">Login</button>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout-login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>