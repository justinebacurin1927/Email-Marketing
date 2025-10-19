<section class="px-3 py-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h6 fw-semibold mb-0">Grow your audience with custom popup forms <span class="badge bg-light text-dark">Beta</span></h2>
    <a href="#" class="text-decoration-none">View all popup forms →</a>
  </div>

  <div class="row g-3">
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100">
          <img src="<?php echo e($card['image']); ?>" class="card-img-top" alt="<?php echo e($card['alt']); ?>">
          <div class="card-body">
            <h5 class="card-title"><i class="<?php echo e($card['icon']); ?>"></i> <?php echo e($card['title']); ?></h5>
            <p class="card-text"><?php echo e($card['text']); ?></p>
            <a href="<?php echo e($card['link']); ?>" class="text-primary"><?php echo e($card['linkText']); ?></a>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</section>
<?php /**PATH /var/www/html/resources/views/components/popup-cards.blade.php ENDPATH**/ ?>