# 📋 LaraBoard Progress Tracker
> **Target**: Multi-Tenant Task Management (Laravel 11 + Sail + PostgreSQL + Redis)  
> **Status**: 🔲 Not Started | 🟡 In Progress | ✅ Complete

---
## 🔧 Phase 0: Environment & Tooling Setup
*Goal: Local dev stack matching your Docker/PostgreSQL experience*

- [ ] Install prerequisites: Docker Desktop, Git, Node.js (LTS)
- [ ] Create Laravel project: `composer create-project laravel/laravel laraboard`
- [ ] Enter project: `cd laraboard`
- [ ] Configure `.env` for PostgreSQL & Redis:
  ```env
  DB_CONNECTION=pgsql
  DB_HOST=pgsql
  DB_PORT=5432
  DB_DATABASE=laraboard
  DB_USERNAME=sail
  DB_PASSWORD=password
  QUEUE_CONNECTION=redis