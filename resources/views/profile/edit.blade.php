<x-app-layout>
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
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="rounded-full h-32 w-32 object-cover cursor-pointer" onclick="openModal('{{ asset('storage/' . auth()->user()->profile_image) }}')">
                            @else
                                <img src="{{ asset('default-150x150.png') }}" alt="Default Profile Image" class="rounded-full h-32 w-32 object-cover cursor-pointer" onclick="openModal('{{ asset('default-150x150.png') }}')">
                            @endif
                        </div>
                        <div class="flex flex-col justify-center">
                            <h2 class="text-xl font-semibold text-gray-900">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-700">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('profile.updateImage') }}" enctype="multipart/form-data" id="profileImageForm" class="md:col-span-2">
                            @csrf
                            @method('PUT')
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
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div>
                            <x-primary-button>
                                {{ __('Resend Verification Email') }}
                            </x-primary-button>
                        </div>
                    </form>
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

    </html>
</x-app-layout>
