<?php $__env->startSection("content"); ?>
<?php if($edit): ?>
<form role="form" method="post" action="<?php echo e(route('permission.update', $permission)); ?>">
<?php echo e(method_field('PUT')); ?>

<?php else: ?>
<form role="form" method="post" action="<?php echo e(route('permission.store')); ?>">
<?php endif; ?>
<?php echo e(csrf_field()); ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    <?php echo app('translator')->get('Permission Details'); ?>
                </h5>
                <p class="text-muted">
                    <?php echo app('translator')->get('A general permission information.'); ?>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="name"
                           placeholder="<?php echo app('translator')->get('Role Name'); ?>"
                           value="<?php echo e($edit ? $permission->name : old('name')); ?>">
                </div>
                <div class="form-group">
                    <label for="guard_name"><?php echo app('translator')->get('Display Name'); ?></label>
                    <input type="text"
                           class="form-control input-solid"
                           id="guard_name"
                           name="guard_name"
                           placeholder="<?php echo app('translator')->get('Display Name'); ?>"
                           value="<?php echo e($edit ? $permission->guard_name : old('guard_name')); ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    <?php echo e(__($edit ? 'Update Permission' : 'Create Permission')); ?>

</button>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/lblog/resources/views/permission/add-edit.blade.php ENDPATH**/ ?>