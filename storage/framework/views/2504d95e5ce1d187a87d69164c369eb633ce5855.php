 <?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-dropdown')->html();
} elseif ($_instance->childHasBeenRendered('1hUuD5g')) {
    $componentId = $_instance->getRenderedChildComponentId('1hUuD5g');
    $componentTag = $_instance->getRenderedChildComponentTagName('1hUuD5g');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('1hUuD5g');
} else {
    $response = \Livewire\Livewire::mount('navigation-dropdown');
    $html = $response->html();
    $_instance->logRenderedChild('1hUuD5g', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('search-all-doctors')->html();
} elseif ($_instance->childHasBeenRendered('musLEIV')) {
    $componentId = $_instance->getRenderedChildComponentId('musLEIV');
    $componentTag = $_instance->getRenderedChildComponentTagName('musLEIV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('musLEIV');
} else {
    $response = \Livewire\Livewire::mount('search-all-doctors');
    $html = $response->html();
    $_instance->logRenderedChild('musLEIV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/doctors/search_all_doctors.blade.php ENDPATH**/ ?>