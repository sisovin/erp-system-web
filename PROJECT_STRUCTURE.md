# Project Structure (quick reference)

This file summarizes the key folders and files in the Peanech ERP package you received.

Root
- .env                   ← local environment (not committed)
- .env.example           ← example env variables
- composer.json
- package.json
- README.md
- PROJECT_SUMMARY.md
- START_HERE.md
- DELIVERABLES.md
- .gitignore

erp-system/ (main application)
- public/                ← front controller and public assets
- app/                   ← application code (Core, Controllers, Services, Models)
- resources/             ← views and css source
- cli/                   ← migrate.php, seed.php, sync scripts
- storage/               ← logs, cache, sessions
- config/                ← configuration (env loader, constants)

Key files
- public/index.php       ← front controller (entry point)
- app/Core/              ← Router, Controller base, Auth middleware
- cli/migrate.php        ← DB migrations (19 tables)
- cli/seed.php           ← sample data & default users
- resources/views/       ← templates and UI

Notes
- Use `config/env.php` to load `.env` into runtime via `env()` helper.
- Use `config/constants.php` to access configuration constants throughout the app.
- Migrations and seeds live in `cli/` for easy CLI usage.
