<x-layouts.app>

<div class="settings-layout d-flex" style="min-height: calc(100vh - 3.5rem);">

  {{-- Settings Navigation Sidebar (~20%) --}}
  <aside class="settings-sidebar p-3 d-flex flex-column"
    style="width: 18%; min-width: 220px; background: #f8f9fb; border-right: 1px solid #e9ecef;">

    <a href="/" class="btn btn-sm text-secondary d-flex align-items-center gap-2 mb-3 px-2"
      style="font-size: 0.85rem;">
      <i class="bi bi-arrow-left"></i> Exit Settings
    </a>

    <div class="flex-grow-1">
      <div class="mb-3">
        <small class="text-secondary px-2" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">User</small>
        <ul class="list-unstyled mt-1">
          <li>
            <a href="{{ route('profile.index') }}" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link active-nav" style="font-size: 0.85rem;">
              <i class="bi bi-person"></i> Profile
            </a>
          </li>
          <li>
            <a href="#" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link" style="font-size: 0.85rem; padding-left: 2.2rem !important;">
              <i class="bi bi-bell"></i> Notifications
            </a>
          </li>
        </ul>
      </div>

      <div class="mb-3">
        <small class="text-secondary px-2" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Workspace</small>
        <ul class="list-unstyled mt-1">
          <li>
            <a href="#" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link" style="font-size: 0.85rem;">
              <i class="bi bi-gear"></i> General
            </a>
          </li>
          <li>
            <a href="#" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link" style="font-size: 0.85rem;">
              <i class="bi bi-palette"></i> Branding
            </a>
          </li>
        </ul>
      </div>

      <div class="mb-3">
        <small class="text-secondary px-2" style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Other</small>
        <ul class="list-unstyled mt-1">
          <li>
            <a href="#" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link" style="font-size: 0.85rem;">
              <i class="bi bi-credit-card"></i> Billing
            </a>
          </li>
          <li>
            <a href="#" class="d-flex align-items-center gap-2 px-2 py-1.5 rounded text-decoration-none settings-nav-link" style="font-size: 0.85rem;">
              <i class="bi bi-people"></i> Team
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="pt-3 border-top d-flex align-items-center justify-content-between px-2" style="border-color: #e9ecef !important;">
      <span style="font-size: 0.8rem; color: #495057;">Dark Mode</span>
      <div class="form-check form-switch m-0">
        <input class="form-check-input" type="checkbox" id="darkModeToggle" style="cursor: pointer;">
      </div>
    </div>
  </aside>

  {{-- Form Viewport Canvas (~80%) --}}
  <main class="settings-viewport p-4 p-xl-5" style="flex: 1; background: #ffffff;">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-2">
      <ol class="breadcrumb mb-0" style="font-size: 0.8rem;">
        <li class="breadcrumb-item"><a href="#" class="text-secondary text-decoration-none">Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </nav>

    {{-- Page Header --}}
    <h1 class="fw-bold mb-1" style="font-size: 1.5rem; color: #1a1a2e;">Profile</h1>
    <p class="text-secondary mb-4" style="font-size: 0.85rem;">Manage your account settings and personal information.</p>

    <hr class="mb-4">

    @if (session('profile_success'))
      <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
        <i class="bi bi-check-circle-fill me-1"></i> {{ session('profile_success') }}
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if(auth()->check())
      {{-- Picture Section --}}
      <div class="mb-4">
        <label class="form-label fw-semibold mb-2" style="font-size: 0.9rem;">Picture</label>
        <div class="d-flex align-items-center gap-3">
          @php $avatarUrl = auth()->user()->avatar_url; @endphp
          @if($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="Avatar"
              class="rounded-circle" style="width: 4rem; height: 4rem; object-fit: cover; flex-shrink: 0;">
          @else
            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
              style="width: 4rem; height: 4rem; background: #1a1a2e; font-size: 1.3rem; flex-shrink: 0;">
              {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
          @endif
          <div>
            <div class="d-flex gap-2">
              <form action="{{ route('profile.avatar.upload') }}" method="POST" enctype="multipart/form-data" id="avatarUploadForm">
                @csrf
                <input type="file" name="avatar" id="avatarInput" accept="image/jpeg,image/png,image/gif" class="d-none" onchange="this.form.submit()">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('avatarInput').click()">Upload</button>
              </form>
              @if($avatarUrl)
              <form action="{{ route('profile.avatar.remove') }}" method="POST" class="d-inline" onsubmit="return confirm('Remove avatar?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
              </form>
              @endif
            </div>
            <small class="text-secondary d-block mt-1" style="font-size: 0.75rem;">JPG, GIF or PNG. Max 2MB.</small>
          </div>
        </div>
      </div>

      {{-- Profile Form --}}
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name Section --}}
        <div class="mb-3">
          <label for="name" class="form-label fw-semibold" style="font-size: 0.9rem;">Name</label>
          <p class="text-secondary mb-2" style="font-size: 0.8rem;">Your full name as it will appear across the platform.</p>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', auth()->user()->name) }}" required
            style="max-width: 480px;">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email Section --}}
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold" style="font-size: 0.9rem;">Email</label>
          <p class="text-secondary mb-2" style="font-size: 0.8rem;">Your email address for notifications and login.</p>
          <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email', auth()->user()->email) }}" required readonly
            style="max-width: 480px;">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn d-flex align-items-center gap-1 px-4"
          style="background: #2d6a4f; color: #fff;">
          <i class="bi bi-check-lg"></i> Save Changes
        </button>
      </form>

      <hr class="my-4">

      {{-- Security Section --}}
      <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Security</h5>
      <p class="text-secondary mb-3" style="font-size: 0.85rem;">Manage your account security and authentication methods.</p>

      <div class="security-list" style="max-width: 600px;">
        {{-- Password --}}
        <a href="#" class="d-flex align-items-center gap-3 p-3 rounded text-decoration-none border mb-2"
          style="border-color: #e9ecef !important; transition: background 0.15s;" data-bs-toggle="collapse" data-bs-target="#passwordForm" role="button">
          <i class="bi bi-shield-lock fs-5" style="color: #6c757d;"></i>
          <div class="flex-grow-1">
            <div class="fw-semibold" style="font-size: 0.85rem; color: #1a1a2e;">Password</div>
            <small class="text-secondary">Set a strong password to protect your account</small>
          </div>
          <span class="badge rounded-pill" style="background: #d4edda; color: #155724; font-size: 0.7rem; font-weight: 500;">Active</span>
          <i class="bi bi-chevron-right text-secondary"></i>
        </a>

        {{-- Password Form (collapsible) --}}
        <div class="collapse mb-2" id="passwordForm">
          <div class="card card-body border-0 bg-light p-3">
            <form action="{{ route('profile.password') }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="current_password" class="form-label fw-semibold small">Current Password</label>
                <input type="password" class="form-control form-control-sm @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="row mb-3">
                <div class="col-md-6 mb-2 mb-md-0">
                  <label for="password" class="form-label fw-semibold small">New Password</label>
                  <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" required>
                  @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                  <label for="password_confirmation" class="form-label fw-semibold small">Confirm Password</label>
                  <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" required>
                </div>
              </div>

              <button type="submit" class="btn btn-sm d-flex align-items-center gap-1" style="background: #e94560; color: #fff;">
                <i class="bi bi-key"></i> Update Password
              </button>
            </form>
          </div>
        </div>

        {{-- Two-Factor --}}
        <a href="#" class="d-flex align-items-center gap-3 p-3 rounded text-decoration-none border mb-2"
          style="border-color: #e9ecef !important; transition: background 0.15s;">
          <i class="bi bi-shield-check fs-5" style="color: #6c757d;"></i>
          <div class="flex-grow-1">
            <div class="fw-semibold" style="font-size: 0.85rem; color: #1a1a2e;">Two-Factor Authentication</div>
            <small class="text-secondary">Add an extra layer of security to your account</small>
          </div>
          <span class="badge rounded-pill" style="background: #f8d7da; color: #721c24; font-size: 0.7rem; font-weight: 500;">Disabled</span>
          <i class="bi bi-chevron-right text-secondary"></i>
        </a>

        {{-- Active Sessions --}}
        <a href="#" class="d-flex align-items-center gap-3 p-3 rounded text-decoration-none border"
          style="border-color: #e9ecef !important; transition: background 0.15s;">
          <i class="bi bi-laptop fs-5" style="color: #6c757d;"></i>
          <div class="flex-grow-1">
            <div class="fw-semibold" style="font-size: 0.85rem; color: #1a1a2e;">Active Sessions</div>
            <small class="text-secondary">Manage your active sessions across devices</small>
          </div>
          <i class="bi bi-chevron-right text-secondary"></i>
        </a>
      </div>

    @else
      <p class="text-secondary">No user account found. Run <code>php artisan tinker</code> and create one.</p>
    @endif
  </main>
</div>

<style>
  .settings-nav-link {
    color: #495057;
    transition: all 0.15s;
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
  }
  .settings-nav-link:hover {
    background-color: #e9ecef;
    color: #1a1a2e;
  }
  .settings-nav-link.active-nav {
    background-color: #e9ecef;
    color: #1a1a2e;
    font-weight: 600;
  }
  .security-list a:hover {
    background-color: #f8f9fb !important;
  }
  .settings-sidebar {
    position: sticky;
    top: 3.5rem;
    height: calc(100vh - 3.5rem);
  }
  .settings-viewport {
    min-height: calc(100vh - 3.5rem);
  }
</style>

</x-layouts.app>
