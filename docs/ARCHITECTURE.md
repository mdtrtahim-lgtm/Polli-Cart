# Polli Cart Architecture

## System Architecture Overview

```
┌──────────────────────────────────────────────────────────┐
│         Customer Web Interface                  │
│   (Blade Templates + Tailwind + Alpine.js)      │
└──────────────────────────────────┬──────────────────────┘
                     │
                     ↓
┌──────────────────────────────────────────────────────────┐
│      Laravel Backend (HTTP Kernel)              │
│  ├─ Middleware (Auth, RBAC, Rate Limiting)      │
│  ├─ Controllers (HTTP Request Handlers)         │
│  ├─ Form Requests (Validation)                  │
│  └─ Response Handlers                           │
└──────────────────────────────────┬──────────────────────┘
                     │
                     ↓
┌──────────────────────────────────────────────────────────┐
│         Service Layer (Business Logic)          │
│  ├─ AuthenticationService                       │
│  ├─ ProductService                              │
│  ├─ CartService                                 │
│  ├─ OrderService                                │
│  ├─ PaymentService                              │
│  ├─ DeliveryService                             │
│  └─ CouponService                               │
└──────────────────────────────────┬──────────────────────┘
                     │
                     ↓
┌──────────────────────────────────────────────────────────┐
│       Eloquent Models (Data Access Layer)       │
│  ├─ User, Role, Permission                      │
│  ├─ Product, Category, Variation                │
│  ├─ Order, OrderItem, OrderStatus               │
│  ├─ Payment, Transaction                        │
│  └─ ... (other models)                          │
└──────────────────────────────────┬──────────────────────┘
                     │
                     ↓
┌──────────────────────────────────────────────────────────┐
│   MySQL Database + Redis Cache                  │
│  ├─ Database (Primary data store)               │
│  └─ Cache (Session, config, frequently used)    │
└──────────────────────────────────────────────────────────┘
```

## Design Patterns Used

### 1. Service Layer Pattern

Business logic is encapsulated in services, not controllers.

### 2. Policy-Based Authorization

Model policies enforce authorization checks.

### 3. Form Request Validation

All input validation in dedicated Form Request classes.

### 4. Event-Driven Architecture

Domain events trigger notifications and side effects.

### 5. Query Optimization

- Eager loading to prevent N+1 queries
- Proper indexing on foreign keys
- Caching for frequently accessed data

## Testing Strategy

- **Unit Tests**: Services, Models, Helpers
- **Feature Tests**: HTTP endpoints, full request-response flow
- **Integration Tests**: Database operations, external services
