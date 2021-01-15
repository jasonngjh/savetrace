 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php if(strtok(Route::currentRouteName(), '.') == "internaldocs"): ?>
            Add New Internal Doctor
            <?php elseif(strtok(Route::currentRouteName(), '.') == "externaldocs"): ?>
            Add New External Doctor
            <?php endif; ?>
     <?php $__env->endSlot(); ?>

    <div class="py-10 sm:px-6 lg:px-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('add-new-doctor-form')->html();
} elseif ($_instance->childHasBeenRendered('1HcKJfS')) {
    $componentId = $_instance->getRenderedChildComponentId('1HcKJfS');
    $componentTag = $_instance->getRenderedChildComponentTagName('1HcKJfS');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('1HcKJfS');
} else {
    $response = \Livewire\Livewire::mount('add-new-doctor-form');
    $html = $response->html();
    $_instance->logRenderedChild('1HcKJfS', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/doctors/add.blade.php ENDPATH**/ ?>