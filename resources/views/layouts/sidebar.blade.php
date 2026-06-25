<aside id="sidebar"
  class="d-flex flex-column text-white position-fixed"
  style="top: 0; left: 0; height: 100vh; width: 16rem; overflow: hidden; z-index: 1040; background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);">

  <div class="p-3 border-bottom border-secondary">
    <div class="d-flex align-items-center justify-content-between">
      <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle text-white border-0 d-flex align-items-center gap-2" style="background: transparent; padding: 0;" data-bs-toggle="dropdown">
          <span style="color: #e94560; font-weight: 700; font-size: 1rem;">SendFlow</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item active" href="{{ route('campaigns.index') }}"><i class="bi bi-envelope me-2"></i>Campaigns</a></li>
          <li><a class="dropdown-item" href="{{ route('templates.index') }}"><i class="bi bi-file-text me-2"></i>Templates</a></li>
          <li><a class="dropdown-item" href="{{ route('automations.index') }}"><i class="bi bi-lightning me-2"></i>Automations</a></li>
        </ul>
      </div>
      <a href="{{ route('campaigns.create') }}" class="btn btn-sm d-flex align-items-center justify-content-center text-white fw-bold"
        style="width: 28px; height: 28px; background: #e94560; border-radius: 6px; padding: 0; font-size: 1.2rem; line-height: 1; text-decoration: none;">+</a>
    </div>
  </div>

  <div class="flex-grow-1 overflow-auto py-2">

    @if(Route::currentRouteName() === 'campaigns.index' && isset($campaigns))
    <div class="px-3 mb-1">
      <small class="text-secondary" style="color: #8899aa !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Statuses</small>
    </div>
    <ul class="list-unstyled px-2 mb-3" id="sidebar-statuses">
      <li class="mb-1">
        <a href="#" class="d-flex align-items-center justify-content-between p-2 rounded text-decoration-none sidebar-link filter-status active-filter" data-status="all">
          <span><i class="bi bi-list-ul me-2"></i> All</span>
          <span class="badge" style="background: rgba(233,69,96,0.2); color: #e94560; font-size: 0.7rem;">{{ $campaigns->count() }}</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="#" class="d-flex align-items-center justify-content-between p-2 rounded text-decoration-none sidebar-link filter-status" data-status="draft">
          <span><i class="bi bi-pencil me-2"></i> Draft</span>
          <span class="badge" style="background: rgba(233,69,96,0.2); color: #e94560; font-size: 0.7rem;">{{ $campaigns->where('status','draft')->count() }}</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="#" class="d-flex align-items-center justify-content-between p-2 rounded text-decoration-none sidebar-link filter-status" data-status="sent">
          <span><i class="bi bi-check-circle me-2"></i> Sent</span>
          <span class="badge" style="background: rgba(233,69,96,0.2); color: #e94560; font-size: 0.7rem;">{{ $campaigns->where('status','sent')->count() }}</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="#" class="d-flex align-items-center justify-content-between p-2 rounded text-decoration-none sidebar-link filter-status" data-status="scheduled">
          <span><i class="bi bi-clock me-2"></i> Scheduled</span>
          <span class="badge" style="background: rgba(233,69,96,0.2); color: #e94560; font-size: 0.7rem;">{{ $campaigns->where('status','scheduled')->count() }}</span>
        </a>
      </li>
    </ul>
    @endif

    <div class="px-3 mb-1">
      <small class="text-secondary" style="color: #8899aa !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Navigation</small>
    </div>
    <ul class="list-unstyled px-2 mb-3">
      <li class="mb-1">
        <a href="/" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('/') ? ' sidebar-active' : '' }}">
          <i class="bi bi-house" style="width: 20px;"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('campaigns.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('campaigns.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-envelope" style="width: 20px;"></i>
          <span>Campaigns</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('templates.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('templates.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-file-text" style="width: 20px;"></i>
          <span>Templates</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('automations.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('automations.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-lightning" style="width: 20px;"></i>
          <span>Automations</span>
        </a>
      </li>
    </ul>

    <div class="px-3 mb-1">
      <small class="text-secondary" style="color: #8899aa !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Audience</small>
    </div>
    <ul class="list-unstyled px-2 mb-3">
      <li class="mb-1">
        <a href="{{ route('contacts.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('contacts.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-people" style="width: 20px;"></i>
          <span>Contacts</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('audience-tags') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('audience-tags') ? ' sidebar-active' : '' }}">
          <i class="bi bi-tag" style="width: 20px;"></i>
          <span>Tags</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('inbox') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('inbox') ? ' sidebar-active' : '' }}">
          <i class="bi bi-inbox" style="width: 20px;"></i>
          <span>Inbox</span>
        </a>
      </li>
    </ul>

    <div class="px-3 mb-1">
      <small class="text-secondary" style="color: #8899aa !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Settings</small>
    </div>
    <ul class="list-unstyled px-2 mb-3">
      <li class="mb-1">
        <a href="{{ route('labels.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('labels.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-tags" style="width: 20px;"></i>
          <span>Labels</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('sources.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('sources.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-wifi" style="width: 20px;"></i>
          <span>Sources</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('profile.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link{{ request()->routeIs('profile.*') ? ' sidebar-active' : '' }}">
          <i class="bi bi-person" style="width: 20px;"></i>
          <span>Profile</span>
        </a>
      </li>
    </ul>

    <div class="px-3 mb-1">
      <small class="text-secondary" style="color: #8899aa !important; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px;">Pinned</small>
    </div>
    <ul class="list-unstyled px-2 mb-3">
      <li class="mb-1">
        <a href="{{ route('campaigns.create') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <i class="bi bi-plus-circle" style="width: 20px;"></i>
          <span>New Campaign</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/add-contact" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <i class="bi bi-person-plus" style="width: 20px;"></i>
          <span>New Contact</span>
        </a>
      </li>
    </ul>

  </div>

  <div class="p-3 border-top border-secondary d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <a href="{{ route('profile.index') }}" class="text-decoration-none d-flex align-items-center gap-2">
        @php $user = auth()->user(); @endphp
        @if($user && $user->avatar_url)
          <img src="{{ $user->avatar_url }}" alt="Avatar"
            class="rounded-circle" style="width: 2rem; height: 2rem; object-fit: cover;">
        @else
          <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
            style="width: 2rem; height: 2rem; background: #e94560; font-size: 0.75rem;">
            {{ strtoupper(substr($user->name ?? 'G', 0, 1)) }}
          </div>
        @endif
        <small style="color: #c4c4d4;">{{ $user->name ?? 'Guest' }}</small>
      </a>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('profile.index') }}" class="text-secondary text-decoration-none sidebar-icon" title="Profile"><i class="bi bi-person"></i></a>
      <a href="#" class="text-secondary text-decoration-none sidebar-icon" title="Help"><i class="bi bi-question-circle"></i></a>
    </div>
  </div>
</aside>

<div style="margin-left: 16rem;">
  @yield('content')
</div>

<style>
  .sidebar-link {
    color: #c4c4d4;
    transition: all 0.2s;
    font-size: 0.85rem;
  }
  .sidebar-link:hover {
    background-color: rgba(233, 69, 96, 0.15);
    color: #e94560;
  }
  .sidebar-active {
    background-color: rgba(233, 69, 96, 0.12);
    color: #e94560;
  }
  .sidebar-icon:hover {
    opacity: 0.8;
  }
  body { overflow-x: hidden; }
  .filter-status.active-filter {
    background-color: rgba(233, 69, 96, 0.15);
    color: #e94560;
  }
</style>
