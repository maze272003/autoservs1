<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <style>
            /* Centering the modal */
            #imageModal {
                display: none;
                align-items: center;
                justify-content: center;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.8);
                z-index: 9999;
            }

            /* Styles for mobile view */
            #modalImage {
                width: 80vw;
                height: auto;
            }

            /* Media query for desktop view */
            @media (min-width: 800px) {
                #modalImage {
                    width: 750px;
                    height: 900px;
                }
            }

            /* Style for close button */
            #imageModal .close-btn {
                position: absolute;
                top: -5px;
                right: 15px;
                font-size: 40px;
                color: white;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

                <!-- Profile Image Upload Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4 flex justify-center">
                            <?php if(auth()->user()->profile_image): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->profile_image)); ?>" alt="Profile Image" class="rounded-full h-32 w-32 object-cover cursor-pointer" onclick="openModal('<?php echo e(asset('storage/' . auth()->user()->profile_image)); ?>')">
                            <?php else: ?>
                                <img src="<?php echo e(asset('default-150x150.png')); ?>" alt="Default Profile Image" class="rounded-full h-32 w-32 object-cover cursor-pointer" onclick="openModal('<?php echo e(asset('default-150x150.png')); ?>')">
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col justify-center">
                            <h2 class="text-xl font-semibold text-gray-900"><?php echo e(auth()->user()->name); ?></h2>
                            <p class="text-gray-700"><?php echo e(auth()->user()->email); ?></p>
                        </div>
                        <form method="POST" action="<?php echo e(route('profile.updateImage')); ?>" enctype="multipart/form-data" id="profileImageForm" class="md:col-span-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-4">
                                <label for="profile_image" class="block text-sm font-medium text-gray-700">Upload New Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full" accept="image/*">
                            </div>
                            <div class="flex items-center">
                                <button type="button" onclick="confirmImageUpdate()" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Profile Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

               <!-- Email Verification Section -->
<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    <?php echo e(__('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')); ?>

</div>

<?php if(session('status') == 'verification-link-sent'): ?>
    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
        <?php echo e(__('A new verification link has been sent to the email address you provided during registration.')); ?>

    </div>
<?php endif; ?>

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="<?php echo e(route('verification.send')); ?>" id="resendVerificationForm">
        <?php echo csrf_field(); ?>
        <div>
            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'resendVerificationButton']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'resendVerificationButton']); ?>
                <?php echo e(__('Resend Verification Email')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
        </div>
    </form>
</div>

                <!-- Profile Information Update Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <!-- Password Update Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <!-- Delete User Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        <?php echo $__env->make('profile.partials.delete-user-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for displaying the larger profile image -->
        <div id="imageModal" class="fixed inset-0 hidden justify-center items-center z-50">
            <div class="relative">
                <img id="modalImage" src="" alt="Large Profile Image" class="rounded-lg max-w-full max-h-full mx-auto">
                <button onclick="closeModal()" class="close-btn">&times;</button>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function openModal(imageUrl) {
                document.getElementById('modalImage').src = imageUrl;
                document.getElementById('imageModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('imageModal').style.display = 'none';
            }

            function confirmImageUpdate() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to update your profile image!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('profileImageForm').submit();
                    }
                });
            }
        </script>
    </body>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('resendVerificationButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Submit the form via AJAX
        fetch("<?php echo e(route('verification.send')); ?>", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json',
            },
        }).then(response => {
            if (response.ok) {
                // Show SweetAlert notification in the top-right corner
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Verification email sent!',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                // Handle error if needed
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to resend email.',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }).catch(error => {
            console.error('Error:', error);
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'An error occurred. Try again later.',
                showConfirmButton: false,
                timer: 3000
            });
        });
    });
</script>
    </html>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravelfromgit/Autoservs1stSem/resources/views/profile/edit.blade.php ENDPATH**/ ?>