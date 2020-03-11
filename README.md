# myServers

A demo crud project with export data funtionality build on Symfony 4

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- Install latest version Xampp/LAMP stack
- Install composer

### Quick Start

```
# Clone the repository in local machine
git clone https://github.com/basudebmondal/myServers.git

# Install dependencies
composer install

# Edit the env file and add DB params
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

# Create DB
php bin/console doctrine:database:create

# Create Application schema
php bin/console doctrine:schema:create

# Run migrations
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## Versioning

1.0.0

## Authors

* **Basudeb Mondal** - *Initial work*

## Acknowledgments

* Symfony 4 Documentation

