<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Members
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                List
                            </h2>
                            <div class="header-dropdown m-r--5">
                                <a href="<?php echo e(url('system/members/create')); ?>" class="btn btn-primary waves-effect">Create Member</a>
                            </div>
                        </div>
                        <div class="body">

                            <?php echo $__env->make('admin.include.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $member): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td><?php echo e($member->id); ?></td>
                                    <td>
                                      <?php if ($member->status == 1): ?>
                                          <div class="label label-success">Active</div>
                                      <?php else: ?>
                                          <div class="label label-danger">non active</div>
                                      <?php endif; ?>
                                    </td>
                                    <td><?php echo e($member->username); ?></td>
                                    <td><?php echo e($member->email); ?></td>
                                    <td><?php echo e($member->created_at); ?></td>
                                    <td><?php echo e($member->updated_at); ?></td>
                                    <td>
                                        <form id="<?php echo e($member->id); ?>" action="<?php echo e(url('system/members/'.$member->id)); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <a href="<?php echo e(url('system/members/'.$member->id)); ?>/edit" class="btn bg-pink waves-effect"><i class="material-icons">mode_edit</i></a>
                                                <button type="button" class="btn bg-pink waves-effect" onclick="if (confirm('Are you sure?')) { $('#<?php echo e($member->id); ?>').submit() }"><i class="material-icons">delete</i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Status</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>