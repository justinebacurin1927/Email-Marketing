<x-layouts.app>
  <x-topbar />

  <div class="container-fluid py-5 mt-5">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-4">
      <div>
        <h2 class="fw-bold mb-1">Import Contacts</h2>
        <p class="text-secondary mb-0">Upload a CSV or Excel file to add multiple contacts to your audience.</p>
      </div>
      <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Contacts
      </a>
    </div>

    <div class="row px-4">
      <!-- LEFT COLUMN (Form) -->
      <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
<form action="/api/contacts/import" method="POST" enctype="multipart/form-data" id="importForm">

              <div class="mb-4">
                <label for="file" class="form-label fw-semibold">Select file to import</label>
                <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx" class="form-control" required>
                <div class="form-text">Supported file types: CSV, XLS, XLSX</div>
              </div>

              <div class="mb-4">
                <label for="tags" class="form-label fw-semibold">Apply tags (optional)</label>
                <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. Newsletter, 2025 Campaign">
              </div>

              <div class="mb-4">
                <label class="form-label fw-semibold">Import options</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="import_type" id="updateExisting" value="update" checked>
                  <label class="form-check-label" for="updateExisting">
                    Update existing contacts if they already exist
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="import_type" id="skipExisting" value="skip">
                  <label class="form-check-label" for="skipExisting">
                    Skip existing contacts
                  </label>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-upload"></i> Import Contacts
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- SAMPLE FILE DOWNLOAD -->
<div class="mt-4">
  <p class="fw-semibold mb-2">Sample import templates:</p>

  <div class="d-flex flex-column gap-1">
    <a href="{{ asset('samples/sample_contacts.csv') }}" class="text-decoration-none">
      <i class="bi bi-file-earmark-arrow-down"></i> Download CSV template
    </a>
    <a href="{{ asset('samples/sample_contacts.xlsx') }}" class="text-decoration-none">
      <i class="bi bi-file-earmark-arrow-down"></i> Download XLSX template
    </a>
    <a href="{{ asset('samples/sample_contacts.xls') }}" class="text-decoration-none">
      <i class="bi bi-file-earmark-arrow-down"></i> Download XLS template
    </a>
  </div>
</div>

      </div>
    </div>
  </div>

  <script>
    document.getElementById('importForm').addEventListener('submit', function() {
      const btn = this.querySelector('button[type="submit"]');
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Importing...';
    });
  </script>
</x-layouts.app>
