<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal5e647166f667c4cebf02fc514fb4ba23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5e647166f667c4cebf02fc514fb4ba23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header-home','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header-home'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5e647166f667c4cebf02fc514fb4ba23)): ?>
<?php $attributes = $__attributesOriginal5e647166f667c4cebf02fc514fb4ba23; ?>
<?php unset($__attributesOriginal5e647166f667c4cebf02fc514fb4ba23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5e647166f667c4cebf02fc514fb4ba23)): ?>
<?php $component = $__componentOriginal5e647166f667c4cebf02fc514fb4ba23; ?>
<?php unset($__componentOriginal5e647166f667c4cebf02fc514fb4ba23); ?>
<?php endif; ?>

  <style>
  /* Buttons hover effect */
  .btn-outline-primary:hover {
    background-color: #0d6efd; /* new background color */
    color: #ffffff; /* text color on hover */
    border-color: #0d6efd; /* optional: change border color to match background */
  }

  /* Optional: active/click effect */
  .btn-outline-primary:active, .btn-outline-primary:focus {
    background-color: #0a58ca;
    color: #ffffff;
    border-color: #0a58ca;
  }
</style>


  <!-- Dashboard Tasks Section -->
  <div class="px-3 px-md-4">
    <header class="mb-4">
      <h1 class="h4 fw-bold text-dark">Dashboard</h1>
      <p class="text-secondary small">Manage your email templates and campaigns</p>
    </header>

    <section class="mb-4">
      <h2 class="h6 fw-semibold mb-3">Tasks</h2>
      <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">
          <?php if (isset($component)) { $__componentOriginal83d62da4ee056f5a3252ae026668091d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83d62da4ee056f5a3252ae026668091d = $attributes; } ?>
