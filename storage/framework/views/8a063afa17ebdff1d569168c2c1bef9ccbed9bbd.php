<div class="w-full h-screen">
    <?php echo csrf_field(); ?>
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        Find a Doctor
    </h2>
    <div class="py-5 px-3">

        <hr>
    </div>

    <div class="py-5 px-3 w-full" submit="search">
        <!--Search Bar -->
         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'q','wire:model' => 'q','class' => 'block mt-1 w-full','type' => 'text','name' => 'q']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'q','wire:model' => 'q','class' => 'block mt-1 w-full','type' => 'text','name' => 'q']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    </div>

    <div class="px-4 pt-4 grid">
        <div class="space-y-8 grid md:grid-cols-4 grid-cols-1">
            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-span-1 bg-white shadow-xl rounded-lg :hover='bg-blue-100' ">
                <div class="mt-2">
                    <img class="w-20 h-20 rounded-full mx-auto object-cover" src="<?php echo e($doctor->profile_photo_url); ?>" alt="<?php echo e($doctor->name); ?>">
                </div>
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8"><?php echo e("Dr ". $doctor->name); ?></h3>
                    <div class="text-center text-gray-400 text-xs font-semibold">
                        <p><?php echo e($doctor->specialty); ?></p>
                    </div>
                    <table class="text-xs my-3">
                        <tbody>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-semibold">Phone</td>
                                <td class="px-2 py-2"><?php echo e($doctor->contact); ?></td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-semibold">Email</td>
                                <td class="px-2 py-2"><?php echo e($doctor->email); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center my-3">
                        <a class="text-xs text-blue-500 italic hover:underline hover:text-blue-600 font-medium" href="#">View Profile</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/livewire/search-all-doctors.blade.php ENDPATH**/ ?>