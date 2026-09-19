# smart-activity-app-api
> The PHP/MySQL backend API for [react-smart-activity-app](https://github.com/PJasiczek/react-smart-activity-app) — user accounts, activity logging, and daily/monthly activity charts.

## Endpoints
* `user_registration.php` / `user_login.php` – account creation and login
* `publish_activity.php` / `activity_history.php` – log and retrieve recorded activities
* `user_chart_day_activity.php` / `user_chart_month_activity.php` – activity counts aggregated by day/month
* `user_data_values.php` / `user_account_modify.php` / `user_profile_modify.php` – read and update user profile data
* `index.php` – profile image upload
* `countries_pl.json` – country list used by the registration form

## Setup
Requires PHP with `mysqli` and a MySQL database matching the schema implied by the queries (`users`, `activity` tables). Connection settings are read from `dbconfig.php`.

## Status
**Archived** — not actively maintained.

Written in mid-2020 as the backend for [react-smart-activity-app](https://github.com/PJasiczek/react-smart-activity-app). The queries use raw string interpolation rather than prepared statements, so this is a learning-stage example rather than production-ready code.
