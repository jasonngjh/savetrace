<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'SaveTrace')); ?></title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">

    <?php echo \Livewire\Livewire::styles(); ?>


    <!-- Scripts -->
    <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
</head>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-blue-100">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-dropdown')->html();
} elseif ($_instance->childHasBeenRendered('G8u2Jdk')) {
    $componentId = $_instance->getRenderedChildComponentId('G8u2Jdk');
    $componentTag = $_instance->getRenderedChildComponentTagName('G8u2Jdk');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('G8u2Jdk');
} else {
    $response = \Livewire\Livewire::mount('navigation-dropdown');
    $html = $response->html();
    $_instance->logRenderedChild('G8u2Jdk', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <!-- Page Content -->
        <div class="flex">
            <?php if(auth()->guard()->check()): ?>
            <?php if(!Auth::user()->hasRole("patient")): ?>
            <div class="sticky bg-white h-screen top-0 flex-none">
                <?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php endif; ?>
            <div class="flex-auto">
                <!-- Page Heading -->
                <header class="bg-white shadow ">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
                <?php echo e($slot); ?>

            </div>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
            <div class="flex-auto">
                <!-- Page Heading -->
                <header class="bg-white shadow flex">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
                <?php echo e($slot); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

</body>

</html><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/layouts/app.blade.php ENDPATH**/ ?>