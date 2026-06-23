<x-layouts.app>

<div class="px-4 py-4 mt-5">
  <div class="mb-4">
    <h1 class="h4 fw-bold mb-1" style="color: #1a1a2e;">Edit Automation</h1>
    <p class="text-secondary small mb-0">{{ $automation->name }}</p>
  </div>

  <form action="{{ route('automations.update', $automation->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="row g-4">
      <div class="col-md-5">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
          <div class="card-body">
            <h6 class="fw-bold mb-3" style="color: #1a1a2e;">Workflow Details</h6>

            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $automation->name) }}" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="2">{{ old('description', $automation->description) }}</textarea>
            </div>

            <div class="mb-3">
              <label for="trigger_type" class="form-label">Trigger</label>
              <select class="form-select" id="trigger_type" name="trigger_type" required>
                <option value="contact_created" {{ $automation->trigger_type == 'contact_created' ? 'selected' : '' }}>Contact Created</option>
                <option value="tag_added" {{ $automation->trigger_type == 'tag_added' ? 'selected' : '' }}>Tag Added</option>
                <option value="birthday" {{ $automation->trigger_type == 'birthday' ? 'selected' : '' }}>Birthday</option>
                <option value="date_based" {{ $automation->trigger_type == 'date_based' ? 'selected' : '' }}>Date Based</option>
              </select>
            </div>

            <div class="mb-3" id="tag_config" style="{{ $automation->trigger_type == 'tag_added' ? '' : 'display:none;' }}">
              <label for="tag_id" class="form-label">Select Tag</label>
              <select class="form-select" id="tag_id" name="trigger_config[tag_id]">
                <option value="">Choose tag...</option>
                @foreach($tags as $tag)
                  <option value="{{ $tag->id }}" {{ ($automation->trigger_config['tag_id'] ?? '') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status" name="status" required>
                <option value="active" {{ $automation->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="paused" {{ $automation->status == 'paused' ? 'selected' : '' }}>Paused</option>
              </select>
            </div>
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
              @forelse($automation->steps as $step)
                <div class="step-row border rounded p-3 mb-3 position-relative" data-index="{{ $loop->index }}">
                  <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" onclick="removeStep(this)"></button>
                  <div class="row g-2">
                    <div class="col-md-3">
                      <label class="form-label small">Delay (days)</label>
                      <input type="number" class="form-control form-control-sm" name="steps[{{ $loop->index }}][delay_days]" min="0" value="{{ $step->delay_days }}" required>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label small">Action</label>
                      <select class="form-select form-select-sm action-type" name="steps[{{ $loop->index }}][action_type]" required onchange="toggleConfig(this)">
                        <option value="send_email" {{ $step->action_type == 'send_email' ? 'selected' : '' }}>Send Email</option>
                        <option value="add_tag" {{ $step->action_type == 'add_tag' ? 'selected' : '' }}>Add Tag</option>
                        <option value="remove_tag" {{ $step->action_type == 'remove_tag' ? 'selected' : '' }}>Remove Tag</option>
                      </select>
                    </div>
                    <div class="col-md-5 config-col">
                      <select class="form-select form-select-sm config-select" name="steps[{{ $loop->index }}][template_id]" data-type="send_email" style="{{ $step->action_type == 'send_email' ? '' : 'display:none' }}">
                        <option value="">Choose template...</option>
                        @foreach($templates as $t)
                          <option value="{{ $t->id }}" {{ ($step->action_config['template_id'] ?? '') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                      </select>
                      <select class="form-select form-select-sm config-select" name="steps[{{ $loop->index }}][tag_id]" data-type="add_tag" style="{{ $step->action_type == 'add_tag' ? '' : 'display:none' }}">
                        <option value="">Choose tag...</option>
                        @foreach($tags as $tag)
                          <option value="{{ $tag->id }}" {{ ($step->action_config['tag_id'] ?? '') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                      </select>
                      <select class="form-select form-select-sm config-select" name="steps[{{ $loop->index }}][tag_id]" data-type="remove_tag" style="{{ $step->action_type == 'remove_tag' ? '' : 'display:none' }}">
                        <option value="">Choose tag...</option>
                        @foreach($tags as $tag)
                          <option value="{{ $tag->id }}" {{ ($step->action_config['tag_id'] ?? '') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              @empty
                <div class="step-row border rounded p-3 mb-3 position-relative" data-index="0">
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
                      <select class="form-select form-select-sm config-select" name="steps[0][template_id]" data-type="send_email">
                        <option value="">Choose template...</option>
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
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn" style="background-color: #e94560; color: white;">Update Automation</button>
      <a href="{{ route('automations.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
  </form>
</div>

<script>
  let stepIndex = {{ max($automation->steps->count(), 1) }};

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
