<div>
     <?php $__env->slot('header'); ?> 
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="<?php echo e(route('home')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Personal Health</a>
            <a href="<?php echo e(route('referrals')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('referrals')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Referrals</a>
            <a href="<?php echo e(route('appointments')); ?>" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 <?php echo e((request()->routeIs('appointments')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : ''); ?>">Appointments</a>
            <a href="#" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700">Payments</a>
        </nav>
     <?php $__env->endSlot(); ?>
    <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
            Medical Records
        </h2>
        <div class="flex flex-wrap ">
            <?php $__empty_1 = true; $__currentLoopData = $medical_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500">
                <div class="py-4 px-8 mt-3">
                    <div class="flex flex-col mb-8">
                        <h2 class="text-gray-900 font-bold text-2xl tracking-wide mb-2"><?php echo e($record->name_of_record); ?> </h2>
                        <p class=" text-gray-500 text-base"><?php echo e($record->information); ?> </p>
                    </div>
                    <div class="flex justify-between">
                        <div class="my-auto">
                            <?php if($record->file_path): ?>
                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['wire:click' => 'downRecord( \''.e($record->file_path).'\' )','class' => 'ml-4 hover:text-blue-700 bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => 'downRecord( \''.e($record->file_path).'\' )','class' => 'ml-4 hover:text-blue-700 bg-transparent']); ?>Download Record <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            <?php else: ?>
                            <p class=" text-gray-500 text-base">No File</p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('doctors.view', $record->Doctor->id)); ?>">
                            <div class="hover:bg-blue-100 rounded-md py-2 px-2">
                                <img class="w-5 h-5 my-3 rounded-full mx-auto object-cover" src="<?php echo e($record->Doctor->profile_photo_url); ?>" alt="<?php echo e($record->Doctor->name); ?>">
                                <span><?php echo e("Dr." . $record->Doctor->name); ?> </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500 text-center">
                <h2 class="font-normal text-3xl text-gray-800 leading-tight py-4 px-8 mt-3">
                    No Medical Records
                </h2>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/livewire/patients/homepage.blade.php ENDPATH**/ ?>