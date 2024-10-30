<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Button to trigger SweetAlert for account deletion -->
    <x-danger-button id="deleteAccountButton">
        {{ __('Delete Account') }}
    </x-danger-button>
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
                form.action = "{{ route('profile.destroy') }}";
                form.innerHTML = `
                    @csrf
                    @method('delete')
                    <input type="hidden" name="password" value="${result.value}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
</script>
