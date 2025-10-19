<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <?php if (isset($component)) { $__componentOriginal7f27d4f21ff184c2d29c20efafbd7387 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f27d4f21ff184c2d29c20efafbd7387 = $attributes; } ?>
<?php $component = App\View\Components\Topbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Topbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f27d4f21ff184c2d29c20efafbd7387)): ?>
<?php $attributes = $__attributesOriginal7f27d4f21ff184c2d29c20efafbd7387; ?>
<?php unset($__attributesOriginal7f27d4f21ff184c2d29c20efafbd7387); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f27d4f21ff184c2d29c20efafbd7387)): ?>
<?php $component = $__componentOriginal7f27d4f21ff184c2d29c20efafbd7387; ?>
<?php unset($__componentOriginal7f27d4f21ff184c2d29c20efafbd7387); ?>
<?php endif; ?>

  <!-- Bootstrap Icons -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    rel="stylesheet"
  />

  <style>
    .contacts-section {
      margin-top: 80px;
    }

    /* ===== Scrollbar (Mailchimp-style) ===== */
    ::-webkit-scrollbar {
      height: 8px;
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: #c7c9cc;
      border-radius: 10px;
      transition: background 0.3s ease;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #a3a6aa;
    }
    * {
      scrollbar-width: thin;
      scrollbar-color: #c7c9cc transparent;
    }

    /* ===== Table container with scrollbar ===== */
    .table-scroll {
      overflow-x: auto;
      overflow-y: hidden;
      width: 100%;
      max-width: 100%;
    }

    .table thead th {
      position: sticky;
      top: 0;
      background: #f8f9fa;
      z-index: 3;
    }

    .filter-scroll-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    /* ===== Dropdown styling ===== */
    .dropdown {
      position: relative;
    }

    .dropdown-toggle {
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: calc(100% + 6px);
      left: 0;
      min-width: 220px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 6px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
      padding: 8px;
      z-index: 9999;
    }

    .dropdown-menu.show {
      display: block !important;
    }

    .dropdown-menu input[type="search"] {
      width: 100%;
      padding: 6px 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 6px;
    }

    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px 6px;
      cursor: pointer;
    }

    .dropdown-item input[type="checkbox"] {
      margin: 0;
    }
  </style>

  <div class="card border-0 shadow-sm mb-5 contacts-section">
    <div class="card-body position-relative">
      <!-- HEADER -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Contacts</h4>
        <div class="header-actions d-flex gap-2">
          <div class="dropdown">
            <button
              type="button"
              class="btn btn-outline-secondary dropdown-toggle"
              aria-expanded="false"
            >
              More options <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="#">Audience settings</a>
              <a class="dropdown-item" href="#">Audience fields and merge tags</a>
              <a class="dropdown-item" href="#">Unsubscribe emails</a>
              <a class="dropdown-item" href="#">Groups</a>
              <a class="dropdown-item" href="#">Audience overview</a>
              <a class="dropdown-item" href="#">Archive contacts</a>
              <a class="dropdown-item" href="#">Import history</a>
              <a class="dropdown-item" href="#">Export history</a>
            </div>
          </div>

          <div class="dropdown">
            <button
              type="button"
              class="btn btn-outline-secondary dropdown-toggle"
              aria-expanded="false"
            >
              Add contacts <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="#">Import contacts</a>
              <a class="dropdown-item" href="#">Add a single contact</a>
            </div>
          </div>
        </div>
      </div>

      <!-- FILTERS -->
      <div class="d-flex gap-2 mb-3 align-items-center filter-scroll-container">
        <div class="dropdown">
          <button
            type="button"
            class="btn btn-outline-secondary dropdown-toggle"
            aria-expanded="false"
          >
            Segments <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <input type="search" placeholder="Search segments..." />
            <label class="dropdown-item"><input type="checkbox" /> VIP Customers</label>
            <label class="dropdown-item"><input type="checkbox" /> Newsletter</label>
            <label class="dropdown-item"><input type="checkbox" /> Recent Buyers</label>
          </div>
        </div>

        <div class="dropdown">
          <button
            type="button"
            class="btn btn-outline-secondary dropdown-toggle"
            aria-expanded="false"
          >
            Subscription status <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <label class="dropdown-item"><input type="checkbox" /> Email subscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email unsubscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email non-subscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email cleaned</label>
          </div>
        </div>

        <div class="dropdown">
          <button
            type="button"
            class="btn btn-outline-secondary dropdown-toggle"
            aria-expanded="false"
          >
            Tags <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <input type="search" placeholder="Search tags..." />
            <label class="dropdown-item"><input type="checkbox" /> Premium</label>
            <label class="dropdown-item"><input type="checkbox" /> Trial</label>
            <label class="dropdown-item"><input type="checkbox" /> Promo</label>
          </div>
        </div>

        <div class="dropdown">
          <button
            type="button"
            class="btn btn-outline-secondary dropdown-toggle"
            aria-expanded="false"
          >
            Signup source <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <input type="search" placeholder="Search source..." />
            <label class="dropdown-item"><input type="checkbox" /> Website</label>
            <label class="dropdown-item"><input type="checkbox" /> Shopify</label>
            <label class="dropdown-item"><input type="checkbox" /> Manual Add</label>
          </div>
        </div>

        <button class="btn btn-outline-secondary">
          <i class="bi bi-sliders"></i> Advanced filters
        </button>
      </div>

      <p class="text-muted mb-3">1 total contact. 1 email subscriber.</p>

      <div class="input-group mb-4" style="max-width: 350px;">
        <span class="input-group-text bg-white border-end-0"
          ><i class="bi bi-search"></i
        ></span>
        <input
          type="text"
          class="form-control border-start-0"
          placeholder="Search contacts"
        />
      </div>

      <!-- TABLE -->
      <div class="table-scroll">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th><input type="checkbox" /></th>
              <th>Email Address</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Address</th>
              <th>Phone Number</th>
              <th>Birthday</th>
              <th>Company</th>
              <th>Tags</th>
              <th>Email Marketing</th>
              <th>Source</th>
              <th>Rating</th>
              <th>Date Added</th>
              <th>Last Changed</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox" /></td>
              <td class="text-primary fw-semibold">
                justinecane.bacuring250811@gmail.com
              </td>
              <td>Justine Cane</td>
              <td>Bacurin</td>
              <td>
                Jaycee<br />1151 Torres Bugallon St<br />Barangay 204, Tondo<br />Tondo
                1013<br />Philippines
              </td>
              <td>0925235296</td>
              <td>08-19-05</td>
              <td>Gleent Inc.</td>
              <td>-</td>
              <td>
                <span class="badge bg-success-subtle text-success border"
                  >Subscribed</span
                >
              </td>
              <td>Admin Add</td>
              <td>
                <span class="text-warning">★</span><span class="text-warning">★</span
                ><span class="text-secondary">★</span>
              </td>
              <td>10/14</td>
              <td>3hrs & 4mins</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    (function () {
      const closeAll = () => {
        document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
          menu.classList.remove("show");
          const btn = menu.closest(".dropdown")?.querySelector(".dropdown-toggle");
          if (btn) btn.setAttribute("aria-expanded", "false");
        });
      };

      document.addEventListener("click", (e) => {
        const toggle = e.target.closest(".dropdown-toggle");
        if (toggle) {
          e.preventDefault();
          e.stopPropagation();
          const dropdown = toggle.closest(".dropdown");
          const menu = dropdown.querySelector(".dropdown-menu");
          const isOpen = menu.classList.contains("show");
          closeAll();
          if (!isOpen) {
            menu.classList.add("show");
            toggle.setAttribute("aria-expanded", "true");
          }
          return;
        }

        const insideMenu = e.target.closest(".dropdown-menu");
        if (insideMenu) {
          if (e.target.tagName === "A") closeAll();
          return;
        }

        closeAll();
      });

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeAll();
      });

      document.addEventListener("input", (e) => {
        const input = e.target;
        if (!input.matches('.dropdown-menu input[type="search"]')) return;
        const term = input.value.toLowerCase();
        input.parentElement.querySelectorAll(".dropdown-item").forEach((item) => {
          item.style.display = item.textContent.toLowerCase().includes(term)
            ? ""
            : "none";
        });
      });
    })();
  </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/audience.blade.php ENDPATH**/ ?>