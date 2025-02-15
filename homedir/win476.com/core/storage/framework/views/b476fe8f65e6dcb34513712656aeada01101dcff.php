<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="account-wrapper">
                        <div class="card-body">
                            <form action="<?php echo e(route('user.withdraw.money')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('Method'); ?></label>
                                    <select class="form-select form--control" name="method_code" required>
                                        <option value=""><?php echo app('translator')->get('Select Gateway'); ?></option>
                                        <?php $__currentLoopData = $withdrawMethod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-resource="<?php echo e($data); ?>" value="<?php echo e($data->id); ?>">
                                                <?php echo e(__($data->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('Amount'); ?></label>
                                    <div class="input-group">
                                        <input class="form--control" name="amount" type="number" value="<?php echo e(old('amount')); ?>" step="any" required>
                                        <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                                    </div>
                                </div>
                                <small class="text--danger min-max-alert"></small>

                                <div class="preview-details d-none mt-3">
                                    <ul class="list-group text-center">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span><?php echo app('translator')->get('Limit'); ?></span>
                                            <span><span class="min fw-bold">0</span> <?php echo e(__($general->cur_text)); ?> - <span
                                                    class="max fw-bold">0</span> <?php echo e(__($general->cur_text)); ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span><?php echo app('translator')->get('Charge'); ?></span>
                                            <span><span class="charge fw-bold">0</span> <?php echo e(__($general->cur_text)); ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span><?php echo app('translator')->get('Receivable'); ?></span> <span><span class="receivable fw-bold"> 0</span>
                                                <?php echo e(__($general->cur_text)); ?> </span>
                                        </li>
                                        <li class="list-group-item d-none justify-content-between rate-element">

                                        </li>
                                        <li class="list-group-item d-none justify-content-between in-site-cur">
                                            <span><?php echo app('translator')->get('In'); ?> <span class="base-currency"></span></span>
                                            <strong class="final_amo">0</strong>
                                        </li>
                                    </ul>
                                </div>
                                <button class="btn btn--base w-100 action-button mt-3" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $('select[name=method_code]').change(function() {



                if (!$('select[name=method_code]').val()) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=method_code] option:selected').data('resource');



                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                var toFixedDigit = 2;
                $('.min').text(parseFloat(resource.min_limit).toFixed(2));
                $('.max').text(parseFloat(resource.max_limit).toFixed(2));
                var amount = parseFloat($('input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if (amount <= 0) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }

                if (amount > resource.max_limit) {
                    $('.min-max-alert').text(`<?php echo app('translator')->get('You can\'t withdraw more than'); ?> ` + parseFloat(resource.max_limit).toFixed(2))
                        .removeClass('d-none');
                    $('.action-button').addClass('disabled');
                } else
                if (amount < resource.min_limit) {
                    $('.min-max-alert').text(`<?php echo app('translator')->get('You can\'t withdraw less than'); ?> ` + parseFloat(resource.min_limit).toFixed(2))
                        .removeClass('d-none');
                    $('.action-button').addClass('disabled');
                } else if (<?php echo e(auth()->user()->balance); ?> < amount) {

                    $('.min-max-alert').text(`<?php echo app('translator')->get('You can\'t withdraw more than your Balance'); ?> `).removeClass('d-none');
                    $('.action-button').addClass('disabled');
                } else {

                    $('.min-max-alert').addClass('d-none');
                    $('.action-button').removeClass('disabled');
                }


                $('.preview-details').removeClass('d-none');

                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('.charge').text(charge);
                if (resource.currency != '<?php echo e($general->cur_text); ?>') {
                    var rateElement =
                        `<span><?php echo app('translator')->get('Conversion Rate'); ?></span> <span class="fw-bold">1 <?php echo e(__($general->cur_text)); ?> = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span>`;
                    $('.rate-element').html(rateElement);
                    $('.rate-element').removeClass('d-none');
                    $('.in-site-cur').removeClass('d-none');
                    $('.rate-element').addClass('d-flex');
                    $('.in-site-cur').addClass('d-flex');
                } else {
                    $('.rate-element').html('')
                    $('.rate-element').addClass('d-none');
                    $('.in-site-cur').addClass('d-none');
                    $('.rate-element').removeClass('d-flex');
                    $('.in-site-cur').removeClass('d-flex');
                }
                var receivable = parseFloat((parseFloat(amount) - parseFloat(charge))).toFixed(2);
                $('.receivable').text(receivable);
                var final_amo = parseFloat(parseFloat(receivable) * rate).toFixed(toFixedDigit);
                $('.final_amo').text(final_amo);
                $('.base-currency').text(resource.currency);
                $('.method_currency').text(resource.currency);
                $('input[name=amount]').on('input');

            });

            $('input[name=amount]').on('input', function() {
                var data = $('select[name=method_code]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/templates/basic/user/withdraw/methods.blade.php ENDPATH**/ ?>