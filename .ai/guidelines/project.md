# Project Guidelines

- Use Laravel best practices for controllers, models, requests, and service providers.
- The `AppServiceProvider` contains custom settings like DateImmutable etc.
- For Filament resources, follow Filament conventions.
- Prefer dependency injection and type-hinting in PHP code.
- Use PSR-2 coding style.
- Avoid legacy Laravel syntax and features deprecated in Laravel 11+.
- Use PHP 8.2+ features where appropriate.

## Additional Project Guidelines

- Use strict types (`declare(strict_types=1);`) at the top of PHP files.
- Write PHPDoc blocks for classes, methods, and properties.
- Use Eloquent relationships and query scopes where possible.
- For Filament forms and tables, use custom components if needed.
- Prefer using Laravel’s built-in validation and authorization features.
- Organize tests in the `tests` folder, using Pest.
- Use environment variables for configuration, not hardcoded values.
- Follow SOLID principles and keep code modular.
- When creating migrations, use Laravel’s schema builder.
