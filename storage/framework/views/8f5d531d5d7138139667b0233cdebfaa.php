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
                                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($appointment->serviceType); ?></td>
                                        <td><?php echo e($appointment->appointmentDate); ?></td>
                                        <td><?php echo e($appointment->appointmentTime); ?></td>
                                        <td><?php echo e($appointment->status); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('appointments.cancel', $appointment->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <form action="<?php echo e(route('appointments.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
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
<?php /**PATH /Users/mac/Documents/3rdyr/LARAVEL2/laravel from git/autoservs1 2/resources/views/client/dashboard.blade.php ENDPATH**/ ?>