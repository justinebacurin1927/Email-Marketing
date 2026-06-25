<x-layouts.app>

<div class="px-4 px-xl-5 py-4" style="margin-top: 3.5rem; max-width: 1400px;">
  <a href="{{ route('contacts.index') }}" class="d-inline-flex align-items-center gap-1 text-decoration-none mb-3" style="color: #e94560; font-size: 0.85rem;">
    <i class="bi bi-arrow-left"></i> Back to contacts
  </a>

  <h1 class="fw-bold mb-1" style="font-size: 1.5rem; color: #1a1a2e;">Add a Contact</h1>
  <p class="text-secondary mb-4" style="font-size: 0.85rem;">Create a new contact in your audience.</p>

  <hr class="mb-4">

  @if ($errors->any())
    <div class="alert alert-danger py-2 small">
      <i class="bi bi-exclamation-triangle me-1"></i> Please fix the errors below.
    </div>
  @endif

  <form action="{{ route('contacts.store') }}" method="POST" class="bg-white rounded p-4 p-xl-5 shadow-sm" style="border: 1px solid #e9ecef;">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label fw-semibold" style="font-size: 0.9rem;">Email Address <span class="text-danger">*</span></label>
      <input type="email" name="email" id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}" required placeholder="contact@example.com"
        style="max-width: 480px;">
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-check mb-4">
      <input type="checkbox" name="permission" id="permission" class="form-check-input" value="1" {{ old('permission') ? 'checked' : '' }}>
      <label for="permission" class="form-check-label" style="font-size: 0.85rem;">This person gave me permission to email them</label>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label for="first_name" class="form-label fw-semibold" style="font-size: 0.9rem;">First Name</label>
        <input type="text" name="first_name" id="first_name"
          class="form-control @error('first_name') is-invalid @enderror"
          value="{{ old('first_name') }}" placeholder="John">
        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6 mt-2 mt-md-0">
        <label for="last_name" class="form-label fw-semibold" style="font-size: 0.9rem;">Last Name</label>
        <input type="text" name="last_name" id="last_name"
          class="form-control @error('last_name') is-invalid @enderror"
          value="{{ old('last_name') }}" placeholder="Doe">
        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label for="company" class="form-label fw-semibold" style="font-size: 0.9rem;">Company</label>
        <input type="text" name="company" id="company"
          class="form-control @error('company') is-invalid @enderror"
          value="{{ old('company') }}" placeholder="Acme Inc.">
        @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6 mt-2 mt-md-0">
        <label for="phone" class="form-label fw-semibold" style="font-size: 0.9rem;">Phone Number</label>
        <input type="tel" name="phone" id="phone"
          class="form-control @error('phone') is-invalid @enderror"
          value="{{ old('phone') }}" placeholder="+1 234 567 8900">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="mb-3">
      <label for="birthday" class="form-label fw-semibold" style="font-size: 0.9rem;">Birthday</label>
      <input type="date" name="birthday" id="birthday"
        class="form-control @error('birthday') is-invalid @enderror"
        value="{{ old('birthday') }}"
        style="max-width: 240px;">
      @error('birthday') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Subscription & Tags</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Manage their subscription status and assign tags.</p>

    <div class="mb-3">
      <label class="form-label fw-semibold" style="font-size: 0.9rem;">Subscriber Status</label>
      <div class="d-flex gap-3">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="subscribed" id="statusSubscribe" value="1" {{ old('subscribed', '1') == '1' ? 'checked' : '' }}>
          <label class="form-check-label" for="statusSubscribe">Subscribed</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="subscribed" id="statusNonSubscribe" value="0" {{ old('subscribed') == '0' ? 'checked' : '' }}>
          <label class="form-check-label" for="statusNonSubscribe">Non-Subscribed</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="subscribed" id="statusUnsubscribed" value="0" {{ old('subscribed') == '0' ? 'checked' : '' }}>
          <label class="form-check-label" for="statusUnsubscribed">Unsubscribed</label>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <label class="form-label fw-semibold" style="font-size: 0.9rem;">Tags</label>
      @php $allTags = \App\Models\Tag::orderBy('name')->get(); @endphp
      @if($allTags->isNotEmpty())
        <div class="d-flex flex-wrap gap-2 mb-2">
          @foreach($allTags as $tag)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="tag_{{ $tag->id }}" style="font-size: 0.85rem;">{{ $tag->name }}</label>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-secondary small mb-2">No tags created yet.</p>
      @endif
      <input type="text" name="new_tags" class="form-control" placeholder="Or create new tags (comma-separated)" style="max-width: 400px;" value="{{ old('new_tags') }}">
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Address</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">The contact's physical address.</p>

    <div class="mb-3">
      <label for="street" class="form-label fw-semibold" style="font-size: 0.9rem;">Street Address</label>
      <input type="text" name="street" id="street"
        class="form-control @error('street') is-invalid @enderror"
        value="{{ old('street') }}" placeholder="123 Main St">
      @error('street') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label for="address2" class="form-label fw-semibold" style="font-size: 0.9rem;">Address Line 2</label>
      <input type="text" name="address2" id="address2"
        class="form-control @error('address2') is-invalid @enderror"
        value="{{ old('address2') }}" placeholder="Apt, Suite, etc.">
      @error('address2') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <label for="city" class="form-label fw-semibold" style="font-size: 0.9rem;">City</label>
        <input type="text" name="city" id="city"
          class="form-control @error('city') is-invalid @enderror"
          value="{{ old('city') }}" placeholder="City">
        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6 mt-2 mt-md-0">
        <label for="region" class="form-label fw-semibold" style="font-size: 0.9rem;">State / Province / Region</label>
        <input type="text" name="region" id="region"
          class="form-control @error('region') is-invalid @enderror"
          value="{{ old('region') }}" placeholder="Region">
        @error('region') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6">
        <label for="postal" class="form-label fw-semibold" style="font-size: 0.9rem;">Postal / Zip Code</label>
        <input type="text" name="postal" id="postal"
          class="form-control @error('postal') is-invalid @enderror"
          value="{{ old('postal') }}" placeholder="10001">
        @error('postal') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-6 mt-2 mt-md-0">
        <label for="country" class="form-label fw-semibold" style="font-size: 0.9rem;">Country</label>
        <select name="country" id="country" class="form-select @error('country') is-invalid @enderror">
          <option value="">Select Country</option>
          <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
          <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
          <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
          <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
          <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
          <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
          <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
          <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
        </select>
        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn d-flex align-items-center gap-1 px-4" style="background: #2d6a4f; color: #fff;">
        <i class="bi bi-check-lg"></i> Save Contact
      </button>
      <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
    </div>
  </form>
</div>

</x-layouts.app>
