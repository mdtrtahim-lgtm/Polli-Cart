# Polli Cart Security Guide

## Overview

This document outlines the security measures implemented in Polli Cart.

## Authentication Security

### OTP Login

- OTP length: 6 digits
- OTP expiry: 10 minutes (configurable via .env)
- Attempt limit: 5 per OTP
- Rate limiting: 3 OTP requests per 5 minutes (configurable)
- OTP stored as hashed value (never plain text)

### Password Security

- Hashed using bcrypt (Laravel default)
- Password never logged or transmitted in URLs
- Session invalidated when password changes

### Admin 2FA

- Required for all Super Admin accounts
- OTP sent via email
- Backup codes generated
- Session expires 30 minutes after last activity

## Authorization Security

### Role-Based Access Control (RBAC)

7 Roles:
- Super Admin (full access)
- Admin (most operations)
- Order Manager (order-focused)
- Product Manager (product-focused)
- Content Manager (blog, banners, reviews)
- Support Manager (customer support)
- Customer (limited access to own data)

## Attack Prevention

- SQL Injection: Use Eloquent ORM
- XSS: Escape all output in Blade
- CSRF: CSRF tokens on all forms
- Mass Assignment: Fillable/guarded attributes
- IDOR: Policy checks on resource access
- File Upload: Validate MIME type, size, extension
- Brute Force: Rate limiting on login/OTP
- Session Fixation: Regenerate session after login
