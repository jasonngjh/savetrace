<div class="py-4 px-4">
    <div class="bg-white border shadow-sm px-4 py-3 rounded-lg w-full">
        <div class="flex items-center">
            <div class="grid grid-cols-3 w-full">
                <div class="py-4 flex flex-col col-span-2">
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        Dr. <?php echo e($doctor['name']); ?>

                    </h2>
                    <p class="py-3 font-semibold text-xl text-gray-500 leading-tight">
                        <?php echo e($doctor['specialty']); ?>

                    </p>
                    <p class="py-1 font-semibold text-xl text-gray-700 leading-tight">
                        <?php echo e($doctor['contact']); ?>

                    </p>
                    <p class="pt-4 font-semibold text-xl text-gray-700 leading-tight">
                        <?php echo e($doctor['practice_place_details']['address']); ?>

                    </p>
                    <p class="pt-2 font-semibold text-xl text-gray-700 leading-tight">
                        <?php echo e($doctor['practice_place_details']['name']); ?>

                    </p>

                </div>
                <div class="flex-col col-span-1 justify-center content-end hidden md:flex">
                    <img class="w-40 h-40 my-3 rounded-full mx-auto object-cover" src="<?php echo e($doctor['profile_photo_url']); ?>" alt="<?php echo e($doctor['name']); ?>">
                    <div class="text-center">
                        <h2 class="py-5 font-semibold text-l text-gray-800 leading-tight">
                            <?php echo e($doctor['internal'] ? 'Internal Doctor' : 'External Doctor'); ?>

                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/livewire/view-doctor-information-card.blade.php ENDPATH**/ ?>