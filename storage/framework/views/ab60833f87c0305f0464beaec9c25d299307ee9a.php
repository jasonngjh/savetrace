 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Profile')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div>
        <div class=" max-w-7xl py-10 sm:px-6 lg:px-8">
            <?php if(Laravel\Fortify\Features::canUpdateProfileInformation()): ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('profile.update-profile-information-form')->html();
} elseif ($_instance->childHasBeenRendered('Hy43eMp')) {
    $componentId = $_instance->getRenderedChildComponentId('Hy43eMp');
    $componentTag = $_instance->getRenderedChildComponentTagName('Hy43eMp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Hy43eMp');
} else {
    $response = \Livewire\Livewire::mount('profile.update-profile-information-form');
    $html = $response->html();
    $_instance->logRenderedChild('Hy43eMp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.section-border','data' => []]); ?>
<?php $component->withName('jet-section-border'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
            <?php endif; ?>

            <?php if(Auth::user()->role_id): ?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('role-information-form', ['user' => Auth::user()])->html();
} elseif ($_instance->childHasBeenRendered('ll4jyCL')) {
    $componentId = $_instance->getRenderedChildComponentId('ll4jyCL');
    $componentTag = $_instance->getRenderedChildComponentTagName('ll4jyCL');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ll4jyCL');
} else {
    $response = \Livewire\Livewire::mount('role-information-form', ['user' => Auth::user()]);
    $html = $response->html();
    $_instance->logRenderedChild('ll4jyCL', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.section-border','data' => []]); ?>
<?php $component->withName('jet-section-border'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
            <?php endif; ?>

            <?php if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords())): ?>
            <div class="mt-10 sm:mt-0">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('profile.update-password-form')->html();
} elseif ($_instance->childHasBeenRendered('SW5dg6L')) {
    $componentId = $_instance->getRenderedChildComponentId('SW5dg6L');
    $componentTag = $_instance->getRenderedChildComponentTagName('SW5dg6L');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('SW5dg6L');
} else {
    $response = \Livewire\Livewire::mount('profile.update-password-form');
    $html = $response->html();
    $_instance->logRenderedChild('SW5dg6L', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>

             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.section-border','data' => []]); ?>
<?php $component->withName('jet-section-border'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
            <?php endif; ?>

            <?php if(Laravel\Fortify\Features::canManageTwoFactorAuthentication()): ?>
            <div class="mt-10 sm:mt-0">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('profile.two-factor-authentication-form')->html();
} elseif ($_instance->childHasBeenRendered('qkYSnMk')) {
    $componentId = $_instance->getRenderedChildComponentId('qkYSnMk');
    $componentTag = $_instance->getRenderedChildComponentTagName('qkYSnMk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qkYSnMk');
} else {
    $response = \Livewire\Livewire::mount('profile.two-factor-authentication-form');
    $html = $response->html();
    $_instance->logRenderedChild('qkYSnMk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>

             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.section-border','data' => []]); ?>
<?php $component->withName('jet-section-border'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
            <?php endif; ?>

            <div class="mt-10 sm:mt-0">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('profile.logout-other-browser-sessions-form')->html();
} elseif ($_instance->childHasBeenRendered('ZLnmHj4')) {
    $componentId = $_instance->getRenderedChildComponentId('ZLnmHj4');
    $componentTag = $_instance->getRenderedChildComponentTagName('ZLnmHj4');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('ZLnmHj4');
} else {
    $response = \Livewire\Livewire::mount('profile.logout-other-browser-sessions-form');
    $html = $response->html();
    $_instance->logRenderedChild('ZLnmHj4', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>

             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.section-border','data' => []]); ?>
<?php $component->withName('jet-section-border'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 

            <div class="mt-10 sm:mt-0">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('profile.delete-user-form')->html();
} elseif ($_instance->childHasBeenRendered('m6R4lOk')) {
    $componentId = $_instance->getRenderedChildComponentId('m6R4lOk');
    $componentTag = $_instance->getRenderedChildComponentTagName('m6R4lOk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('m6R4lOk');
} else {
    $response = \Livewire\Livewire::mount('profile.delete-user-form');
    $html = $response->html();
    $_instance->logRenderedChild('m6R4lOk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/profile/show.blade.php ENDPATH**/ ?>