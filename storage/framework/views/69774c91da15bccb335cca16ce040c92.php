<div class="px-3 px-md-4 mt-5">
  <div class="row">
    <!-- Left Column: Title + Progress -->
    <div class="col-md-3 mb-4">
      <h4>Finish setting up your account</h4>

      <!-- Progress Bar -->
      <div class="progress" style="height: 8px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <small class="text-muted d-block mt-2">0 of 4 tasks completed</small>
    </div>

    <!-- Right Column: Task Cards -->
    <div class="col-md-9">
      <div class="d-flex overflow-hidden" id="taskSlider">
        <div class="d-flex flex-nowrap gap-3 transition" style="width: 200%;">
          <!-- Task Card 1 -->
          <div class="card flex-fill" style="min-width: 50%;">
            <div class="card-body">
              <h6 class="card-title">Add your contacts</h6>
              <p class="card-text small">Upload your list of subscribers or import them from another app.</p>
              <small class="text-muted">4 min</small>
            </div>
          </div>

          <!-- Task Card 2 -->
          <div class="card flex-fill" style="min-width: 50%;">
            <div class="card-body">
              <h6 class="card-title">Connect an integration</h6>
              <p class="card-text small">Leverage data to create more automated, personalized omni-channel marketing communications.</p>
              <small class="text-muted">2 min</small>
            </div>
          </div>

          <!-- Task Card 3 -->
          <div class="card flex-fill" style="min-width: 50%;">
            <div class="card-body">
              <h6 class="card-title">Import your brand</h6>
              <p class="card-text small">We’ll create email designs using your fonts, logos, colors, and images.</p>
              <small class="text-muted">2 seconds</small>
            </div>
          </div>

          <!-- Task Card 4 -->
          <div class="card flex-fill" style="min-width: 50%;">
            <div class="card-body">
              <h6 class="card-title">Authenticate your email domain</h6>
              <p class="card-text small">Strongly recommended to improve deliverability, avoid spam folders, and build your sender reputation.</p>
              <small class="text-muted">4 min</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="d-flex justify-content-end mt-3 gap-2">
        <button id="prevTasks" class="btn btn-outline-secondary">&#8592;</button>
        <button id="nextTasks" class="btn btn-outline-secondary">&#8594;</button>
      </div>
    </div>
  </div>
</div>

<script>
  const slider = document.getElementById('taskSlider').firstElementChild;
  const prevBtn = document.getElementById('prevTasks');
  const nextBtn = document.getElementById('nextTasks');
  let index = 0;

  prevBtn.addEventListener('click', () => {
    index = Math.max(index - 1, 0);
    slider.style.transform = `translateX(-${index * 50}%)`;
  });

  nextBtn.addEventListener('click', () => {
    index = Math.min(index + 1, 1); // 2 sets of 2 cards
    slider.style.transform = `translateX(-${index * 50}%)`;
  });

  slider.style.transition = "transform 0.3s ease";
</script>
<?php /**PATH /var/www/html/resources/views/components/progress-widget.blade.php ENDPATH**/ ?>