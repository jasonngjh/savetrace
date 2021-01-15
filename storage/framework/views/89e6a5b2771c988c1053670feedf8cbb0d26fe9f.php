<div id="options" class="<?php echo e($styles['search']); ?>">

    <?php echo $__env->make($searchInputView, [
        'name' => $name,
        'placeholder' => $placeholder,
        'styles' => $styles,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make($searchOptionsContainer, [
        'options' => $options,
        'emptyOptions' => $emptyOptions,
        'isSearching' => $isSearching,
        'styles' => $styles,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/search.blade.php ENDPATH**/ ?>