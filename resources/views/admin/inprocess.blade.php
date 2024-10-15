<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Processes</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user"></i> {{ __('Profile') }}
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->profile_image)
                        <img src="{{ Storage::url(Auth::user()->profile_image) }}" style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('user.statistics') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Table All Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.createparts') }}" class="nav-link">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Add new parts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    Process car
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.inprocess') }}" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    View Inprocess
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('history.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    View history
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Processes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Processes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Process Table</h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="max-height: 680px; overflow-y: auto;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Owner</th>
                                                <th>Car Model</th>
                                                <th>Service Type</th>
                                                <th>Car Issue</th>
                                                <th>Appointment Date</th>
                                                <th>Appointment Time</th>
                                                <th>Plate Number</th>
                                                <th>Additional Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($processes as $process)
                                                <tr>
                                                    <td>{{ $process->id }}</td>
                                                    <td>{{ $process->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $process->carModel }}</td>
                                                    <td>{{ $process->serviceType }}</td>
                                                    <td>{{ $process->carIssue }}</td>
                                                    <td>{{ $process->appointmentDate }}</td>
                                                    <td>{{ $process->appointmentTime }}</td>
                                                    <td>{{ $process->plateNumber }}</td>
                                                    <td>{{ $process->additionalNotes }}</td>
                                
                                                    <!-- Action Buttons with Boxicons -->
                                                    <td>
                                                        <!-- Add Parts Button with Boxicons -->
                                                        <a href="#" data-toggle="modal" data-target="#addPartsModal-{{ $process->id }}" class="text-success">
                                                            <i class="bx bx-plus-circle bx-md"></i> <!-- Slightly smaller plus-circle icon for Add Parts -->
                                                        </a>
                                                        
                                                        <!-- View Parts Button with Boxicons -->
                                                        <a href="#" data-toggle="modal" data-target="#viewPartsModal-{{ $process->id }}" class="text-info">
                                                            <i class="bx bx-show bx-md"></i> <!-- Slightly smaller eye icon for View Parts -->
                                                        </a>
                                                        
                                                        <!-- Done Button with Boxicons -->
                                                        <form action="{{ route('process.done', $process->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="text-danger border-0 bg-transparent">
                                                                <i class="bx bx-check-circle bx-md"></i> <!-- Slightly smaller check-circle icon for Done -->
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                
                                                <!-- Modal for Adding Parts -->
                                                <div class="modal fade" id="addPartsModal-{{ $process->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add Parts for {{ $process->user->name ?? 'N/A' }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('client.parts.store') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id" value="{{ $process->user_id }}">
                                                                    <div class="form-group">
                                                                        <label>Select Parts</label>
                                                                        <div>
                                                                            @foreach ($parts as $part)
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="parts_ids[]" value="{{ $part->id }}" id="part-{{ $part->id }}">
                                                                                    <label class="form-check-label" for="part-{{ $part->id }}">
                                                                                        {{ $part->name_parts }} - ${{ $part->price }} (Qty: {{ $part->quantity }})
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Add Parts</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <!-- Modal for Viewing Parts -->
                                                <div class="modal fade" id="viewPartsModal-{{ $process->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPartsModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewPartsModalLabel">Parts for {{ $process->user->name ?? 'N/A' }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    @php
                                                                        $clientParts = \App\Models\ClientPart::where('user_id', $process->user_id)
                                                                            ->with('part')
                                                                            ->get();
                                                                        $totalPrice = 0; // Initialize total price
                                                                    @endphp
                                                                    @forelse($clientParts as $clientPart)
                                                                        <li class="list-group-item">
                                                                            {{ $clientPart->part->name_parts ?? 'N/A' }} - ${{ $clientPart->part->price ?? 'N/A' }}
                                                                        </li>
                                                                        @php
                                                                            $totalPrice += $clientPart->part->price ?? 0;
                                                                        @endphp
                                                                    @empty
                                                                        <li class="list-group-item">No parts added.</li>
                                                                    @endforelse
                                                                </ul>
                                                                @if ($totalPrice > 0)
                                                                    <h5>Total Price: ${{ $totalPrice }}</h5>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2023 <a href="#">AdminLTE</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
