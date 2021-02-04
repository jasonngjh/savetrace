 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="<?php echo e(route('home')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Personal Health</a>
            <a href="<?php echo e(route('referrals')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('referrals')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Referrals</a>
            <a href="<?php echo e(route('appointments')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('appointments*')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Appointments</a>
            <a href="#" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700">Payments</a>
        </nav>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('patients.request-appointment-form')->html();
} elseif ($_instance->childHasBeenRendered('gnZMaFi')) {
    $componentId = $_instance->getRenderedChildComponentId('gnZMaFi');
    $componentTag = $_instance->getRenderedChildComponentTagName('gnZMaFi');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gnZMaFi');
} else {
    $response = \Livewire\Livewire::mount('patients.request-appointment-form');
    $html = $response->html();
    $_instance->logRenderedChild('gnZMaFi', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/patients/request_appointment.blade.php ENDPATH**/ ?>