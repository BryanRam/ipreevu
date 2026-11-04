## Ipreevu

Ipreevu is a recreation of the CSS Conference Web (<a href="https://github.com/BryanRam/conference_web" target="_blank">conference_web</a>) built in Laravel 9. It is a work in progress update from the previous version that was built in an old lightweight version of Laravel called Lumen, and configured to run in Heroku.

# Coming soon: Instructions for running Ipreevu locally

## Deploying to Vercel

Uses the `vercel-php` runtime (`vercel.json`, `api/index.php`). Set these env vars in the Vercel project: `APP_KEY` (`php artisan key:generate --show`), `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (a hosted DB, e.g. Neon/Supabase Postgres). Then run `php artisan migrate --seed` against that DB.

## Guest account

`php artisan db:seed --class=GuestUserSeeder` creates `guest@ipreevu.com` (password `guest1234`, override with `GUEST_PASSWORD`). Also included in `db:seed`.
