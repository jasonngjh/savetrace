<select
    name="<?php echo e($name); ?>"
    class="<?php echo e($styles['default']); ?>"
    wire:model="value">

    <option value="">
        <?php echo e($placeholder); ?>

    </option>

    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($option['value']); ?>">
            <?php echo e($option['description']); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/default.blade.php ENDPATH**/ ?>