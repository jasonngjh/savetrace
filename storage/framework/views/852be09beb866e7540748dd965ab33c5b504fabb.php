 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Search Patients')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 sm:px-6 lg:px-8">
        <!--Search Bar -->
        <form method="GET" action="<?php echo e(route('patients.search')); ?>">
            <?php echo csrf_field(); ?>
            <div class="shadow flex">
                <input id="q" onkeyup="checkEmpty()" class="flex-auto w-full rounded p-2" type="text" placeholder="Search" name="q">
                <button id="submit" class="bg-white w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400" disabled>
                    <svg class="w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>

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


        <?php if(empty($patients)): ?>
        <div>TODO: empty patient page</div>
        <?php else: ?>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Age</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Contact Number</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($patient->id); ?></span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($patient->name); ?></span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($patient->age); ?></span>
                        </td>
                        <td class="border-dashed border-t border-gray-200">
                            <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($patient->contact_number); ?></span>
                        </td>
                        <td class="border-dashed border-t border-gray-200">
                            <div class="flex">
                                <form method="GET" action="<?php echo e(route('users.edit')); ?>">
                                    <input name="userId" value="<?php echo e($patient->id); ?>" type="hidden">
                                    <button class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <title>View User</title>
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <?php echo e($patients->links()); ?>

            </div>
        </div>
        <?php endif; ?>

    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 


<script>
    function checkEmpty() {
        if (document.getElementById("q").value === "") {
            document.getElementById('submit').disabled = true;
        } else {
            document.getElementById('submit').disabled = false;
        }
    }
</script><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/patients/index.blade.php ENDPATH**/ ?>