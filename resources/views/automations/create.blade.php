<x-layouts.app>

<div class="px-4 py-4 mt-5">
  <div class="mb-4">
    <h1 class="h4 fw-bold mb-1" style="color: #1a1a2e;">New Automation</h1>
    <p class="text-secondary small mb-0">Define a trigger and the steps to execute.</p>
  </div>

  <form action="{{ route('automations.store') }}" method="POST">
    @csrf

    <div class="row g-4">
      <div class="col-md-5">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-body">
            <h6 class="fw-bold mb-3" style="color: #1a1a2e;">Workflow Details</h6>

            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="2"></textarea>
            </div>

            <div class="mb-3">
              <label for="trigger_type" class="form-label">Trigger</label>
              <select class="form-select" id="trigger_type" name="trigger_type" required>
                <option value="contact_created">Contact Created</option>
                <option value="tag_added">Tag Added</option>
                <option value="birthday">Birthday</option>
                <option value="date_based">Date Based</option>
              </select>
            </div>

            <div class="mb-3" id="tag_config" style="display:none;">
              <label for="tag_id" class="form-label">Select Tag</label>
              <select class="form-select" id="tag_id" name="trigger_config[tag_id]">
                <option value="">Choose tag...</option>
                @foreach($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
              </select>
            </div>

            <script>
              document.getElementById('trigger_type').addEventListener('change', function() {
                document.getElementById('tag_config').style.display = this.value === 'tag_added' ? 'block' : 'none';
              });
            </script>
          </div>
        </div>
      </div>

      <div class="col-md-7">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="fw-bold mb-0" style="color: #1a1a2e;">Steps</h6>
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="addStep()">+ Add Step</button>
            </div>

            <div id="steps-container">
              <div class="step-row border rounded p-3 mb-3 position-relative" data-index="0">
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" onclick="removeStep(this)"></button>
                <div class="row g-2">
                  <div class="col-md-3">
                    <label class="form-label small">Delay (days)</label>
                    <input type="number" class="form-control form-control-sm" name="steps[0][delay_days]" min="0" value="0" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small">Action</label>
                    <select class="form-select form-select-sm action-type" name="steps[0][action_type]" required>
                      <option value="send_email">Send Email</option>
                      <option value="add_tag">Add Tag</option>
                      <option value="remove_tag">Remove Tag</option>
                    </select>
                  </div>
                  <div class="col-md-5 config-col">
                    <label class="form-label small">Template</label>
                    <select class="form-select form-select-sm config-select" name="steps[0][template_id]" data-type="send_email">
                      <option value="">Choose...</option>
                      @foreach($templates as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                      @endforeach
                    </select>
                    <select class="form-select form-select-sm config-select" name="steps[0][tag_id]" data-type="add_tag" style="display:none;">
                      <option value="">Choose tag...</option>
                      @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                      @endforeach
                    </select>
                    <select class="form-select form-select-sm config-select" name="steps[0][tag_id]" data-type="remove_tag" style="display:none;">
                      <option value="">Choose tag...</option>
                      @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn" style="background-color: #e94560; color: white;">Create Automation</button>
      <a href="{{ route('automations.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
  </form>
</div>

<script>
  let stepIndex = 1;

  function addStep() {
    const container = document.getElementById('steps-container');
    const div = document.createElement('div');
    div.className = 'step-row border rounded p-3 mb-3 position-relative';
    div.dataset.index = stepIndex;
    div.innerHTML = `
      <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" onclick="removeStep(this)"></button>
      <div class="row g-2">
        <div class="col-md-3">
          <label class="form-label small">Delay (days)</label>
          <input type="number" class="form-control form-control-sm" name="steps[${stepIndex}][delay_days]" min="0" value="0" required>
        </div>
        <div class="col-md-4">
          <label class="form-label small">Action</label>
          <select class="form-select form-select-sm action-type" name="steps[${stepIndex}][action_type]" required onchange="toggleConfig(this)">
            <option value="send_email">Send Email</option>
            <option value="add_tag">Add Tag</option>
            <option value="remove_tag">Remove Tag</option>
          </select>
        </div>
        <div class="col-md-5 config-col">
          <select class="form-select form-select-sm config-select" name="steps[${stepIndex}][template_id]" data-type="send_email">
            <option value="">Choose template...</option>
            @foreach($templates as $t)
              <option value="{{ $t->id }}">{{ $t->name }}</option>
            @endforeach
          </select>
          <select class="form-select form-select-sm config-select" name="steps[${stepIndex}][tag_id]" data-type="add_tag" style="display:none;">
            <option value="">Choose tag...</option>
            @foreach($tags as $tag)
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
          <select class="form-select form-select-sm config-select" name="steps[${stepIndex}][tag_id]" data-type="remove_tag" style="display:none;">
            <option value="">Choose tag...</option>
            @foreach($tags as $tag)
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    `;
    container.appendChild(div);
    stepIndex++;
  }

  function toggleConfig(select) {
    const row = select.closest('.step-row');
    const selects = row.querySelectorAll('.config-select');
    selects.forEach(s => s.style.display = s.dataset.type === select.value ? 'block' : 'none');
  }

  function removeStep(btn) {
    btn.closest('.step-row').remove();
  }

  document.querySelectorAll('.action-type').forEach(el => {
    el.addEventListener('change', function() { toggleConfig(this); });
  });
</script>

</x-layouts.app>
