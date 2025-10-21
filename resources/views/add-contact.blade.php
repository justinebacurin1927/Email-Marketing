<x-layouts.bp-inbox>
  <x-topbar/>

  <title>Add Contact</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f6f7f8;
    }
    .main-content {
      margin-left: 20rem;
      padding: 2rem;
      margin-top: 4.2rem;
    }
    .form-box {
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 1300px;
    }
    .btn-primary {
      background-color: #008c8c;
      border-color: #008c8c;
    }
    .btn-primary:hover {
      background-color: #007474;
      border-color: #007474;
    }
    .back-link {
      display: inline-flex;
      align-items: center;
      color: #008c8c;
      text-decoration: none;
      font-size: 0.95rem;
      margin-top: 0.5rem;
    }
    .header-title {
      font-weight: 700;
      color: #212529;
      font-size: 1.75rem;
      margin-top: 0.75rem;
    }
  </style>

  <div class="main-content">
      <a href="/audience" class="back-link">
        <i class="bi bi-arrow-left me-1"></i> Back to contacts
      </a>

      <h1 class="header-title">Add a Contact</h1>

<div class="form-box shadow-sm">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fill up all required fields correctly.
      <ul class="mt-2 mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <!-- your existing form fields below -->


        <div class="mb-3">
          <label class="form-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
        </div>

        <div class="form-check mb-3">
          <input type="checkbox" name="permission" id="permission" class="form-check-input">
          <label for="permission" class="form-check-label">This person gave me permission to email them</label>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="{{ old('last_name') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Company</label>
          <input type="text" name="company" class="form-control" placeholder="Enter company name" value="{{ old('company') }}">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" name="phone" class="form-control" placeholder="+63 912 345 6789" value="{{ old('phone') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Birthday</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
          </div>
        </div>

        <h5 class="mt-4 mb-3">Address</h5>

        <div class="mb-3">
          <label class="form-label">Street Address</label>
          <input type="text" name="street" class="form-control" placeholder="Street address" value="{{ old('street') }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Address Line 2</label>
          <input type="text" name="address2" class="form-control" placeholder="Apartment, suite, etc." value="{{ old('address2') }}">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" placeholder="City" value="{{ old('city') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">State / Province / Region</label>
            <input type="text" name="region" class="form-control" placeholder="Region" value="{{ old('region') }}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Postal / Zip</label>
            <input type="text" name="postal" class="form-control" placeholder="Postal code" value="{{ old('postal') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Country</label>
            <select name="country" class="form-select">
              <option value="">Select Country</option>
              <option value="Philippines">Philippines</option>
              <option value="United States">United States</option>
              <option value="Canada">Canada</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="Australia">Australia</option>
              <option value="Japan">Japan</option>
              <option value="Singapore">Singapore</option>
              <option value="India">India</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Contact</button>
        <a href="/contacts" class="btn btn-outline-secondary ms-2">Cancel</a>
      </form>
    </div>
  </div>
</x-layouts.bp-inbox>
