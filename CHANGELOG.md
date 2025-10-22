# Changelog

All notable changes to this package will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this package adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Support for Laravel 12.x
- Additional database support (PostgreSQL, Redis)
- SSL/TLS configuration options
- Development tools integration
- Testing environment setup
- Production deployment configurations

### Changed
- Improved Docker configuration templates
- Enhanced error handling in Helper class
- Optimized response resource formatting

### Fixed
- Fixed Docker container naming conflicts
- Fixed file permission issues on Windows
- Fixed nginx configuration for large file uploads

## [1.0.0] - 2024-01-15

### Added
- Initial release
- Docker environment setup with Nginx, MySQL, and Laravel
- `make:base` Artisan command for environment initialization
- Configuration management system
- Response resource for consistent API responses
- Helper class with utility methods
- Docker Compose configuration with customizable project name
- Nginx configuration optimized for Laravel
- PHP configuration with development settings
- MySQL database setup with proper volumes
- File and directory management utilities
- Template system for generating Docker files
- Service provider for Laravel integration
- Comprehensive documentation

### Features
- **Docker Environment**: Complete development environment with Nginx, MySQL, and Laravel
- **Quick Setup**: One command initialization with `php artisan make:base`
- **Configurable**: Customizable PHP and MySQL versions
- **Response Resource**: Standardized API response format
- **Helper Utilities**: File, directory, and template management
- **Template System**: Stub-based file generation
- **Service Provider**: Seamless Laravel integration

### Requirements
- PHP >= 8.1
- Laravel >= 9.0
- Docker & Docker Compose
- Composer

### Installation
```bash
composer require trungdv-fabbi/base-laravel
php artisan vendor:publish --provider="TrungDV\BaseLaravel\Providers\InitBaseProvider" --tag="config"
```

### Usage
```bash
# Initialize Docker environment
php artisan make:base

# Start development environment
docker-compose up -d

# Stop development environment
docker-compose down
```

### Docker Services
- **Laravel Application**: Custom PHP-FPM container
- **Nginx Web Server**: Port 9005 (HTTP), 443 (HTTPS)
- **MySQL Database**: Port 33061 (external)

### Configuration
- Project name customization
- PHP version selection (8.1, 8.2, 8.3)
- MySQL version selection (8.0, 8.1)
- Response headers configuration
- Namespace and path customization
