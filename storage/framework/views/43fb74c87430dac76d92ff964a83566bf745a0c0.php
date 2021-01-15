<div
    class="<?php echo e($styles['searchOptionsContainer']); ?>"

    x-show="isOpen"
>
    <?php if(!$emptyOptions): ?>
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($searchOptionItem, [
                'option' => $option,
                'index' => $loop->index,
                'styles' => $styles,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($isSearching): ?>
        <?php echo $__env->make($searchNoResultsView, [
            'styles' => $styles,
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/search-options-container.blade.php ENDPATH**/ ?>