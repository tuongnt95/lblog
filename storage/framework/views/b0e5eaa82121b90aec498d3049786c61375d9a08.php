<?php $__env->startSection("content"); ?>
<form role="form" method="post" action="<?php echo e(route('permission.save')); ?>">
<?php echo csrf_field(); ?>
<div class="card">
    <div class="card-body">

        <div class="row mb-3 pb-3 border-bottom-light">
            <div class="col-lg-12">
                <div class="float-right">
                    <a href="<?php echo e(route('permission.create')); ?>" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus mr-2"></i>
                        <?php echo app('translator')->get('Add Permission'); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th class="min-width-200"><?php echo app('translator')->get('Name'); ?></th>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="text-center"><?php echo e($role->name); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="text-center min-width-100"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($permissions)): ?>
                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($permission->name); ?></td>

                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="cb-<?php echo e($role->id); ?>-<?php echo e($permission->id); ?>" 
                                        <?php foreach($ids as $id){
                                            if($id=='cb-'.$role->id.'-'.$permission->id) echo "checked='checked'";
                                        } 
                                        ?>
                                        name="roles[<?php echo e($role->id); ?>][]" value="<?php echo e($permission->id); ?>">
                                        <label class="custom-control-label d-inline"
                                               for="cb-<?php echo e($role->id); ?>-<?php echo e($permission->id); ?>"></label>
                                    </div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <td class="text-center">
                                <a href="<?php echo e(route('permission.edit', $permission)); ?>" class="btn btn-icon"
                                   title="<?php echo app('translator')->get('Edit Permission'); ?>" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <?php if($permission->removable): ?>
                                    <a href="<?php echo e(route('permissions.destroy', $permission)); ?>" class="btn btn-icon"
                                       title="<?php echo app('translator')->get('Delete Permission'); ?>"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="<?php echo app('translator')->get('Please Confirm'); ?>"
                                       data-confirm-text="<?php echo app('translator')->get('Are you sure that you want to delete this permission?'); ?>"
                                       data-confirm-delete="<?php echo app('translator')->get('Yes, delete it!'); ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4"><em><?php echo app('translator')->get('No records found.'); ?></em></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if(count($permissions)): ?>
    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Save Permissions'); ?></button>
        </div>
    </div>
<?php endif; ?>

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/lblog/resources/views/permission/index.blade.php ENDPATH**/ ?>