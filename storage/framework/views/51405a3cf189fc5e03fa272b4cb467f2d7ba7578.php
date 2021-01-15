 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Manage User Accounts')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div>
        <div class="py-10 sm:px-6 lg:px-8">
            <div class="py-5 flex justify-end">
                <a href="<?php echo e(route('users.add')); ?>">
                     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => []]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                        <?php echo e(__('Add User Account')); ?>

                     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                </a>
            </div>

            <!--Search Bar -->
            <form method="GET" action="<?php echo e(route('users.search')); ?>">
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
            <?php if(isset($message)): ?>
            <div class="py-4 px-2 ">
                <div class="bg-green-100 border-l-4 border-green text-green-900 p-4" role="alert">
                    <p class="font-bold"><?php echo e($message); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Name</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Email</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Contact Number</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Roles</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($user->id); ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($user->name); ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($user->email); ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center"><?php echo e($user->contact_number); ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <div class="flex">
                                    <?php if($user->roles->first()->name === 'admin'): ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs"><?php echo e($user->roles->first()->name); ?></span>
                                    </span>
                                    <?php elseif( $user->roles->first()->name === 'internal'): ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center"><?php echo e($user->roles->first()->name); ?></span>
                                    </span>
                                    <?php elseif($user->roles->first()->name === 'external'): ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-purple-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-purple-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center"><?php echo e($user->roles->first()->name); ?></span>
                                    </span>
                                    <?php elseif($user->roles->first()->name === 'employee'): ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-gray-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center"><?php echo e($user->roles->first()->name); ?></span>
                                    </span>
                                    <?php else: ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-blue-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center"><?php echo e($user->roles->first()->name); ?></span>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <div class="flex">
                                    <form method="GET" action="<?php echo e(route('users.edit')); ?>">
                                        <input name="userId" value="<?php echo e($user->id); ?>" type="hidden">
                                        <button class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                <title>Edit User</title>
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('delete-user-button', [$user])->html();
} elseif ($_instance->childHasBeenRendered('LrbNLtK')) {
    $componentId = $_instance->getRenderedChildComponentId('LrbNLtK');
    $componentTag = $_instance->getRenderedChildComponentTagName('LrbNLtK');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('LrbNLtK');
} else {
    $response = \Livewire\Livewire::mount('delete-user-button', [$user]);
    $html = $response->html();
    $_instance->logRenderedChild('LrbNLtK', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    <?php echo e($users->links()); ?>

                </div>
            </div>
        </div>
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
</script><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/user/main.blade.php ENDPATH**/ ?>