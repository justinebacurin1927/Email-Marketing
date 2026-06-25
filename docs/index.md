# SendFlow — Project Documentation Index

## Project Overview

- **Type:** Monolith — Laravel Web Application
- **Primary Language:** PHP 8.2
- **Architecture:** MVC with queue-based async processing

## Quick Reference

- **Tech Stack:** Laravel 12 / SQLite / Tailwind CSS 4 / Alpine.js / Vite
- **Entry Point:** `public/index.php` (via `artisan serve`)
- **Architecture Pattern:** MVC with Job/Command patterns for async work

## Generated Documentation

- [Project Overview](./project-overview.md)
- [Architecture](./architecture.md)
- [Source Tree Analysis](./source-tree-analysis.md)
- [Component Inventory](./component-inventory.md)
- [Data Models](./data-models.md)
- [API Contracts](./api-contracts.md)
- [Development Guide](./development-guide.md)
- [Deployment Guide](./deployment-guide.md)

## Getting Started

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=SampleDataSeeder
npm install && npm run build
composer dev
```

## Next Steps

This documentation serves as the foundation for the BMad workflow pipeline. When ready to plan new features, run:

1. `bmad-prd` — Create a Product Requirements Document
2. `bmad-ux` — Plan UX specifications
3. `bmad-architecture` — Refine architecture spine
4. `bmad-create-epics-and-stories` — Break into epics and user stories
5. `bmad-sprint-planning` — Plan a sprint
6. `bmad-dev-story` / `bmad-quick-dev` — Implement
