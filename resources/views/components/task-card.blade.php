@props(['title', 'time'])

<div class="border rounded p-3" style="transition: background-color 0.2s;" 
     onmouseover="this.style.backgroundColor='#f8f9fa'" 
     onmouseout="this.style.backgroundColor='transparent'">
  <p class="fw-medium mb-1">{{ $title }}</p>
  <p class="text-muted small mb-0">{{ $time }}</p>
</div>
