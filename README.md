# CRESCOTec Assignment - Laravel + Vue Patch

This folder contains the files you should add to a fresh Laravel project to implement the assignment described in the provided PDF (search/autocomplete across SWAPI, People list page combining SWAPI and local `characters` table, create and soft-delete custom characters).

**What this package contains**

-   Migration: `database/migrations/2025_01_01_000000_create_characters_table.php`
-   Model: `app/Models/Character.php`
-   Controller: `app/Http/Controllers/CharacterController.php` (API + web helper)
-   API Routes additions: `routes/api.php` (snippet)
-   Web Routes additions: `routes/web.php` (snippet)
-   Vue components: `resources/js/components/SearchBar.vue`, `PeopleList.vue`, `CreateCharacterModal.vue`
-   JS entry: `resources/js/app.js`
-   Tailwind config snippet and instructions
-   `package.json` snippet and build instructions

## Quick install (recommended)

1. Create a new Laravel project (example with Composer):
    ```bash
    composer create-project laravel/laravel crescotec-assignment
    cd crescotec-assignment
    ```
2. Copy the files from this `crescotec-laravel-vue-patch` into your Laravel project (merge into existing folders).
3. Install Node dependencies and build:
    ```bash
    npm install
    npm run dev
    ```
4. Run migrations:
    ```bash
    php artisan migrate
    ```
5. Serve:
    ```bash
    php artisan serve
    ```
6. Open the app (default http://127.0.0.1:8000). The main page has the search. People list at `/people`.

## Notes

-   This patch expects a normal Laravel project with Vite (Laravel 12+). The Vue components use Vue 3.
-   The SWAPI is used client-side for search/autocomplete and server-side for merging people list.
-   Soft deletes are implemented on the `characters` table.
-   See inline comments in controllers and components for details.
