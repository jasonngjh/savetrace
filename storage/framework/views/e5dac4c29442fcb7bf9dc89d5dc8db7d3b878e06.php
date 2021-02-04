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
            <a href="<?php echo e(route('appointments')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('appointments')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Appointments</a>
            <a href="#" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700">Payments</a>
        </nav>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        Doctor Referrals
                    </h2>
                    <div class="flex flex-wrap ">
                        <?php $__empty_1 = true; $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500">
                            <div class="py-4 px-8 mt-3">
                                <div class="py-2">
                                    <?php if($referral->visited_on): ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">Visited on <?php echo e($referral->visited_on); ?></span>
                                    </span>
                                    <?php else: ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">Yet to Visit</span>
                                    </span>
                                    <?php endif; ?>
                                    <span class="my-auto text-grey-200">Referral Created on <?php echo e($referral->created_at); ?> </span>
                                </div>
                                <div class="flex flex-row mb-8 justify-between">
                                    <a href="<?php echo e(route('doctors.view', $referral->From_doctor->id)); ?>" class="hover:bg-blue-100 rounded-md py-2 px-2 text-center">
                                        <div class="flex">
                                            <img class="w-7 h-7 my-3 rounded-full object-cover" src="<?php echo e($referral->From_doctor->profile_photo_url); ?>" alt="<?php echo e($referral->From_doctor->name); ?>">
                                            <span class="my-auto pl-5 font-semibold"><?php echo e("Dr." . $referral->From_doctor->name); ?> </span>
                                        </div>
                                        <span class="my-auto text-grey-200"><?php echo e($referral->From_doctor->PracticePlace->name); ?> </span>
                                    </a>
                                    <div class="h-full w-1/2 flex items-center justify-center my-auto">
                                        <div class=" w-full h-1 bg-blue-800 pointer-events-none text-center">
                                            <h2 class="py-2">Referred To</h2>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(route('doctors.view', $referral->To_doctor->id)); ?>" class="hover:bg-blue-100 rounded-md py-2 px-2 text-center">
                                        <div class="flex">
                                            <img class="w-7 h-7 my-3 rounded-full object-cover" src="<?php echo e($referral->To_doctor->profile_photo_url); ?>" alt="<?php echo e($referral->To_doctor->name); ?>">
                                            <span class="my-auto pl-5 font-semibold"><?php echo e("Dr." . $referral->To_doctor->name); ?> </span>
                                        </div>
                                        <span class="my-auto text-grey-200"><?php echo e($referral->To_doctor->PracticePlace->name); ?></span>
                                    </a>
                                </div>
                                <div class="flex justify-between">
                                    <div class="my-auto">
                                        <?php if($referral->file_path): ?>
                                        <?php else: ?>
                                        <p class=" text-gray-500 text-base">No File</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500 text-center">
                            <h2 class="font-normal text-3xl text-gray-800 leading-tight py-4 px-8 mt-3">
                                No Referrals available
                            </h2>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/patients/view_referrals.blade.php ENDPATH**/ ?>