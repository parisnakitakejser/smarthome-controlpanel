<?php $__env->startSection('placeholder'); ?>

<h1 class="display-1 hidden-xs-down">Room: <small><?php echo e($room['title']); ?></small></h1>
<hr />
Room settings will be view in this area.
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>