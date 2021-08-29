<?php $__env->startSection("content"); ?>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success">
  <p><?php echo e($message); ?></p>
</div>
<?php endif; ?>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            <?php echo app('translator')->get('Add User'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100"><?php echo app('translator')->get('Name'); ?></th>
                        <th class="min-width-150"><?php echo app('translator')->get('Email'); ?></th>
                        <th class="min-width-150"><?php echo app('translator')->get('Role'); ?></th>
                        <th class="text-center"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data)): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->roles->pluck('name')->get('0')); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('user.edit', $user)); ?>" class="btn btn-icon"
                                           title="<?php echo app('translator')->get('Edit Role'); ?>" data-toggle="tooltip" data-placement="top">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if($user->removable): ?>
                                            <a href="" class="btn btn-icon"
                                               title="<?php echo app('translator')->get('Delete Role'); ?>"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="<?php echo app('translator')->get('Please Confirm'); ?>"
                                               data-confirm-text="<?php echo app('translator')->get('Are you sure that you want to delete this role?'); ?>"
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/lblog/resources/views/user/index.blade.php ENDPATH**/ ?>