<button
    id="<?php echo e($name); ?>-selected"
    type="button"
    class="<?php echo e($styles['searchSelectedOption']); ?>"

    x-on:keydown.enter.prevent="removeSelection(window.livewire.find('<?php echo e($_instance->id); ?>'))"
    x-on:keydown.space.prevent="removeSelection(window.livewire.find('<?php echo e($_instance->id); ?>'))"
>
    <span class="<?php echo e($styles['searchSelectedOptionTitle']); ?>">
        <?php echo e(data_get($selectedOption, 'description', 'Override selectedOption() with keyed array (value, description) for meaningful description')); ?>

    </span>

    <span
        type="button"
        wire:click.prevent="selectValue(null)"
    >
        <svg class="<?php echo e($styles['searchSelectedOptionReset']); ?>" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"
            />
        </svg>
    </span>

    <input type="hidden" value="<?php echo e($value); ?>" name="<?php echo e($name); ?>">

</button>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/search-selected-option.blade.php ENDPATH**/ ?>