# 🚀 LaraBoard: Multi-Tenant Task Manager
> **Goal:** Master Laravel by building a production-grade task manager.  
> **Stack:** Laravel 13, MySQL, Redis, Blade (SSR), Docker (Sail).  
> **Dev Profile:** .NET Backend Developer transitioning to PHP/Laravel.

---
## ️ Phase 0: Environment & Tooling ✅ [COMPLETE]
*Status: Docker/Sail stack running, DB connected, Welcome page visible.*
- [x] Setup Laravel Sail (Dockerized PHP/MySQL/Redis)
- [x] Verify `http://<WSL_IP>` loads Laravel 13 welcome page
- [x] Initialize Git repository

---
## 🔐 Phase 1: Auth & Core MVC (The "Hello World" of Web Apps)
*Goal: Understand the Request Lifecycle, Routing, and Blade Templating.*
- [ ] **Install Breeze:** `sail composer require laravel/breeze --dev && sail php artisan breeze:install blade`
- [ ] **Map Concepts:** 
    - `.NET Razor Views` → `Laravel Blade` (`resources/views`)
    - `[Route]` Attributes → `routes/web.php`
    - `[HttpPost]` → `Route::post()`
- [ ] **Task:** Create a simple "Dashboard" view that only logged-in users can see.
- [ ] **Validation:** Learn `FormRequest` classes (Laravel's version of FluentValidation/DataAnnotations).

---
## 🏗️ Phase 2: Database & Eloquent ORM (Active Record Pattern)
*Goal: Move from EF Core (Data Mapper) to Eloquent (Active Record).*
- [ ] **Models & Migrations:** 
    - `User` ↔ `Workspace` (Many-to-Many or One-to-Many)
    - `Workspace` → `Project` (One-to-Many)
    - `Project` → `Task` (One-to-Many)
- [ ] **Eloquent Relationships:** 
    - Learn `hasMany`, `belongsTo`, `belongsToMany`.
    - *Key Difference:* In Laravel, you define relationships as methods on the Model class itself.
- [ ] **Seeding:** Use Factories to generate fake data (like Bogus in .NET).
- [ ] **N+1 Problem:** Learn `with()` for eager loading (equivalent to `.Include()` in EF Core).

---
## 🛡️ Phase 3: Multi-Tenancy & Middleware (Security)
*Goal: Ensure User A never sees User B's data.*
- [ ] **Middleware:** Create `EnsureWorkspaceAccess` middleware (similar to ASP.NET Core Action Filters).
- [ ] **Global Scopes:** Apply a global scope to `Project` and `Task` models so every query automatically adds `WHERE workspace_id = X`.
- [ ] **Policy/Authorization:** Use Laravel Gates/Policies (similar to ASP.NET Core Authorization Handlers) to check if a user can `update` or `delete` a task.

---
## ⚡ Phase 4: Async Processing & Events (Queues)
*Goal: Offload heavy tasks (emails) to background workers.*
- [ ] **Events & Listeners:** Dispatch a `TaskAssigned` event when a task is created.
- [ ] **Notifications:** Send an email via Mailpit (local SMTP catcher).
- [ ] **Queues:** Configure Redis as the queue driver. Run `sail php artisan queue:work`.
- [ ] **Mapping:** 
    - `IHostedService` / Hangfire → `php artisan queue:work`
    - `MediatR` → Laravel Events/Listeners

---
## 🧪 Phase 5: Testing & Quality (Your Comfort Zone)
*Goal: Apply your xUnit discipline to PHP.*
- [ ] **Pest PHP:** Install Pest (`composer require pestphp/pest --dev`). It’s a cleaner, more modern test runner than PHPUnit.
- [ ] **Feature Tests:** Write tests for API endpoints and UI flows.
- [ ] **Static Analysis:** Install PHPStan to catch type errors before runtime (similar to Roslyn Analyzers).

---
## 📦 Phase 6: Deployment Simulation (AWS/Terraform)
*Goal: Deploy to a cloud environment.*
- [ ] **Dockerize for Prod:** Optimize Dockerfile for production.
- [ ] **AWS EC2/RDS:** Provision infrastructure using Terraform.
- [ ] **CI/CD:** Set up GitHub Actions to run tests and deploy code.

---
### 💡 .NET → Laravel Cheat Sheet
| Concept | .NET / ASP.NET Core | Laravel |
| :--- | :--- | :--- |
| **DI Container** | `Program.cs` (`services.AddScoped`) | Service Container (`App::bind()`, Type-hinting) |
| **ORM** | Entity Framework Core | Eloquent ORM |
| **Migrations** | `dotnet ef migrations add` | `php artisan make:migration` |
| **Validation** | Data Annotations / FluentValidation | Form Requests (`make:request`) |
| **Background Jobs** | Hangfire / IHostedService | Queues (`Queue::push()`, `php artisan queue:work`) |
| **Config** | `appsettings.json` | `.env` + `config/*.php` |
| **Testing** | xUnit / NUnit | Pest / PHPUnit |

