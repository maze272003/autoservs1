<section class="content">
    <div class="container-fluid">
        <h1>Client Dashboard</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Appointments</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->serviceType }}</td>
                                        <td>{{ $appointment->appointmentDate }}</td>
                                        <td>{{ $appointment->appointmentTime }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>
                                            <form action="{{ route('appointments.cancel', $appointment->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Book a New Appointment</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="serviceType">Service Type</label>
                                <input type="text" class="form-control" name="serviceType" id="serviceType" required>
                            </div>
                            <div class="form-group">
                                <label for="appointmentDate">Appointment Date</label>
                                <input type="date" class="form-control" name="appointmentDate" id="appointmentDate"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="appointmentTime">Appointment Time</label>
                                <input type="time" class="form-control" name="appointmentTime" id="appointmentTime"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Book Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
