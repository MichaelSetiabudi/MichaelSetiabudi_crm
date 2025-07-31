#!/bin/bash

# PT Smart CRM - Automatic Setup Script
# This script will help you setup PostgreSQL database automatically

echo "🚀 PT Smart CRM - Automatic Database Setup"
echo "=========================================="
echo ""

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Check if we're on Windows (Git Bash/WSL) or Linux/Mac
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "win32" ]]; then
    echo -e "${BLUE}Detected Windows environment${NC}"
    PSQL_CMD="psql"
else
    echo -e "${BLUE}Detected Unix-like environment${NC}"
    PSQL_CMD="psql"
fi

# Default values
DEFAULT_HOST="127.0.0.1"
DEFAULT_PORT="5432"
DEFAULT_USER="postgres"
DEFAULT_DB="smart_crm"

# Get user input with defaults
echo ""
echo "Please provide your PostgreSQL connection details:"
echo ""

read -p "PostgreSQL Host [$DEFAULT_HOST]: " DB_HOST
DB_HOST=${DB_HOST:-$DEFAULT_HOST}

read -p "PostgreSQL Port [$DEFAULT_PORT]: " DB_PORT
DB_PORT=${DB_PORT:-$DEFAULT_PORT}

read -p "PostgreSQL Username [$DEFAULT_USER]: " DB_USER
DB_USER=${DB_USER:-$DEFAULT_USER}

echo -n "PostgreSQL Password: "
read -s DB_PASS
echo ""

read -p "Database Name to Create [$DEFAULT_DB]: " DB_NAME
DB_NAME=${DB_NAME:-$DEFAULT_DB}

echo ""
echo -e "${YELLOW}Configuration Summary:${NC}"
echo "Host: $DB_HOST"
echo "Port: $DB_PORT"
echo "Username: $DB_USER"
echo "Database: $DB_NAME"
echo ""

read -p "Continue with setup? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo -e "${RED}Setup cancelled.${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}Step 1: Testing PostgreSQL connection...${NC}"

# Test PostgreSQL connection
export PGPASSWORD="$DB_PASS"
if $PSQL_CMD -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d postgres -c "SELECT version();" > /dev/null 2>&1; then
    echo -e "${GREEN}✅ PostgreSQL connection successful!${NC}"
else
    echo -e "${RED}❌ Cannot connect to PostgreSQL. Please check your credentials.${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}Step 2: Creating database '$DB_NAME'...${NC}"

# Check if database exists and create if not
DB_EXISTS=$($PSQL_CMD -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d postgres -tAc "SELECT 1 FROM pg_database WHERE datname='$DB_NAME';" 2>/dev/null)

if [ "$DB_EXISTS" = "1" ]; then
    echo -e "${YELLOW}⚠️  Database '$DB_NAME' already exists, skipping creation.${NC}"
else
    if $PSQL_CMD -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d postgres -c "CREATE DATABASE \"$DB_NAME\";" > /dev/null 2>&1; then
        echo -e "${GREEN}✅ Database '$DB_NAME' created successfully!${NC}"
    else
        echo -e "${RED}❌ Failed to create database '$DB_NAME'.${NC}"
        exit 1
    fi
fi

echo ""
echo -e "${BLUE}Step 3: Updating .env configuration...${NC}"

# Update .env file
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        echo -e "${GREEN}✅ Copied .env.example to .env${NC}"
    else
        echo -e "${RED}❌ No .env.example file found!${NC}"
        exit 1
    fi
fi

# Update database configuration in .env
sed -i.bak "s/^DB_CONNECTION=.*/DB_CONNECTION=pgsql/" .env
sed -i.bak "s/^DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i.bak "s/^DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i.bak "s/^DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i.bak "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i.bak "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env

echo -e "${GREEN}✅ .env file updated successfully!${NC}"

echo ""
echo -e "${BLUE}Step 4: Installing dependencies and setting up Laravel...${NC}"

# Clear config cache
php artisan config:clear > /dev/null 2>&1

# Test Laravel database connection
if php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database connection successful!';" > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Laravel database connection successful!${NC}"
else
    echo -e "${RED}❌ Laravel database connection failed!${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}Step 5: Running migrations and seeders...${NC}"

if php artisan migrate:fresh --seed; then
    echo -e "${GREEN}✅ Database migration and seeding completed!${NC}"
else
    echo -e "${RED}❌ Migration and seeding failed!${NC}"
    exit 1
fi

echo ""
echo -e "${GREEN}🎉 PT Smart CRM setup completed successfully!${NC}"
echo ""
echo -e "${YELLOW}📋 Next Steps:${NC}"
echo "1. Run: ${BLUE}php artisan serve${NC}"
echo "2. Visit: ${BLUE}http://localhost:8000${NC}"
echo ""
echo -e "${YELLOW}🔑 Default Login Credentials:${NC}"
echo "Admin: admin@ptsmart.com / password"
echo "Manager: budi.manager@ptsmart.com / password"
echo "Sales: ahmad.sales@ptsmart.com / password"
echo ""
echo -e "${GREEN}Happy coding! 🚀${NC}"

# Clean up
unset PGPASSWORD
