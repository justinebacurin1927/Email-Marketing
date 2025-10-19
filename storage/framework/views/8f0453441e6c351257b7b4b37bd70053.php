<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'type', 'image']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title', 'type', 'image']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="border rounded p-3 text-center">
  <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" class="img-fluid mb-2" style="height: 8rem; object-fit: cover; width: 100%;">
  <h3 class="fw-semibold mb-1"><?php echo e($title); ?></h3>
  <p class="text-muted small mb-0"><?php echo e($type); ?></p>
</div>
<?php /**PATH /var/www/html/resources/views/components/template-card.blade.php ENDPATH**/ ?>