<style>
    .custom--flex-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px; /* Adjust as needed */
    }

    .custom--flex-item {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
    }

    .table-game img {
        width: 100%;
        max-width: 150px; /* Set a fixed width for the image */
        height: auto;
        border-radius: 5px; /* Rounded corners for the thumbnail effect */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for the thumbnail effect */
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-outline--base {
        background-color: transparent;
        color: #3490dc;
        border: 1px solid #3490dc;
        padding: 5px 10px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    @media (max-width: 768px) {
        .custom--flex-container {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 576px) {
        .custom--flex-container {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="table-responsive--md">
    <div class="custom--flex-container">
        <?php $__empty_1 = true; $__currentLoopData = $phases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="custom--flex-item  feature-card rounded-3">
                <div class="table-game">
                    <img class="thumbnail mx-auto" src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image">
                   
                </div>
                 <h2 class="name"><?php echo e(__($phase->lottery->name)); ?></h2>
                <p><strong><?php echo app('translator')->get('Start Date'); ?>:</strong> <?php echo e(@showDateTime($phase->start_date, 'Y-m-d')); ?></p>
                <p><strong><?php echo app('translator')->get('Draw Date'); ?>:</strong> <?php echo e(@showDateTime($phase->draw_date, 'Y-m-d')); ?></p>
                <p><strong><?php echo app('translator')->get('Price'); ?>:</strong> <?php echo e(showAmount($phase->lottery->price)); ?> <?php echo e($general->cur_text); ?></p>
                <div class="progress lottery--progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo e(($phase->sold / $phase->quantity) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($phase->sold / $phase->quantity) * 100); ?>%"></div>
                </div>
                <span class="fs--14px"><?php echo e(getAmount(($phase->sold / $phase->quantity) * 100)); ?>%</span>
                <div class="status-badge">
                    <?php  echo $phase->DrawBadge; ?>
                </div>
                <a class="btn btn-sm btn-outline--base" href="<?php if(request()->routeIs('user.*')): ?> <?php echo e(route('user.lottery.details', $phase->id)); ?> <?php else: ?> <?php echo e(route('lottery.details', $phase->id)); ?> <?php endif; ?>">
                    <?php if(@request()->routeIs('user.home')): ?>
                        <?php echo app('translator')->get('Play Now'); ?>
                    <?php else: ?>
                        <?php echo app('translator')->get('Buy Ticket'); ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center"><?php echo e(__($emptyMessage)); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/ignwamlz/win476.com/core/resources/views/templates/basic/partials/lotteries.blade.php ENDPATH**/ ?>