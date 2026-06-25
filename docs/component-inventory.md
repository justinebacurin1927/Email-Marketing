# Component Inventory — SendFlow

## Blade View Components

### Layouts
- `layouts/app.blade.php` — Main application layout with sidebar navigation, topbar, and content area

### Dashboard
- `dashboard/index.blade.php` — Dashboard with live clock, greeting, stat cards, bar + doughnut charts, quick action tiles, recent campaigns list

### Campaigns
- `campaigns/campaigns.blade.php` — Campaigns list with status badges
- `campaigns/create.blade.php` — Campaign creation form with template/contact/tag selection
- `campaigns/edit.blade.php` — Campaign edit form
- `campaigns/preview.blade.php` — Email preview with iframe + recipient list sidebar
- `campaigns/view-email.blade.php` — Rendered email view

### Automations
- `automations/index.blade.php` — Automation workflows list with status toggles
- `automations/create.blade.php` — Multi-step automation creation form
- `automations/edit.blade.php` — Automation edit form with step management

### Audience
- `audience/` directory — Contact management views

### Components (Shared)
- Reusable Blade components for UI elements

## Frontend Assets

### CSS
- Tailwind CSS v4 (via `resources/css/`)
- Custom styles (`, gradient backgrounds, sidebar)

### JavaScript
- Alpine.js for interactivity (charts, toggles, UI state)
- Axios for HTTP requests
- Vite for module bundling and HMR

## Design System

### Colors
- Navy: `#1a1a2e`, `#16213e` (sidebar, backgrounds)
- Coral: `#e94560`, `#c23152` (accents, buttons)
- Purple: `#533483` (highlights)
- Deep Blue: `#0f3460` (cards, sections)
- Dark gradient backgrounds on stat cards
- Status badges: sent (green), draft (yellow), scheduled (blue)

### Layout
- Fixed left sidebar with navigation links
- Responsive design via Tailwind
- Card-based UI for stats and content
- Modal forms for create/edit operations
