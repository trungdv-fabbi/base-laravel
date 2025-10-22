# Base Laravel Package

A comprehensive Laravel package for quickly initializing a base Laravel development environment with Docker setup, providing utilities for file management, template generation, and consistent API responses.

## Features

- 🐳 **Docker Environment**: Complete Docker setup with Nginx, MySQL, and Laravel
- ⚡ **Quick Setup**: One command to initialize your development environment
- 🔧 **Configurable**: Customizable PHP and MySQL versions
- 📁 **Auto-generated**: Automatically creates necessary Docker files and configurations
- 🚀 **Laravel Ready**: Pre-configured for Laravel development
- 🛠️ **Helper Utilities**: File and directory management tools
- 📝 **Template System**: Stub-based file generation
- 🎯 **Response Resource**: Consistent API response formatting
- 🔗 **Facade Support**: Easy-to-use facade interface
- 📊 **Service Container**: Full Laravel integration

## Requirements

- PHP >= 8.1
- Laravel >= 9.0
- Docker & Docker Compose
- Composer

## Installation

### 1. Install via Composer

```bash
composer require trungdv/base-laravel
```

### 2. Publish Configuration

```bash
php artisan vendor:publish --provider="TrungDV\BaseLaravel\Providers\InitBaseProvider" --tag="config"
```

### 3. Configure Environment

Update your `.env` file with database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password
DB_TIME_ZONE=UTC
```

## Usage

### Initialize Base Environment

Run the following command to create your Docker environment:

```bash
php artisan make:base
```

This command will create:

- `docker-compose.yml` - Docker Compose configuration
- `docker/` directory with:
  - `Dockerfile` - PHP-FPM container configuration
  - `http-nginx.conf` - Nginx configuration
  - `php.ini` - PHP configuration
  - `initdb/` - Database initialization scripts
  - `mysql/` - MySQL logs directory

### Start Development Environment

After running `make:base`, build and run your Docker environment:

```bash
docker-compose up -d --build
```

Your Laravel application will be available at:
- **HTTP**: http://localhost:9005
- **HTTPS**: https://localhost:443

### Stop Development Environment

```bash
docker-compose down
```

## Configuration

The package configuration is located in `config/base.php`:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Default init base directory
    |
    */
    'project_name' => 'base_laravel',
    'php_version' => '8.3',
    'mysql_version' => '8.0',

    'path' => 'app/Repositories',
    'service_path' => 'app/Services',

    /*
     * Default repository namespace
     */
    'namespace' => 'App\Repositories',
    'service_namespace' => 'App\Services',
    'naming' => 'singular', // plural | singular

    'response' => [
        'headers' => [
            'Content-Type' => 'application/json,charset=UTF-8',
            'Access-Control-Allow-Credentials' => 'TRUE',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, DELETE, PUT, PATCH',
            'Access-Control-Allow-Headers' => 'x-requested-with',
            'Access-Control-Max-Age' => '864,000',
        ],
    ],
];
```

### Customizing Versions

You can customize PHP and MySQL versions by updating the config:

```php
// config/base.php
'php_version' => '8.2',    // Change PHP version
'mysql_version' => '8.0',  // Change MySQL version
'project_name' => 'my_project', // Change project name
```

## Docker Services

### Laravel Application
- **Container**: `{project_name}_laravel`
- **Image**: Custom PHP-FPM image (`trungdvfabbi/php-pecl:php{PHP_VERSION}`)
- **Port**: 9000 (internal)
- **Volumes**: Project files, PHP configuration

### Nginx Web Server
- **Container**: `http-nginx`
- **Image**: nginx:1.23-alpine
- **Ports**: 9005 (HTTP), 443 (HTTPS)
- **Configuration**: Custom nginx config for Laravel

### MySQL Database
- **Container**: `{project_name}_db`
- **Image**: mysql:8.0
- **Port**: 33061 (external)
- **Volumes**: Database data, logs, initialization scripts

## Template System

The package uses a stub-based template system for generating files:

### Available Templates

- `docker-compose.stub` - Docker Compose configuration
- `Dockerfile.stub` - PHP-FPM Dockerfile
- `http-nginx.conf.stub` - Nginx configuration
- `php.ini.stub` - PHP configuration

## Troubleshooting

### Common Issues

1. **Port Already in Use**
   - Change ports in `docker-compose.yml` if 9005 or 33061 are already in use

2. **Permission Issues**
   - Ensure Docker has proper permissions to access your project directory
   - Check file ownership: `ls -la`

3. **Database Connection Issues**
   - Verify your `.env` database configuration matches the Docker setup
   - Check if MySQL container is running: `docker-compose ps`

4. **Container Won't Start**
   - Check Docker logs: `docker-compose logs [service_name]`
   - Verify Docker is running: `docker --version`

5. **Template Not Found**
   - Ensure template files exist in `src/Stubs/` directory
   - Check file permissions and naming convention

### Debugging

```bash
# View all container logs
docker-compose logs

# View specific service logs
docker-compose logs laravel
docker-compose logs mysql
docker-compose logs http-nginx

# Access container shell
docker-compose exec laravel bash
docker-compose exec mysql bash

# Check container status
docker-compose ps

# Restart specific service
docker-compose restart laravel
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Support

If you encounter any issues or have questions:

- 📧 Email: trungdv@fabbi.io
- 🐛 Issues: [GitHub Issues](https://github.com/trungdv-fabbi/base-laravel/issues)
- 📖 Documentation: [Package Documentation](https://github.com/trungdv-fabbi/base-laravel)

## Changelog

### v1.0.0 - 2024-01-15
- ✅ Initial release
- ✅ Docker environment setup with Nginx, MySQL, and Laravel
- ✅ Configuration management system
- ✅ Response resource for consistent API responses
- ✅ Helper utilities for file and directory management
- ✅ Template system for file generation
- ✅ Facade support for easy usage
- ✅ Service Container integration
- ✅ Artisan command for environment initialization
- ✅ Comprehensive testing setup
- ✅ Complete documentation and examples
