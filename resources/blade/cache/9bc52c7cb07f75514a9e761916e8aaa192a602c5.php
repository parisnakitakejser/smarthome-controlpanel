<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="modalDialogTitle"><?php echo e($modal['title']); ?></h4>
  </div>
  <div id="modalContent">
    <div class="modal-body">
      <?php echo $__env->yieldContent('placeholder'); ?>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-primary" onclick="<?php echo e($modal['btn']['onclick']); ?>"><?php echo e($modal['btn']['title']); ?></button>
  </div>
</div>
