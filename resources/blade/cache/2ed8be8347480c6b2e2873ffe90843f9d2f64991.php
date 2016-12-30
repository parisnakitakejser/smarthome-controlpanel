<?php $__env->startSection('placeholder'); ?>

<h1 class="display-1 hidden-xs-down">Rooms</h1>
<hr />
<a href="/rooms/create" class="btn btn-success" data-toggle="modal" data-target="#modalDialog">
  Create a room
</a>

<br />
<br />

<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th style="width: 70px;">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <tr>
        <td><a href="/rooms/view/<?php echo e($room['id']); ?>"><?php echo e($room['title']); ?></a></td>
        <td style="text-align: right;">
          <button class="btn btn-danger btn-sm" onclick="alert('Function not ready - sorry')">
            <i class="fa fa-trash-o"></i>
          </button>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>