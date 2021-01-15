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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php if(auth()->check() && auth()->user()->hasAnyRole('internal|external')): ?>

                <!-- To edit homepage design at resources/views/livewire/.. -->
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('doctors.homepage')->html();
} elseif ($_instance->childHasBeenRendered('iUz8ck9')) {
    $componentId = $_instance->getRenderedChildComponentId('iUz8ck9');
    $componentTag = $_instance->getRenderedChildComponentTagName('iUz8ck9');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('iUz8ck9');
} else {
    $response = \Livewire\Livewire::mount('doctors.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('iUz8ck9', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('patient')): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('patients.homepage')->html();
} elseif ($_instance->childHasBeenRendered('mS5sxNH')) {
    $componentId = $_instance->getRenderedChildComponentId('mS5sxNH');
    $componentTag = $_instance->getRenderedChildComponentTagName('mS5sxNH');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mS5sxNH');
} else {
    $response = \Livewire\Livewire::mount('patients.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('mS5sxNH', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                <?php endif; ?>

                <?php if(auth()->check() && auth()->user()->hasRole('employee')): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('employee.homepage')->html();
} elseif ($_instance->childHasBeenRendered('pN4uCw2')) {
    $componentId = $_instance->getRenderedChildComponentId('pN4uCw2');
    $componentTag = $_instance->getRenderedChildComponentTagName('pN4uCw2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pN4uCw2');
} else {
    $response = \Livewire\Livewire::mount('employee.homepage');
    $html = $response->html();
    $_instance->logRenderedChild('pN4uCw2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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