<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
		<ul class="breadcrumb">
				<li>Dashboard</li>
		</ul>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card bg-1">
            <img src="<?php echo e(asset('template/kontributor/img/icon/5.png')); ?>" alt="" />
            <p class="card-title"><?php echo e(badge()); ?></p>
            <p class="card-desc">Kredibilitas Anda</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-2">
            <img src="<?php echo e(asset('template/kontributor/img/icon/3.png')); ?>" alt="" />
            <p class="card-title"><?php echo e(points()); ?></p>
            <p class="card-desc">Poin Anda</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-3">
            <img src="<?php echo e(asset('template/kontributor/img/icon/2.png')); ?>" alt="" />
            <p class="card-title">Rp. <?php echo e(income()); ?></p>
            <p class="card-desc">Pendapatan Bulan ini</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="<?php echo e(asset('template/kontributor/img/icon/6.png')); ?>" alt="" />
            <p class="card-title"><?php echo e(lessons_publish()); ?></p>
            <p class="card-desc">Tutorial terpublish</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="<?php echo e(asset('template/kontributor/img/icon/4.png')); ?>" alt="" />
            <p class="card-title"><?php echo e(lessons_pending()); ?></p>
            <p class="card-desc">Tutorial belum terverifikasi</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="<?php echo e(asset('template/kontributor/img/icon/1.png')); ?>" alt="" />
            <p class="card-title"><?php echo coments();?></p>
            <p class="card-desc">Pertanyaan belum terjawab</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>