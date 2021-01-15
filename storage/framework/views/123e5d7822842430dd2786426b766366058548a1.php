<div>

    <div>
        <?php if(!$searchable && $shouldShow): ?>
            <?php echo $__env->make($defaultView, [
                'name' => $name,
                'options' => $options,
                'placeholder' => $placeholder,
                'styles' => $styles,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <div x-data="{
        isOpen: true,
        selectedIndex: -1,
        selectUp(component) {
            if (this.selectedIndex === 0) {
                return
            }
            this.selectedIndex--
        },
        selectDown(component) {
            if (component.data.optionsValues.length - 1 === this.selectedIndex) {
                return
            }
            this.selectedIndex++
        },
        selectIndex(index) {
            this.selectedIndex = index
            this.isOpen = true
        },
        confirmSelection(component) {
            const value = component.data.optionsValues.length === 1
                ? component.data.optionsValues[0]
                : component.data.optionsValues[this.selectedIndex]

            if (!value) {
                return
            }

            component.set('value', value)

            this.selectedIndex = -1
            this.isOpen = true
        },
        removeSelection(component) {
            component.set('value', null)

            this.selectedIndex = -1
            this.isOpen = true
        }
    }" x-on:click.away="isOpen = false">
        <?php if($searchable && $shouldShow): ?>
            <div>
                <?php if(!empty($value)): ?>
                    <?php echo $__env->make($searchSelectedOptionView, [
                        'styles' => $styles,
                        'selectedOption' => $selectedOption,
                        'value' => $value,
                        'name' => $name,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make($searchView, [
                        'name' => $name,
                        'placeholder' => $placeholder,
                        'options' => $options,
                        'isSearching' => !empty($searchTerm),
                        'emptyOptions' => $options->isEmpty(),
                        'styles' => $styles,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php /**PATH /Users/jasonng/Desktop/SaveTrace/vendor/asantibanez/livewire-select/src/../resources/views/select.blade.php ENDPATH**/ ?>