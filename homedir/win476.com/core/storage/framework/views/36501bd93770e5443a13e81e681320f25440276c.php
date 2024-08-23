<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-1.png')); ?>" alt="image"></div>
        <div class="ball-2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-2.png')); ?>" alt="image"></div>
        <div class="ball-3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-3.png')); ?>" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">

                    <div class="account-wrapper">

                        <div class="card-body account-form">
                            <div class="mb-4">
                                <p><?php echo app('translator')->get('Your account is verified successfully. Now you can change your password. Please enter a strong password and don\'t share it with anyone.'); ?></p>
                            </div>
                            <form method="POST" action="<?php echo e(route('user.password.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <input name="email" type="hidden" value="<?php echo e($email); ?>">
                                <input name="token" type="hidden" value="<?php echo e($token); ?>">

                                <div class="form-group">
                                    <label for="password"><?php echo app('translator')->get('Password'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password" name="password" type="password" required>
                                        <?php if($general->secure_password): ?>
                                            <div class="input-popup">
                                                <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                                <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                                <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                                <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                                <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm"><?php echo app('translator')->get('Confirm Password'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password-confirm" name="password_confirmation" type="password" autocomplete="password" required>
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit"> <?php echo app('translator')->get('Submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php if($general->secure_password): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/templates/basic/user/auth/passwords/reset.blade.php ENDPATH**/ ?>