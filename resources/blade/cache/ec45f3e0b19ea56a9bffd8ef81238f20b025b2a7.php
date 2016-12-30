<!DOCTYPE html>
<head>
    <title><?php echo e(isset($meta['title']) ? $meta['title'] : '{missing:meta-title}'); ?></title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="<?php echo $__env->yieldContent('header-app-css', '/style/app.css'); ?>">

</head>
<body>
  <div class="container">
  <?php echo $__env->yieldContent('placeholder'); ?>
  </div>

  <script type="text/javascript" src="/javascript/jquery.min.js"></script>
  <script type="text/javascript" src="/javascript/app.min.js"></script>
  <?php echo $__env->yieldContent('lazyload'); ?>
</body>
