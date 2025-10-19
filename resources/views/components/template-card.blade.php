@props(['title', 'type', 'image'])

<div class="border rounded p-3 text-center">
  <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid mb-2" style="height: 8rem; object-fit: cover; width: 100%;">
  <h3 class="fw-semibold mb-1">{{ $title }}</h3>
  <p class="text-muted small mb-0">{{ $type }}</p>
</div>
