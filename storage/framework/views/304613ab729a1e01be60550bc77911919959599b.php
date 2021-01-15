 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Edit User Account')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 sm:px-6 lg:px-8">

        <?php if(isset($message)): ?>
        <div class="py-4 px-2 ">
            <div class="bg-green-100 border-l-4 border-green text-green-900 p-4" role="alert">
                <p class="font-bold"><?php echo e($message); ?></p>
            </div>
        </div>
        <?php endif; ?>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('edit-user-form', [$user])->html();
} elseif ($_instance->childHasBeenRendered('qVuHNpU')) {
    $componentId = $_instance->getRenderedChildComponentId('qVuHNpU');
    $componentTag = $_instance->getRenderedChildComponentTagName('qVuHNpU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qVuHNpU');
} else {
    $response = \Livewire\Livewire::mount('edit-user-form', [$user]);
    $html = $response->html();
    $_instance->logRenderedChild('qVuHNpU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/user/edit.blade.php ENDPATH**/ ?>