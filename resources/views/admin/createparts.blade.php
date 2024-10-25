<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Parts</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">

                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item"><i class="fas fa-user"></i>
                            {{ __('Profile') }}</a>
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
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('dist/img/autoservbg.png') }}" alt="AUTOSERV Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AUTOSERV</span>
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
                            <a href="{{ route('admin.createparts') }}" class="nav-link active">
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
                            <a href="{{ route('admin.history.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>View History</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Parts</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Create Parts</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-header">
                                    <h2>Create New Part</h2>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('parts.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name_parts">Part Name:</label>
                                            <input type="text" class="form-control" id="name_parts"
                                                name="name_parts" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="number" step="0.01" class="form-control" id="price"
                                                name="price" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" class="form-control" id="quantity"
                                                name="quantity" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create Part</button>
                                    </form>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h2>All Parts</h2>
                                </div>
                                <div class="card-body">
                                    <!-- Search Input -->
                                <div class="form-group">
                                    <input type="text" id="searchInput" class="form-control" onkeyup="searchParts()" placeholder="Search for part names...">
                                </div>

                                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-striped" id="partsTable">
                                            <thead>
                                                <tr>
                                                    <th>Part Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Created At</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parts as $part)
                                                    <tr>
                                                        <td>{{ $part->name_parts }}</td>
                                                        <td>₱{{ number_format($part->price, 2) }}</td>
                                                        <td>{{ $part->quantity }}</td>
                                                        <td>{{ $part->created_at->format('Y-m-d H:i:s') }}</td>
                                                        <td>
                                                            <!-- Edit Button -->
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                                data-target="#editModal-{{ $part->id }}">Edit</button>
                                    
                                                            <!-- Delete Button -->
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#deleteModal-{{ $part->id }}">Delete</button>
                                    
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="editModal-{{ $part->id }}" tabindex="-1" role="dialog"
                                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('parts.update', $part->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="editModalLabel">Edit Part</h5>
                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="name_parts">Part Name:</label>
                                                                                    <input type="text" class="form-control" id="name_parts"
                                                                                        name="name_parts" value="{{ $part->name_parts }}" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="price">Price:</label>
                                                                                    <input type="number" step="0.01" class="form-control" id="price"
                                                                                        name="price" value="{{ $part->price }}" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="quantity">Quantity:</label>
                                                                                    <input type="number" class="form-control" id="quantity"
                                                                                        name="quantity" value="{{ $part->quantity }}" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Update Part</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="deleteModal-{{ $part->id }}" tabindex="-1" role="dialog"
                                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Part</h5>
                                                                            <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete this part?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{ route('parts.destroy', $part->id) }}" method="POST"
                                                                                class="d-inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                                            </form>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022-2024 <a href="https://github.com/maze272003/autoservs1.git">AUTOSERV</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> v1
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
<!-- Search Script -->
<script>
    function searchParts() {
        // Get the value of the search input
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('partsTable');
        const tr = table.getElementsByTagName('tr');

        // Loop through all table rows (except the first, which is the header)
        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td')[0]; // Get the Part Name column (index 0)
            if (td) {
                const txtValue = td.textContent || td.innerText;
                // Display the row if it matches the search input
                tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }
</script>

</html>
