

<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo app('translator')->get('S.N.'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Fullname'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Email'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Phone'); ?></th>
                                <th scope="col"><?php echo app('translator')->get('Joined At'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td> <?php echo e($referrals->firstItem()+ $loop->index); ?>

                                    </td>
                                    <td><?php echo e(__($referral->fullname)); ?>

                                    <td><?php echo e(__($referral->email)); ?>

                                    <td><?php echo e(__($referral->mobile)); ?>

                                    </td>
                                    <td><?php echo e(showDateTime($referral->created_at)); ?></td></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($referrals->hasPages()): ?>
              <div class="card-footer py-4">
                  <?php echo e(paginateLinks($referrals)); ?>

              </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/admin/users/referral.blade.php ENDPATH**/ ?>