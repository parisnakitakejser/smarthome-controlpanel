<?php $__env->startSection('placeholder'); ?>
<label>Room name</label>
<input type="text" value="" id="room-title" class="form-control" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>