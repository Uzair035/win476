<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="account-wrapper">
                        <div class="card-body">
                            <form action="<?php echo e(route('user.deposit.insert')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input name="method_code" type="hidden">
                                <input name="currency" type="hidden">

                                <div class="account-form">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo app('translator')->get('Select Gateway'); ?></label>
                                        <select class="form--control form-select" name="gateway" required>
                                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                                            <?php $__currentLoopData = $gatewayCurrency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-gateway="<?php echo e($data); ?>" value="<?php echo e($data->method_code); ?>" <?php if(old('gateway') == $data->method_code): echo 'selected'; endif; ?>><?php echo e($data->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><?php echo app('translator')->get('Amount'); ?></label>
                                        <div class="input-group">
                                            <input class="form--control" name="amount" type="number" value="<?php echo e(old('amount')); ?>" step="any" autocomplete="off" required>
                                            <span class="input-group-text"><?php echo e($general->cur_text); ?></span>
                                        </div>
                                    </div>
                                    <div class="preview-details d-none mt-3">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span><?php echo app('translator')->get('Limit'); ?></span>
                                                <span><span class="min fw-bold">0</span> <?php echo e(__($general->cur_text)); ?> -
                                                    <span class="max fw-bold">0</span> <?php echo e(__($general->cur_text)); ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span><?php echo app('translator')->get('Charge'); ?></span>
                                                <span><span class="charge fw-bold">0</span>
                                                    <?php echo e(__($general->cur_text)); ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span><?php echo app('translator')->get('Payable'); ?></span> <span><span class="payable fw-bold"> 0</span>
                                                    <?php echo e(__($general->cur_text)); ?></span>
                                            </li>
                                            <li class="list-group-item justify-content-between d-none rate-element">

                                            </li>
                                            <li class="list-group-item justify-content-between d-none in-site-cur">
                                                <span><?php echo app('translator')->get('In'); ?> <span class="method_currency"></span></span>
                                                <span class="final_amo fw-bold">0</span>
                                            </li>
                                            <li class="list-group-item justify-content-center crypto_currency d-none">
                                                <span><?php echo app('translator')->get('Conversion with'); ?> <span class="method_currency"></span>
                                                    <?php echo app('translator')->get('and final value will Show on next step'); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <button class="btn btn--base w-100 mt-3" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('select[name=gateway]').change(function() {
                if (!$('select[name=gateway]').val()) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=gateway] option:selected').data('gateway');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                if (resource.method.crypto == 1) {
                    var toFixedDigit = 8;
                    $('.crypto_currency').removeClass('d-none');
                } else {
                    var toFixedDigit = 2;
                    $('.crypto_currency').addClass('d-none');
                }
                $('.min').text(parseFloat(resource.min_amount).toFixed(2));
                $('.max').text(parseFloat(resource.max_amount).toFixed(2));
                var amount = parseFloat($('input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if (amount <= 0) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                $('.preview-details').removeClass('d-none');
                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('.charge').text(charge);
                var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                $('.payable').text(payable);
                var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(
                    toFixedDigit);
                $('.final_amo').text(final_amo);
                if (resource.currency != '<?php echo e($general->cur_text); ?>') {
                    var rateElement =
                        `<span class="fw-bold"><?php echo app('translator')->get('Conversion Rate'); ?></span> <span><span  class="fw-bold">1 <?php echo e(__($general->cur_text)); ?> = <span class="rate">${rate}</span>  <span class="method_currency">${resource.currency}</span></span></span>`;
                    $('.rate-element').html(rateElement)
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
                $('.method_currency').text(resource.currency);
                $('input[name=currency]').val(resource.currency);
                $('input[name=method_code]').val(resource.method_code);
                $('input[name=amount]').on('input');
            }).change();
            $('input[name=amount]').on('input', function() {
                $('select[name=gateway]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ignwamlz/win476.com/core/resources/views/templates/basic/user/payment/deposit.blade.php ENDPATH**/ ?>