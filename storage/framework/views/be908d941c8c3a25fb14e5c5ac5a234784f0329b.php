<div
    class="<?php echo e($styles['searchOptionItem']); ?>"

    wire:click.stop="selectValue('<?php echo e($option['value']); ?>')"

    x-bind:class="{ '<?php echo e($styles['searchOptionItemActive']); ?>': selectedIndex === <?php echo e($index); ?>, '<?php echo e($styles['searchOptionItemInactive']); ?>': selectedIndex !== <?php echo e($index); ?> }"
    x-on:mouseover="selectedIndex = <?php echo e($index); ?>"
>
    <?php echo e($option['description']); ?>

</div>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/search-option-item.blade.php ENDPATH**/ ?>