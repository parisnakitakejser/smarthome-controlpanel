<?php $__env->startSection('placeholder'); ?>

<h1 class="display-1 hidden-xs-down">Sensors</h1>
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
        <th style="width: 60px;">Battery</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $sensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sensor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <tr>
        <td><?php if($sensor['modelid'] != ''): ?> <img src="/images/philips-hue/<?php echo e($sensor['modelid']); ?>" class="img-responsive" /> <?php endif; ?></td>
        <td><?php echo e($sensor['title']); ?></td>
        <td>-</td>
        <td>-</td>
        <td style="text-align: right;"><?php echo e($sensor['updated_at']); ?></td>
        <td style="text-align: center;">
          <i class="fa fa-<?php echo e($sensor['battery']['icon']); ?> <?php echo e($sensor['battery']['class']); ?>" title="<?php echo e($sensor['battery']['procent']); ?>%" data-toggle="tooltip"></i>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>