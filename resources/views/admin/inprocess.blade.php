<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
<style>
    .modal-backdrop.show {
        opacity: 0.5;
        /* Adjust this value to make it less dark */
    }
    .text-darkred {
        background-color: #8B0000; /* Dark Red background color for button */
        border-radius: 4px; /* Optional: adds some border radius to the button */
    }
</style>

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
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('dist/img/autoservbg.png') }}" alt="AUTOSERV Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AUTOSERV</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->profile_image)
                            <img src="{{ Storage::url(Auth::user()->profile_image) }}"
                                style="height: 40px; width: 40px; border-radius: 50%;" alt="User Image">
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
                            <a href="{{ route('admin.inprocess') }}" class="nav-link active">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.response.messages') }}" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i> <!-- Changed icon to envelope -->
                                <p>View Messages</p> <!-- Updated text to reflect the view -->
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
            
                                                    <!-- Action Buttons -->
                                                    <td>
                                                        <!-- Add Parts Button -->
                                                        <a href="#" data-toggle="modal" data-target="#addPartsModal-{{ $process->id }}" class="text-success">
                                                            <i class="bx bx-plus-circle bx-md"></i>
                                                        </a>
            
                                                        <!-- View Parts Button -->
                                                        <a href="#" data-toggle="modal" data-target="#viewPartsModal-{{ $process->id }}" class="text-info">
                                                            <i class="bx bx-show bx-md"></i>
                                                        </a>
            
                                                       <!-- Mark as Done Button -->
                                                        <form action="{{ route('process.done', $process->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('PUT') <!-- Specify the method as PUT -->
                                                            <button type="submit" class="border-0 bg-transparent @if(!$process->proof_payment) text-darkred @endif" title="Mark as Done" @if(!$process->proof_payment) disabled @endif>
                                                                <i class="bx bx-check-circle bx-md" style="color: red;"></i>
                                                            </button>
                                                        </form>
            
                                                        <!-- Print Button -->
                                                        <button class="text-primary border-0 bg-transparent" data-toggle="modal" data-target="#printModal-{{ $process->id }}" @if(!$process->proof_payment) disabled @endif>
                                                            <i class="bx bx-printer bx-md"></i>
                                                        </button>
            
                                                        <!-- View Proof of Payment Icon -->
                                                        @if($process->proof_payment)
                                                            <a href="{{ asset('uploads/proofs/' . $process->proof_payment) }}" target="_blank" class="text-info">
                                                                <i class="bx bx-file bx-md" title="View Proof of Payment"></i>
                                                            </a>
                                                        @else
                                                            <i class="bx bx-file bx-md text-muted" title="No Proof of Payment Uploaded"></i>
                                                        @endif
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
                                                            <div class="modal-body" style="max-height: 400px; overflow-y: auto; position: relative;">
                                                                <!-- Fixed Search Input -->
                                                                <div class="form-group" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                                                    <input type="text" id="addPartsSearchInput-{{ $process->id }}" class="form-control" onkeyup="searchAddParts({{ $process->id }})" placeholder="Search for parts...">
                                                                </div>
                                                                <form id="addPartsForm-{{ $process->id }}" action="{{ route('client.parts.store') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="process_id" value="{{ $process->id }}">
                                                                    <div class="form-group">
                                                                        <label>Select Parts</label>
                                                                        <div id="addPartsList-{{ $process->id }}">
                                                                            @foreach ($parts as $part)
                                                                                <div class="form-check part-item">
                                                                                    <input class="form-check-input" type="checkbox" name="parts_ids[]" value="{{ $part->id }}" id="part-{{ $part->id }}">
                                                                                    <label class="form-check-label" for="part-{{ $part->id }}">
                                                                                        {{ $part->name_parts }} - ₱{{ $part->price }} (Qty: {{ $part->quantity }})
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer" style="position: sticky; bottom: 0; background-color: #fff;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" form="addPartsForm-{{ $process->id }}" class="btn btn-primary">Add Parts</button>
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
            <div class="modal-body" style="max-height: 400px; overflow-y: auto; position: relative;">
                <!-- Search Input -->
                <div class="form-group" style="position: sticky; top: 0; background-color: #fff; z-index: 1; padding: 0.5rem;">
                    <label for="viewPartsSearchInput-{{ $process->id }}">Search Parts</label>
                    <input type="text" id="viewPartsSearchInput-{{ $process->id }}" class="form-control" onkeyup="searchViewParts({{ $process->id }})" placeholder="Search for parts...">
                </div>
                <ul class="list-group" id="partsList-{{ $process->id }}">
                    @php
                        $clientParts = \App\Models\ClientPart::where('process_id', $process->id)->with('part')->get();
                        $totalPrice = 0;
                    @endphp
                    @forelse($clientParts as $clientPart)
                        <li class="list-group-item part-item" id="partItem-{{ $clientPart->id }}">
                            {{ $clientPart->part->name_parts ?? 'N/A' }} - ₱{{ $clientPart->part->price ?? 'N/A' }}
                            <button class="btn btn-danger btn-sm float-right" onclick="deletePart({{ $clientPart->id }}, {{ $process->id }})">Delete</button>
                        </li>
                        @php
                            $totalPrice += $clientPart->part->price ?? 0;
                        @endphp
                    @empty
                        <li class="list-group-item">No parts added.</li>
                    @endforelse
                </ul>
                @if ($totalPrice > 0)
                    <h5>Total Price: ₱{{ $totalPrice }}</h5>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


                                                            
                                                                                                <!-- Print Modal -->
                                                <div class="modal fade" id="printModal-{{ $process->id }}" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="printModalLabel">Receipt for {{ $process->user->name ?? 'N/A' }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="max-height: 400px; overflow-y: auto; position: relative;">
                                                                <!-- Sticky Header for Process ID, Owner, and Total Price -->
                                                                <div style="position: sticky; top: 0; background-color: #fff; z-index: 1; padding: 10px;">
                                                                    <h6>Process ID: {{ $process->id }}</h6>
                                                                    <h6>Owner: {{ $process->user->name ?? 'N/A' }}</h6>
                                                                    <h6>Total Price: ₱<span id="totalPrice-{{ $process->id }}">{{ $totalPrice }}</span></h6>
                                                                </div>

                                                                <h6>Parts:</h6>
                                                                <ul id="partsList-{{ $process->id }}" class="list-group">
                                                                    @foreach ($clientParts as $clientPart)
                                                                        <li class="list-group-item">
                                                                            {{ $clientPart->part->name_parts ?? 'N/A' }} - ₱{{ $clientPart->part->price ?? 'N/A' }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" onclick="printReceipt('{{ $process->id }}')" @if(!$process->proof_payment) disabled @endif>
                                                                    Print
                                                                </button>
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
            <strong>Copyright &copy; 2022-2024 <a href="https://github.com/maze272003/autoservs1.git">AUTOSERV</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> v1
            </div>
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>
<script>
    function printReceipt(processId) {
        // Get the process data dynamically
        const processIdElement = document.querySelector(`#printModal-${processId} h6:nth-child(1)`).innerText;
        const ownerElement = document.querySelector(`#printModal-${processId} h6:nth-child(2)`).innerText;
        const totalPriceElement = document.querySelector(`#totalPrice-${processId}`).innerText;
        const partsListElement = document.querySelectorAll(`#partsList-${processId} .list-group-item`);

        // Prepare the content in a string format resembling a table
        let receiptContent =
            `${processIdElement}\n${ownerElement}\nTotal Price: ₱${totalPriceElement}\n\nParts List:\n`;
        receiptContent += "-----------------------------\n";
        receiptContent += "Part Name\t\tPrice\n";
        receiptContent += "-----------------------------\n";

        // Loop through parts and add each to the receipt content
        partsListElement.forEach((item) => {
            let partText = item.innerText.split(" - ");
            receiptContent += `${partText[0]}\t\t${partText[1]}\n`;
        });

        receiptContent += "-----------------------------\n";
        receiptContent += `Total Price: ₱${totalPriceElement}\n`;

        // Open a new window and print only the text content, styled for A5
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Receipt</title>');

        // Add CSS for A5 paper and to remove blank spaces
        printWindow.document.write(`
        <style>
            @page {
                size: A5;
                margin: 0;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 10mm;
            }
            pre {
                font-size: 12px;
                line-height: 1.5;
            }
        </style>
    </head><body><pre>`);

        printWindow.document.write(receiptContent); // Adding the formatted content to the window
        printWindow.document.write('</pre></body></html>');
        printWindow.document.close();
        printWindow.focus();

        // Trigger the print functionality
        printWindow.print();
        printWindow.close();
    }
</script>
<script>
    function searchAddParts(processId) {
        const input = document.getElementById(`addPartsSearchInput-${processId}`);
        const filter = input.value.toLowerCase();
        const partsList = document.getElementById(`addPartsList-${processId}`);
        const partItems = partsList.getElementsByClassName('part-item');

        for (let i = 0; i < partItems.length; i++) {
            const label = partItems[i].getElementsByTagName('label')[0];
            if (label) {
                const txtValue = label.textContent || label.innerText;
                partItems[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }

    function searchViewParts(processId) {
        const input = document.getElementById(`viewPartsSearchInput-${processId}`);
        const filter = input.value.toLowerCase();
        const partsList = document.getElementById(`partsList-${processId}`);
        const partItems = partsList.getElementsByClassName('part-item');

        for (let i = 0; i < partItems.length; i++) {
            const text = partItems[i].textContent || partItems[i].innerText;
            partItems[i].style.display = text.toLowerCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
</script>
<script>
    function deletePart(partId, processId) {
        if (!confirm("Are you sure you want to delete this part?")) return;
    
        // Make an AJAX request to delete the part
        fetch(`/admin/processes/${processId}/delete-part/${partId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the part from the DOM
                document.getElementById(`partItem-${partId}`).remove();
                alert("Part deleted successfully!");
            } else {
                alert("Failed to delete the part.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
        });
    }
    </script>
    
</html>
