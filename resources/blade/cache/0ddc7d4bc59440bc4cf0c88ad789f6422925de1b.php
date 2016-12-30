<?php $__env->startSection('placeholder'); ?>

<h1 class="display-1 hidden-xs-down">Lights</h1>
<hr />

<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width: 50px;">&nbsp;</th>
        <th>Title</th>
        <th>Brand & Model</th>
        <th>Room</th>
        <th style="width: 220px;">Accessed</th>
        <th style="width: 60px;">On/Off</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $lights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $light): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <tr>
        <td><img src="/images/philips-hue/<?php echo e($light['modelid']); ?>" class="img-responsive" /></td>
        <td><?php echo e($light['title']); ?></td>
        <td>-</td>
        <td>-</td>
        <td style="text-align: right;"><?php echo e($light['updated_at']); ?></td>
        <td style="text-align: center;"><i class="fa fa-2x fa-toggle-<?php echo e(($light['state_on'] ? 'on text-success' : 'off text-danger')); ?>" aria-hidden="true"></i></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>