# Polli Cart - Bangladeshi E-Commerce Platform

## Overview

Polli Cart is a modern, production-ready e-commerce platform built with Laravel. It specializes in selling authentic, fresh products from rural Bangladesh including:

- Fresh Fish
- Meat
- Chui Jhal (Hot Peppers)
- Honey
- Rice & Pulses
- Jaggery/Gur
- Vegetables & Fruits
- Grocery Products
- Traditional Bangladeshi Food
- Clothing
- And more...

## Features

### Customer Features
- 🛍️ Product browsing, search & filtering
- 🛒 Shopping cart & wishlist
- 📦 Multi-step checkout
- 💳 Multiple payment methods (SSLCommerz, bKash, Nagad, COD)
- 📍 Address management
- 📋 Order tracking
- ⭐ Product reviews & ratings
- 🎟️ Coupon & discount system
- 🔐 Secure OTP + Password authentication
- 📧 Email notifications

### Admin Features
- 📊 Dashboard with analytics
- 📦 Product management
- 🏷️ Category management
- 📋 Order management
- 👥 Customer management
- 🎟️ Coupon management
- 🚚 Delivery zone configuration
- 📰 Blog management
- ⭐ Review moderation
- 📊 Sales reports
- 🔐 Role-based access control
- 🛡️ Admin 2FA security
- 📝 Activity logs

## Tech Stack

- **Backend**: Laravel 11
- **Database**: MySQL
- **Frontend**: Blade + Tailwind CSS + Alpine.js
- **Cache**: Redis (optional)
- **Authentication**: OTP + Password + 2FA
- **Payment**: SSLCommerz + Payment Gateway Service Layer

## Installation

### Prerequisites

- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js 18+

### Setup Steps

1. Clone the repository
```bash
git clone https://github.com/mdtrtahim-lgtm/Polli-Cart.git
cd Polli-Cart
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`
```
DB_DATABASE=polli_cart
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations
```bash
php artisan migrate
```

6. Seed demo data
```bash
php artisan db:seed
```

7. Build frontend assets
```bash
npm run dev
```

8. Start development server
```bash
php artisan serve
```

Access at: `http://localhost:8000`

### Demo Credentials

**Admin:**
- Email: `admin@pollicart.com`
- Password: `password`
- 2FA: Enabled (use OTP from email)

**Customer:**
- Mobile: `01700000001`
- Password: `password`

## Project Structure

```
app/
├── Console/
├── Events/
├── Exceptions/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Jobs/
├── Listeners/
├── Mail/
├── Models/
├── Notifications/
├── Policies/
├── Services/
└── Traits/

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/
    ├── admin/
    ├── customer/
    ├── auth/
    ├── emails/
    └── layouts/

routes/
├── web.php
├── admin.php
├── auth.php
└── api.php
```

## Database

All database tables are created via Laravel migrations. Key tables include:

- `users` - Customers & admins
- `roles`, `permissions` - RBAC system
- `categories`, `products`, `product_variations` - Catalog
- `carts`, `cart_items` - Shopping
- `orders`, `order_items` - Fulfillment
- `payments`, `payment_transactions` - Payments
- `delivery_zones` - Shipping
- `coupons`, `coupon_usages` - Promotions
- `reviews` - Customer feedback
- `activity_logs` - Audit trail

## Security

Polli Cart implements comprehensive security measures:

- ✅ HTTPS enforced
- ✅ CSRF protection on all forms
- ✅ SQL Injection prevention (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ Authentication & authorization
- ✅ Admin 2FA
- ✅ Rate limiting
- ✅ Activity logging
- ✅ Secure password hashing
- ✅ OTP security
- ✅ File upload validation

## API (Future)

The backend is designed to support a REST API. API endpoints can be added in `routes/api.php` using Laravel API Resources.

## Testing

Run tests with:

```bash
php artisan test
```

Test coverage includes:
- Authentication & Authorization
- Product management
- Cart operations
- Order processing
- Payment verification
- Coupon validation

## Deployment

See `docs/DEPLOYMENT.md` for production deployment instructions.

## Documentation

- [Architecture](docs/ARCHITECTURE.md)
- [Database Schema](docs/DATABASE.md)
- [API Documentation](docs/API.md)
- [Security Guide](docs/SECURITY.md)
- [Deployment Guide](docs/DEPLOYMENT.md)

## Contributing

This is a commercial project. Contact the maintainer for contribution guidelines.

## License

All rights reserved. Polli Cart is proprietary software.

## Support

For support, contact: support@pollicart.com

## Authors

- Md Iftakhar Ahnaf Rahman (mdtrtahim-lgtm)

---

**Made with ❤️ for Bangladesh**
