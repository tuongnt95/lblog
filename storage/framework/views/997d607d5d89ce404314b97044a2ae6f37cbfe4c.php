<?php $__env->startSection("content"); ?>
<?php if($edit): ?>
<?php echo Form::open(['method' => 'POST', 'route' => ['user.update', $user]]); ?>

<?php echo e(method_field('PUT')); ?>

<?php else: ?>
<?php echo Form::open(['method' => 'POST', 'route' => ['user.store']]); ?>

<?php endif; ?>
<?php echo e(csrf_field()); ?>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    <?php echo app('translator')->get('User Details'); ?>
                </h5>
                <p class="text-muted">
                    <?php echo app('translator')->get('A general user information.'); ?>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name"><?php echo app('translator')->get('Name'); ?></label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="name"
                           placeholder="<?php echo app('translator')->get('Name'); ?>"
                           value="<?php echo e($edit ? $user->name : old('name')); ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?php echo app('translator')->get('Email'); ?></label>
                    <input type="text"
                           class="form-control input-solid"
                           id="email"
                           name="email"
                           placeholder="<?php echo app('translator')->get('Email'); ?>"
                           value="<?php echo e($edit ? $user->email : old('email')); ?>">
                </div>
                <div class="form-group">
                    <label for="first_name"><?php echo app('translator')->get('Role'); ?></label>
                    <?php echo Form::select('role', $roles, $edit ? $userRole[0] : '', ['class' => 'form-control input-solid', 'id' => 'role_id']); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    <?php echo e(__($edit ? 'Update User' : 'Create User')); ?>

</button>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/lblog/resources/views/user/add-edit.blade.php ENDPATH**/ ?>