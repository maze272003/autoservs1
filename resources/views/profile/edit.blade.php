<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Include SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

    <body>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                <!-- Profile Image Upload Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Display the current profile image -->
                        <div class="mb-4 flex justify-center">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="rounded-full h-32 w-32 object-cover">
                            @else
                                <img src="{{ asset('default-avatar.png') }}" alt="Default Profile Image" class="rounded-full h-32 w-32 object-cover">
                            @endif
                        </div>
                
                        <!-- User Information -->
                        <div class="flex flex-col justify-center">
                            <h2 class="text-xl font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-700">{{ auth()->user()->email }}</p>
                            <!-- Add more user information as needed -->
                        </div>
                
                        <!-- Form to upload new profile image -->
                        <form method="POST" action="{{ route('profile.updateImage') }}" enctype="multipart/form-data" id="profileImageForm" class="md:col-span-2">
                            @csrf
                            @method('PUT')
                
                            <div class="mb-4">
                                <label for="profile_image" class="block text-sm font-medium text-gray-700">Upload New Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full" accept="image/*" capture="environment">
                            </div>
                
                            <div class="flex items-center">
                                <button type="button" onclick="confirmImageUpdate()"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Profile Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                

                <!-- Profile Information Update Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Update Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User Section -->
                <div class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Include SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
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
                        document.getElementById('profileImageForm').submit(); // Submit the form
                    }
                });
            }

            // Add similar confirm functions for other actions (if needed)
        </script>
    </body>

    </html>
</x-app-layout>
