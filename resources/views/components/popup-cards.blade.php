<section class="px-3 py-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h6 fw-semibold mb-0">Grow your audience with custom popup forms <span class="badge bg-light text-dark">Beta</span></h2>
    <a href="#" class="text-decoration-none">View all popup forms →</a>
  </div>

  <div class="row g-3">
    @foreach($cards as $card)
      <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100">
          <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['alt'] }}">
          <div class="card-body">
            <h5 class="card-title"><i class="{{ $card['icon'] }}"></i> {{ $card['title'] }}</h5>
            <p class="card-text">{{ $card['text'] }}</p>
            <a href="{{ $card['link'] }}" class="text-primary">{{ $card['linkText'] }}</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
