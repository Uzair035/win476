
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Trx.'); ?></th>
                                    <th><?php echo app('translator')->get('Percent'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Type'); ?></th>
                                    <th><?php echo app('translator')->get('Level'); ?></th>
                                    <th><?php echo app('translator')->get('Description'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td> <?php echo e(showDateTime($data->created_at)); ?><br><?php echo e(diffForHumans($data->created_at)); ?></td>
                                        <td> <?php echo e($data->trx); ?> </td>
                                        <td> <?php echo e(showAmount($data->percent, 0)); ?>%</td>
                                        <td> <?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?></td>
                                        <td>
                                            <?php if($data->commission_type == 'deposit_commission'): ?>
                                        <span class="badge badge--success"><?php echo app('translator')->get('Deposit'); ?></span>
                                        <?php elseif($data->type == 'buy_commission'): ?>
                                        <span class="badge badge--info"><?php echo app('translator')->get('Buy'); ?></span>
                                        <?php else: ?>
                                        <span class="badge badge--primary"><?php echo app('translator')->get('Win'); ?></span>
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo e(__(ordinal($data->level))); ?></td>
                                        <td><?php echo e(__($data->title)); ?></td>
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
                <div class="card-footer py-4">
                    <?php if($logs->hasPages()): ?>
                        <?php echo e(paginateLinks($logs)); ?>

                    <?php endif; ?>
                </div>

            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <div class="activeColor">
        <a href="<?php if(request()->routeIs('admin.users.commissions.deposit')): ?> javascript:void(0) <?php else: ?> <?php echo e(route('admin.users.commissions.deposit',$user->id)); ?> <?php endif; ?>"
            class="btn btn-sm btn-outline--primary h-45 <?php echo e(menuActive('admin.users.commissions.deposit',$user->id)); ?>

        <?php if(request()->routeIs('admin.users.commissions.deposit')): ?> btn-disabled <?php endif; ?>"><i
                class="la la-hand-holding-usd"></i><?php echo app('translator')->get('Deposit Commission'); ?></a>
        <a href="<?php if(request()->routeIs('admin.users.commissions.buy')): ?> javascript:void(0) <?php else: ?> <?php echo e(route('admin.users.commissions.buy',$user->id)); ?> <?php endif; ?> "
            class="btn btn-sm btn-outline--primary h-45 <?php echo e(menuActive('admin.users.commissions.buy',$user->id)); ?> <?php if(request()->routeIs('admin.users.commissions.buy')): ?> btn-disabled <?php endif; ?> "><i
                class="la la-shopping-bag"></i> <?php echo app('translator')->get('Buy Commission'); ?></a>
        <a href=" <?php if(request()->routeIs('admin.users.commissions.win')): ?> javascript:void(0)  <?php else: ?> <?php echo e(route('admin.users.commissions.win',$user->id)); ?> <?php endif; ?> "
            class="btn btn-sm btn-outline--primary h-45 <?php echo e(menuActive('admin.users.commissions.win',$user->id)); ?> <?php if(request()->routeIs('admin.users.commissions.win',$user->id)): ?> btn-disabled <?php endif; ?> "><i
                class="las la-trophy"></i><?php echo app('translator')->get('Win Commission'); ?></a>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .activeColor a.active {
            background-color: #4634ff;
            color: white;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/admin/users/commissions.blade.php ENDPATH**/ ?>