<?php $component = App\View\Components\TaskCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('task-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TaskCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Design new email','time' => '2h ago']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal83d62da4ee056f5a3252ae026668091d)): ?>
<?php $attributes = $__attributesOriginal83d62da4ee056f5a3252ae026668091d; ?>
<?php unset($__attributesOriginal83d62da4ee056f5a3252ae026668091d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal83d62da4ee056f5a3252ae026668091d)): ?>
<?php $component = $__componentOriginal83d62da4ee056f5a3252ae026668091d; ?>
<?php unset($__componentOriginal83d62da4ee056f5a3252ae026668091d); ?>
<?php endif; ?>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <?php if (isset($component)) { $__componentOriginal83d62da4ee056f5a3252ae026668091d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83d62da4ee056f5a3252ae026668091d = $attributes; } ?>
<?php $component = App\View\Components\TaskCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('task-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TaskCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Send campaign','time' => '1h ago']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal83d62da4ee056f5a3252ae026668091d)): ?>
<?php $attributes = $__attributesOriginal83d62da4ee056f5a3252ae026668091d; ?>
<?php unset($__attributesOriginal83d62da4ee056f5a3252ae026668091d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal83d62da4ee056f5a3252ae026668091d)): ?>
<?php $component = $__componentOriginal83d62da4ee056f5a3252ae026668091d; ?>
<?php unset($__componentOriginal83d62da4ee056f5a3252ae026668091d); ?>
<?php endif; ?>
        </div>
      </div>
    </section>
  </div>

  <div class="px-3 px-md-4 mb-4">
    <h4>Finish setting up your account</h4>
    <div class="progress" style="height: 8px;">
      <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <small class="text-muted d-block mt-2 mb-3">0 of 4 tasks completed</small>

    <!-- Task Slider -->
    <div class="d-flex overflow-auto gap-3" style="padding-bottom: 1px;">
      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Add your contacts</h6>
          <p class="card-text small">Upload your list of subscribers or import them from another app.</p>
          <small class="text-muted">4 min</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Connect an integration</h6>
          <p class="card-text small">Leverage data to create more automated, personalized omni-channel marketing communications.</p>
          <small class="text-muted">2 min</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Import your brand</h6>
          <p class="card-text small">We’ll create email designs using your fonts, logos, colors, and images.</p>
          <small class="text-muted">2 seconds</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Authenticate your email domain</h6>
          <p class="card-text small">Strongly recommended to improve deliverability, avoid spam folders, and build your sender reputation.</p>
          <small class="text-muted">4 min</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Templates Section -->
  <div class="px-3 px-md-4">
    <section class="mb-4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h6 fw-semibold mb-0">Start with a template</h2>
        <a href="#" class="text-decoration-none">View all templates</a>
      </div>

      <div class="d-flex gap-2 mb-3 flex-wrap">
        <button class="btn btn-outline-primary">All</button>
        <button class="btn btn-outline-primary">Email</button>
        <button class="btn btn-outline-primary">Automation</button>
      </div>

      <div class="row g-3">
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <?php if (isset($component)) { $__componentOriginal3e36de62403e5b8adf01c7a3001526db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e36de62403e5b8adf01c7a3001526db = $attributes; } ?>
<?php $component = App\View\Components\TemplateCard::resolve(['title' => 'Custom email design','type' => 'Free','image' => '/img/template1.png'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('template-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TemplateCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $attributes = $__attributesOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $component = $__componentOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__componentOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <?php if (isset($component)) { $__componentOriginal3e36de62403e5b8adf01c7a3001526db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e36de62403e5b8adf01c7a3001526db = $attributes; } ?>
<?php $component = App\View\Components\TemplateCard::resolve(['title' => 'Start from scratch','type' => 'Email','image' => '/img/template2.png'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('template-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TemplateCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $attributes = $__attributesOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $component = $__componentOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__componentOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <?php if (isset($component)) { $__componentOriginal3e36de62403e5b8adf01c7a3001526db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e36de62403e5b8adf01c7a3001526db = $attributes; } ?>
<?php $component = App\View\Components\TemplateCard::resolve(['title' => 'Welcome new contacts','type' => 'Automation','image' => '/img/template3.png'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('template-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TemplateCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $attributes = $__attributesOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $component = $__componentOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__componentOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <?php if (isset($component)) { $__componentOriginal3e36de62403e5b8adf01c7a3001526db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e36de62403e5b8adf01c7a3001526db = $attributes; } ?>
<?php $component = App\View\Components\TemplateCard::resolve(['title' => '1:3:1 Column','type' => 'Email','image' => '/img/template4.png'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('template-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TemplateCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $attributes = $__attributesOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $component = $__componentOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__componentOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <?php if (isset($component)) { $__componentOriginal3e36de62403e5b8adf01c7a3001526db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e36de62403e5b8adf01c7a3001526db = $attributes; } ?>
<?php $component = App\View\Components\TemplateCard::resolve(['title' => 'Minimal','type' => 'Email','image' => '/img/template5.png'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('template-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TemplateCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $attributes = $__attributesOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__attributesOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e36de62403e5b8adf01c7a3001526db)): ?>
<?php $component = $__componentOriginal3e36de62403e5b8adf01c7a3001526db; ?>
<?php unset($__componentOriginal3e36de62403e5b8adf01c7a3001526db); ?>
<?php endif; ?>
        </div>
      </div>

      <div class="mt-3 text-end">
        <button class="btn btn-outline-primary">Start from Scratch</button>
      </div>
    </section>
  </div>

  <?php if (isset($component)) { $__componentOriginal9bca19bfff79af53eea43b336e210254 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bca19bfff79af53eea43b336e210254 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popup-cards','data' => ['cards' => [
    ['image'=>'/img/popup1.png','alt'=>'Discount popup','icon'=>'bi bi-tag','title'=>'Discount popup','text'=>'Offer a discount to new subscribers','link'=>'#','linkText'=>'See discount templates'],
    ['image'=>'/img/popup2.png','alt'=>'Newsletter popup','icon'=>'bi bi-send','title'=>'Newsletter popup','text'=>'Stay in the know','link'=>'#','linkText'=>'See newsletter templates'],
    ['image'=>'/img/popup3.png','alt'=>'Free content popup','icon'=>'bi bi-file-earmark-text','title'=>'Free content popup','text'=>'Download an e-book or guide','link'=>'#','linkText'=>'See free content templates'],
    ['image'=>'/img/popup4.png','alt'=>'Free consultation','icon'=>'bi bi-calendar-check','title'=>'Free consultation','text'=>'Set up an initial meeting','link'=>'#','linkText'=>'See free consultation templates']
  ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('popup-cards'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cards' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    ['image'=>'/img/popup1.png','alt'=>'Discount popup','icon'=>'bi bi-tag','title'=>'Discount popup','text'=>'Offer a discount to new subscribers','link'=>'#','linkText'=>'See discount templates'],
    ['image'=>'/img/popup2.png','alt'=>'Newsletter popup','icon'=>'bi bi-send','title'=>'Newsletter popup','text'=>'Stay in the know','link'=>'#','linkText'=>'See newsletter templates'],
    ['image'=>'/img/popup3.png','alt'=>'Free content popup','icon'=>'bi bi-file-earmark-text','title'=>'Free content popup','text'=>'Download an e-book or guide','link'=>'#','linkText'=>'See free content templates'],
    ['image'=>'/img/popup4.png','alt'=>'Free consultation','icon'=>'bi bi-calendar-check','title'=>'Free consultation','text'=>'Set up an initial meeting','link'=>'#','linkText'=>'See free consultation templates']
  ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bca19bfff79af53eea43b336e210254)): ?>
<?php $attributes = $__attributesOriginal9bca19bfff79af53eea43b336e210254; ?>
<?php unset($__attributesOriginal9bca19bfff79af53eea43b336e210254); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bca19bfff79af53eea43b336e210254)): ?>
<?php $component = $__componentOriginal9bca19bfff79af53eea43b336e210254; ?>
<?php unset($__componentOriginal9bca19bfff79af53eea43b336e210254); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/dashboard/index.blade.php ENDPATH**/ ?>