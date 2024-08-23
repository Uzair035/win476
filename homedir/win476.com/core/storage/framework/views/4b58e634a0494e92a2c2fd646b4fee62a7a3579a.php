<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-1.png')); ?>" alt="image"></div>
        <div class="ball-2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-2.png')); ?>" alt="image"></div>
        <div class="ball-3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-3.png')); ?>" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">

                    <div class="d-flex justify-content-center">
                        <div class="verification-code-wrapper account-wrapper">
                            <div class="verification-area">

                                <form class="submit-form" action="<?php echo e(route('user.password.verify.code')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <p class="verification-text"><?php echo app('translator')->get('A 6 digit verification code sent to your email address'); ?> : <?php echo e(showEmailAddress($email)); ?></p>
                                    <input name="email" type="hidden" value="<?php echo e($email); ?>">

                                    <?php echo $__env->make($activeTemplate . 'partials.verification_code', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div class="form-group">
                                        <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                                    </div>

                                    <div class="form-group">
                                        <?php echo app('translator')->get('Please check including your Junk/Spam Folder. if not found, you can'); ?>
                                        <a href="<?php echo e(route('user.password.request')); ?>"><?php echo app('translator')->get('Try to send again'); ?></a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/templates/basic/user/auth/passwords/code_verify.blade.php ENDPATH**/ ?>