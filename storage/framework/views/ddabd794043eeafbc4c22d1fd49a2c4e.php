<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            <?php echo e(__('Delete Account')); ?>

        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            <?php echo e(__('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')); ?>

        </p>
    </header>

    <!-- Button to trigger SweetAlert for account deletion -->
    <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => ['id' => 'deleteAccountButton']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deleteAccountButton']); ?>
        <?php echo e(__('Delete Account')); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
</section>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('deleteAccountButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default button action

        // SweetAlert configuration for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "Once your account is deleted, all of its resources and data will be permanently deleted.",
            icon: 'warning',
            input: 'password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete Account',
            preConfirm: (password) => {
                if (!password) {
                    Swal.showValidationMessage('Please enter your password');
                }
                return password;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a hidden form to submit the password for deletion
                const form = document.createElement('form');
                form.method = 'post';
                form.action = "<?php echo e(route('profile.destroy')); ?>";
                form.innerHTML = `
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="password" value="${result.value}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
</script>
<?php /**PATH C:\Users\John Michael Jonatas\Documents\advanceprog\autoservs1\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>