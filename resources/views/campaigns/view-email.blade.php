<x-layouts.app>
    <x-topbar />

    <div class="px-4 py-4 mt-5">
        <h1 class="h4 fw-bold mb-3">{{ $campaign->name }} - Email Preview</h1>

        @if($template)
        <div class="d-flex gap-4">
            <!-- Left side: Email preview (50%) -->
            <div class="border rounded p-3 shadow-sm bg-white email-content" style="flex: 1;">
                <div class="mb-3 p-2 bg-light border-bottom rounded-top">
                    <strong>Template: {{ $template->name }}</strong>
                </div>
                <div>
                    {!! $template->body !!}
                </div>
            </div>

            <!-- Right side: Placeholder (50%) -->
            <div class="border rounded p-3 shadow-sm bg-light" style="flex: 1;">
                <p class="text-muted">Right side area for future planning or additional content.</p>
            </div>
        </div>
        @else
            <p class="text-muted">No template assigned to this campaign.</p>
        @endif

        <a href="{{ route('campaigns.index') }}" class="btn btn-secondary mt-3">Back to Campaigns</a>
    </div>

    <style>
        .email-content {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .email-content img {
            max-width: 100%;
            height: auto;
        }
        .email-content .bg-light {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
    </style>
</x-layouts.app>
