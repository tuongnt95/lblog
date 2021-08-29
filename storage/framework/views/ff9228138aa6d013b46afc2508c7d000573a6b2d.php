<?php $__env->startSection("content"); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Two-factor authentication</div>
                <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                    <form role="form" method="post" action="<?php echo e(route('two_face.verify')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="control-label" for="otp">
                                <b>Authentication code</b>
                            </label>
                            <input type="text" name="code" class="form-control" placeholder="123456" autocomplete="off" maxlength="6" id="otp">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success col-md-12">Verify</button>
                        </div>
                        <p class="text-muted">
                            Open the two-factor authentication app on your device to view your authentication code and verify your identity.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/lblog/resources/views/auth/twofa/verify.blade.php ENDPATH**/ ?>