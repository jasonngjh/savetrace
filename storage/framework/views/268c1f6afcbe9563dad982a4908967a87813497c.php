 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                <?php if(auth()->check() && auth()->user()->hasAnyRole('internal|external')): ?>

                <!-- To edit homepage design at resources/views/livewire/.. -->
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('doctors.homepage')->html();
} elseif ($_instance->childHasBeenRendered('KIt3lBs')) {
    $componentId = $_instance->getRenderedChildComponentId('KIt3lBs');
    $componentTag = $_instance->getRenderedChildComponentTagName('KIt3lBs');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('KIt3lBs');
} else {
    $response = \Livewire\Livewire::mount('doctors.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('KIt3lBs', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('patient')): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('patients.homepage')->html();
} elseif ($_instance->childHasBeenRendered('5NBByOG')) {
    $componentId = $_instance->getRenderedChildComponentId('5NBByOG');
    $componentTag = $_instance->getRenderedChildComponentTagName('5NBByOG');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5NBByOG');
} else {
    $response = \Livewire\Livewire::mount('patients.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('5NBByOG', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('nurse')): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('employees.homepage')->html();
} elseif ($_instance->childHasBeenRendered('e4jWy7E')) {
    $componentId = $_instance->getRenderedChildComponentId('e4jWy7E');
    $componentTag = $_instance->getRenderedChildComponentTagName('e4jWy7E');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e4jWy7E');
} else {
    $response = \Livewire\Livewire::mount('employees.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('e4jWy7E', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/home.blade.php ENDPATH**/ ?>