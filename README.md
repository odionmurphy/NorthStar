# Northstar Digital Market

A complete, dependency-light B2B digital product storefront written in original PHP, HTML, CSS, and JavaScript.

## Product strategy

The launch catalog focuses on three product models with strong current demand and durable future demand:

1. **Autoflow OS v2.4**: AI workflow automation for operations teams. Companies continue to invest in reducing repetitive work and improving team capacity.
2. **Fortify Kit v1.8**: security and compliance readiness for growing businesses. Trust, vendor reviews, and regulation make this a resilient B2B need.
3. **Signal Board v3.1**: decision intelligence and analytics dashboards. Teams need a shared view of performance as data volume and distributed work grow.

The versions are product-model versions shown in the catalog, not third-party AI model claims. Product data lives in `data/products.php`, so names, pricing, categories, and future offerings are easy to update.

## Run locally

Requirements: PHP 8.1+.

```bash
php -S localhost:8000
```

Open <http://localhost:8000>.

## Test

The project uses a zero-dependency native PHP feature test suite:

```bash
php tests/FeatureTest.php
```

It covers the catalog count, HTML escaping, product-art rendering, valid inquiry handling, invalid form input, and unknown product rejection.

## Structure

- `index.php`: focused homepage introduction.
- `catalog.php`: catalog page with search and category filters.
- `northstar.php`: Northstar standards and product philosophy page.
- `sales.php`: B2B sales inquiry page and validation flow.
- `data/products.php`: editable product catalog and model versions.
- `includes/functions.php`: escaped output, product art, and form validation.
- `assets/style.css`: responsive visual system and layout.
- `assets/app.js`: lightweight reveal motion and form notice dismissal.
- `tests/FeatureTest.php`: executable smoke tests.

## Production next steps

Connect `submit_inquiry()` to a mail provider or CRM, add CSRF protection and rate limiting, replace the `.test` contact address, and add a persistent database when the catalog needs an admin workflow.
# NorthStar
