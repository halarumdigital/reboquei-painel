# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Reboquei is a **ride-hailing/tow-truck platform** (similar to Uber) built on **Laravel 8** with PHP 7.3+/8.2+. It provides a web admin panel, dispatcher panel, API for mobile apps (user/driver), and a web booking interface. The system supports multi-tenancy via `hyn/multi-tenant`.

## Common Commands

```bash
# Serve locally
php artisan serve

# Run tests
php artisan test
./vendor/bin/phpunit                    # full suite
./vendor/bin/phpunit --filter=TestName  # single test

# Database
php artisan migrate
php artisan db:seed
php artisan db:seed --class=SettingsSeeder  # single seeder

# Cache management
php artisan config:cache
php artisan route:cache
php artisan cache:clear

# Frontend assets
npm run dev        # compile with Laravel Mix
npm run production # production build

# Queue worker (used for notifications, ride matching)
php artisan queue:work
```

## Architecture

### Routing Pattern
Routes are split into files under `routes/web/` and `routes/api/v1/` directories. A custom `include_route_files()` helper (in `app/Helpers/helpers.php`) auto-loads all PHP files from these folders recursively. Main entry points are `routes/web.php` and `routes/api.php`.

- **Web routes** (`routes/web/`): `admin.php`, `auth.php`, `dispatch.php`, `delivery-dispatcher.php`, `user.php`, `common.php`
- **API routes** (`routes/api/v1/`): `auth.php`, `driver.php`, `user.php`, `request.php`, `payment.php`, `dispatcher.php`, `owner.php`, `common.php`

### Controller Organization
- `app/Http/Controllers/Api/V1/` — Mobile API endpoints (versioned v1), organized by domain: `Request/`, `Driver/`, `User/`, `Auth/`, `Payment/`, `Owner/`, `Dispatcher/`
- `app/Http/Controllers/Web/Admin/` — Admin panel controllers (dashboard, drivers, owners, fleet, reports, etc.)
- `app/Http/Controllers/Web/Dispatcher/` — Dispatcher panel for manual ride assignment
- `app/Http/Controllers/Web/DeliveryDispatcher/` — Delivery-specific dispatching
- `app/Http/Controllers/Web/Web_Booking/` — Web-based booking interface
- `app/Http/Controllers/Web/Auth/` — Web authentication (login, registration)
- `ApiController` → `BaseController` (V1) is the base for all API controllers; provides `getValidatedUpload()` and `validateAdmin()`

### Model Organization
Models are namespaced by domain under `app/Models/`:
- `Admin/` — Driver, Fleet, Owner, Zone, ZoneType, VehicleType, PromoCode, Company, etc.
- `Request/` — Request (ride), RequestBill, RequestMeta, RequestPlace, RequestRating, RequestStop, etc.
- `Payment/` — CardInfo, wallets (Driver/User/Owner), WalletWithdrawalRequest
- `Access/` — Role, Permission (RBAC)
- `Master/` — CarMake, CarModel, PackageType, MailTemplate, BannerImage
- Root-level: User, Country, City, State, Setting, ThirdPartySetting

### Role-Based Access
Roles are defined in `App\Base\Constants\Auth\Role`: `super-admin`, `admin`, `user`, `driver`, `owner`, `dispatcher`, `delivery-dispatcher`, `manager`, `sub-admin`. Auth uses Laravel Passport (API) and session-based auth (web panel).

### Ride Request Lifecycle
Trip statuses flow through: `REQUESTED` → `DRIVING_TO_PICKUP` → `ARRIVED_AT_PICKUP` → `COMPLETED` (or `CANCELLED`/`CANCELLED_BY_DRIVER`/`CAR_NOT_AVAILABLE`). Defined in `App\Base\Constants\Taxi\TripStatus`.

### Key Architectural Layers
- **`app/Base/`** — Core framework abstractions: Payment interfaces, Constants (auth roles, trip statuses, payment types, booking statuses), Services (Hash, OTP, PDF, Settings, ImageUploader), Validators, Filters, Serializers
- **`app/Helpers/`** — Domain helpers: `Rides/` (price calculation, driver matching, commission), `Payment/`, `Notification/`, `Auth/`, `Response/`, `Countries/`, `TimeZones/`. Global helpers in `helpers.php` (auto-loaded via composer)
- **`app/Transformers/`** — Fractal transformers for API responses (via `spatie/laravel-fractal`)
- **`app/Jobs/`** — Async jobs: driver matching (`SendRequestToNextDriversJob`), notifications (`NotifyViaMqtt`, `NotifyViaSocket`), no-driver-found handling
- **`app/Console/`** — Scheduled commands: `AssignDriversForScheduledRides`, `CancelRequests`, `OfflineUnAvailableDrivers`, `ClearOtp`, `NotifyDriverDocumentExpiry`

### Payment Gateways
Multiple gateways supported: Stripe, PayPal, Razorpay, Braintree, MercadoPago, Cashfree, Flutterwave, Paystack, Khalti, Thawani, VNPay, CCAvenue. Payment interface at `app/Base/Payment/PaymentInterface.php`. Gateway keys are loaded dynamically from `settings` DB table via `PaymentGatewayServiceProvider`.

### Service Bindings (UBServiceProvider)
Core services bound as singletons: `HashGeneratorContract`, `ImageUploaderContract`, `ImageEncoderContract`, `OTPGeneratorContract`, `OTPHandlerContract`, `PDFGeneratorContract`, `PDFCreatorContract`, `SettingContract` (database-backed settings).

### Notifications
Push notifications via Firebase Cloud Messaging (`laravel-notification-channels/fcm`). Real-time via MQTT and Socket. Firebase config via `FIREBASE_CREDENTIALS` env variable.

### Spatial/Geographic Features
Uses `grimzy/laravel-mysql-spatial` for MySQL spatial queries. Zones defined with geographic bounds (`ZoneBound` model). Geohashing via `saikiran/geohash`. Zone-based pricing with `ZoneTypePrice`, `ZoneTypeSurgePrice`.

### Frontend
Admin panel uses server-side Blade templates (`resources/views/admin/`). Static assets in `public/assets/` with various jQuery plugins and vendor components. Laravel Mix handles JS/CSS compilation.

### Multi-Tenancy
Uses `hyn/multi-tenant` package. Config at `config/tenancy.php`. Supports multiple hostnames/websites.

### File Uploads
Configured in `config/base.php`. Default storage is public disk (`storage/app/public/uploads/`). Image encoding to JPEG with allowed MIME types: jpeg, png, bmp.
