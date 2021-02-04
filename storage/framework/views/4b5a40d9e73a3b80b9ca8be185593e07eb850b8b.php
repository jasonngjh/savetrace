 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Doctor
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 sm:px-6 lg:px-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('view-doctor-information-card', ['doctor_id' => $id])->html();
} elseif ($_instance->childHasBeenRendered('2JiAPSf')) {
    $componentId = $_instance->getRenderedChildComponentId('2JiAPSf');
    $componentTag = $_instance->getRenderedChildComponentTagName('2JiAPSf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('2JiAPSf');
} else {
    $response = \Livewire\Livewire::mount('view-doctor-information-card', ['doctor_id' => $id]);
    $html = $response->html();
    $_instance->logRenderedChild('2JiAPSf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->hasRole(['internal','external','nurse'])): ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('doctor-referrals-tabs', ['doctor_id' => $id])->html();
} elseif ($_instance->childHasBeenRendered('XIDKRbE')) {
    $componentId = $_instance->getRenderedChildComponentId('XIDKRbE');
    $componentTag = $_instance->getRenderedChildComponentTagName('XIDKRbE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('XIDKRbE');
} else {
    $response = \Livewire\Livewire::mount('doctor-referrals-tabs', ['doctor_id' => $id]);
    $html = $response->html();
    $_instance->logRenderedChild('XIDKRbE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php if(Auth::user()->role_id == $id): ?>
        <h2>im this person</h2>
        <?php else: ?>
        <h2>im not this person</h2>
        <?php endif; ?>
        <?php else: ?>
        <div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('doctor-information-component',['doctor_id' => $id])->html();
} elseif ($_instance->childHasBeenRendered('YzN2RMg')) {
    $componentId = $_instance->getRenderedChildComponentId('YzN2RMg');
    $componentTag = $_instance->getRenderedChildComponentTagName('YzN2RMg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YzN2RMg');
} else {
    $response = \Livewire\Livewire::mount('doctor-information-component',['doctor_id' => $id]);
    $html = $response->html();
    $_instance->logRenderedChild('YzN2RMg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
        <div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('doctor-information-component',['doctor_id' => $id])->html();
} elseif ($_instance->childHasBeenRendered('yCYVX2O')) {
    $componentId = $_instance->getRenderedChildComponentId('yCYVX2O');
    $componentTag = $_instance->getRenderedChildComponentTagName('yCYVX2O');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yCYVX2O');
} else {
    $response = \Livewire\Livewire::mount('doctor-information-component',['doctor_id' => $id]);
    $html = $response->html();
    $_instance->logRenderedChild('yCYVX2O', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
        <?php endif; ?>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/doctors/view.blade.php ENDPATH**/ ?>