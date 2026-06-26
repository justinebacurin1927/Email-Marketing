<x-layouts.app title="Help Center — SendFlow">
  <div class="container-fluid px-4 py-4" style="max-width: 900px; min-height: calc(100vh - 3.5rem); background: #2b2b3d;">
    <div class="d-flex align-items-center gap-3 mb-4">
      <img src="{{ asset('icon.svg') }}" alt="" style="width: 2rem; height: 2rem;">
      <div>
        <h4 class="fw-bold mb-0 text-white">Help Center</h4>
        <small style="color: #d0d0d0; font-weight: 500;">Everything you need to know about SendFlow</small>
      </div>
    </div>

    <div class="mb-4">
      <input type="text" id="helpSearch" class="form-control" placeholder="Search the help manual..." onkeyup="filterHelp()"
        style="background: #3a3a4d; border: 1px solid #4a4a5d; color: #e0e0e0;">
    </div>

    <div id="helpContent">

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-rocket-takeoff me-2"></i>Getting Started</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <h6 class="fw-semibold" style="color: #d0d0e0;">Creating an Account</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Go to the <a href="{{ route('register') }}" style="color: #4fc3f7;">Register</a> page and fill in your name, email, and password. Once registered, you'll be logged in automatically.</p>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Demo Account</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">On the <a href="{{ route('login') }}" style="color: #4fc3f7;">Login</a> page, click <strong>Try Demo Account</strong> to instantly access a pre-populated account with sample contacts, campaigns, templates, and more — no sign-up needed.</p>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Forgot Password</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Click <strong>Forgot password?</strong> on the login page, enter your email, and a reset link will be generated. In demo mode, the link is shown directly on screen.</p>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <p class="small" style="color: #d0d0d0; font-weight: 500;">The dashboard gives you a bird's-eye view of your email marketing performance:</p>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li><strong style="color: #d0d0e0;">Total Campaigns</strong> — number of campaigns created</li>
              <li><strong style="color: #d0d0e0;">Total Contacts</strong> — number of contacts in your audience</li>
              <li><strong style="color: #d0d0e0;">Sent Campaigns</strong> — campaigns that have been dispatched</li>
              <li><strong style="color: #d0d0e0;">Scheduled Campaigns</strong> — campaigns set to send later</li>
              <li><strong style="color: #d0d0e0;">Tags Breakdown</strong> — see how your contacts are distributed across tags</li>
              <li><strong style="color: #d0d0e0;">Recent Campaigns</strong> — quick access to your latest campaigns</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-envelope me-2"></i>Campaigns</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <h6 class="fw-semibold" style="color: #d0d0e0;">Creating a Campaign</h6>
            <ol class="small" style="color: #d0d0d0; font-weight: 500;">
              <li>Click <strong style="color: #e0e0f0;">New Campaign</strong> in the sidebar or the <strong style="color: #e0e0f0;">+</strong> button next to the SendFlow logo</li>
              <li>Give your campaign a name</li>
              <li>Select a message template (create one in <a href="{{ route('templates.index') }}" style="color: #4fc3f7;">Templates</a> first)</li>
              <li>Choose recipients — either specific contacts or by tag</li>
              <li>Set a send date, or leave blank to save as draft</li>
            </ol>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Sending a Campaign</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">From the campaigns list, click the campaign to open its detail panel, then click <strong style="color: #e0e0f0;">Send</strong>. You can also preview the email first with <strong style="color: #e0e0f0;">Preview</strong>.</p>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Campaign Statuses</h6>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li><strong style="color: #d0d0e0;">Draft</strong> — being worked on, not yet sent</li>
              <li><strong style="color: #d0d0e0;">Scheduled</strong> — set to send on a future date</li>
              <li><strong style="color: #d0d0e0;">Sent</strong> — successfully dispatched</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-file-text me-2"></i>Message Templates</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Templates are reusable email layouts. Create one with a name, subject line, and HTML body, then use it in multiple campaigns.</p>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li>Go to <strong style="color: #e0e0f0;">Templates</strong> in the sidebar</li>
              <li>Click <strong style="color: #e0e0f0;">Create Template</strong> to build a new one</li>
              <li>Use the <strong style="color: #e0e0f0;">editor</strong> to write your email content with HTML</li>
              <li>Save and assign templates to campaigns</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-people me-2"></i>Contacts &amp; Audience</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <h6 class="fw-semibold" style="color: #d0d0e0;">Managing Contacts</h6>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li><strong style="color: #e0e0f0;">Add</strong> — fill in name, email, company, location, and subscription status</li>
              <li><strong style="color: #e0e0f0;">Import</strong> — upload a CSV or Excel file to bulk-add contacts</li>
              <li><strong style="color: #e0e0f0;">Export</strong> — download your contacts as CSV</li>
              <li><strong style="color: #e0e0f0;">Edit</strong> — click the edit icon on any contact row</li>
              <li><strong style="color: #e0e0f0;">Delete</strong> — select contacts and bulk delete</li>
            </ul>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Tags</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Organize contacts with tags (e.g. "VIP", "Newsletter"). Filter and target specific groups when sending campaigns.</p>

            <h6 class="fw-semibold mt-3" style="color: #d0d0e0;">Labels</h6>
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Labels help organize your inbox messages (e.g. "Important", "Follow Up").</p>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-inbox me-2"></i>Inbox</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <p class="small" style="color: #d0d0d0; font-weight: 500;">The inbox receives inbound email replies and messages. Features include:</p>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li><strong style="color: #e0e0f0;">Tabs</strong> — filter by To Do, Done, Trash, or view All</li>
              <li><strong style="color: #e0e0f0;">Search</strong> — find messages by sender or subject</li>
              <li><strong style="color: #e0e0f0;">Source/Label filters</strong> — narrow down messages</li>
              <li><strong style="color: #e0e0f0;">Reply</strong> — respond directly from the inbox</li>
              <li><strong style="color: #e0e0f0;">Mark as done / Trash</strong> — manage message states</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-lightning me-2"></i>Automations</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Automations let you trigger actions based on events:</p>
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li>Create an automation with a <strong style="color: #e0e0f0;">trigger</strong> (e.g. campaign sent, contact added)</li>
              <li>Add <strong style="color: #e0e0f0;">steps</strong> to define what happens (e.g. send email, tag contact)</li>
              <li><strong style="color: #e0e0f0;">Enable/disable</strong> automations from the list</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-wifi me-2"></i>Sources</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <p class="small" style="color: #d0d0d0; font-weight: 500;">Sources are email addresses that receive inbound messages. Add forwarding addresses and configure them in your Mailgun domain to start receiving replies.</p>
          </div>
        </div>
      </div>

      <div class="help-section card shadow-sm border-0 rounded-3 mb-3">
        <div class="card-body p-4" onclick="toggleSection(this)" style="cursor: pointer; background: #3a3a4d;">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0" style="color: #4fc3f7;"><i class="bi bi-person me-2"></i>Profile Settings</h5>
            <i class="bi bi-chevron-down toggle-icon" style="color: #4fc3f7;"></i>
          </div>
          <div class="help-body mt-3" style="display: none;">
            <ul class="small" style="color: #d0d0d0; font-weight: 500;">
              <li><strong style="color: #e0e0f0;">Update</strong> your name and email</li>
              <li><strong style="color: #e0e0f0;">Change password</strong> — enter current + new password</li>
              <li><strong style="color: #e0e0f0;">Upload avatar</strong> — profile picture (JPEG, PNG, max 2MB)</li>
              <li><strong style="color: #e0e0f0;">Remove avatar</strong> — revert to initial-based avatar</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    function toggleSection(el) {
      const body = el.querySelector('.help-body');
      const icon = el.querySelector('.toggle-icon');
      const isOpen = body.style.display !== 'none';
      body.style.display = isOpen ? 'none' : 'block';
      icon.classList.toggle('bi-chevron-down', isOpen);
      icon.classList.toggle('bi-chevron-up', !isOpen);
    }

    function filterHelp() {
      const query = document.getElementById('helpSearch').value.toLowerCase();
      document.querySelectorAll('.help-section').forEach(section => {
        const text = section.textContent.toLowerCase();
        section.style.display = text.includes(query) ? '' : 'none';
      });
    }

    const firstBody = document.querySelector('.help-section .help-body');
    const firstIcon = document.querySelector('.help-section .toggle-icon');
    if (firstBody) firstBody.style.display = 'block';
    if (firstIcon) firstIcon.classList.replace('bi-chevron-down', 'bi-chevron-up');
  </script>
</x-layouts.app>
