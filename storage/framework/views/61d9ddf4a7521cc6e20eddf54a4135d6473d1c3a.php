 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php if(strtok(Route::currentRouteName(), '.') == "internaldocs"): ?>
            Edit Internal Doctor
            <?php elseif(strtok(Route::currentRouteName(), '.') == "externaldocs"): ?>
            Edit External Doctor
            <?php endif; ?>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 sm:px-6 lg:px-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('edit-doctor-form', [$doctor])->html();
} elseif ($_instance->childHasBeenRendered('8ORp8YT')) {
    $componentId = $_instance->getRenderedChildComponentId('8ORp8YT');
    $componentTag = $_instance->getRenderedChildComponentTagName('8ORp8YT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('8ORp8YT');
} else {
    $response = \Livewire\Livewire::mount('edit-doctor-form', [$doctor]);
    $html = $response->html();
    $_instance->logRenderedChild('8ORp8YT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/doctors/edit.blade.php ENDPATH**/ ?>