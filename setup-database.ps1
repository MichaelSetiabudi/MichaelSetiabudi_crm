# PT Smart CRM - PowerShell Setup Script for Windows
# This script will help you setup PostgreSQL database automatically on Windows

Write-Host "🚀 PT Smart CRM - Automatic Database Setup (Windows)" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Default values
$DEFAULT_HOST = "127.0.0.1"
$DEFAULT_PORT = "5432"
$DEFAULT_USER = "postgres"
$DEFAULT_DB = "smart_crm"

# Function to prompt with default value
function Read-HostWithDefault {
    param([string]$Prompt, [string]$Default)
    $value = Read-Host "$Prompt [$Default]"
    if ([string]::IsNullOrWhiteSpace($value)) { $Default } else { $value }
}

# Get user input
Write-Host "Please provide your PostgreSQL connection details:" -ForegroundColor Yellow
Write-Host ""

$DB_HOST = Read-HostWithDefault "PostgreSQL Host" $DEFAULT_HOST
$DB_PORT = Read-HostWithDefault "PostgreSQL Port" $DEFAULT_PORT
$DB_USER = Read-HostWithDefault "PostgreSQL Username" $DEFAULT_USER
$DB_PASS = Read-Host "PostgreSQL Password" -AsSecureString
$DB_PASS_PLAIN = [Runtime.InteropServices.Marshal]::PtrToStringAuto([Runtime.InteropServices.Marshal]::SecureStringToBSTR($DB_PASS))
$DB_NAME = Read-HostWithDefault "Database Name to Create" $DEFAULT_DB

Write-Host ""
Write-Host "Configuration Summary:" -ForegroundColor Yellow
Write-Host "Host: $DB_HOST"
Write-Host "Port: $DB_PORT"
Write-Host "Username: $DB_USER"
Write-Host "Database: $DB_NAME"
Write-Host ""

$confirmation = Read-Host "Continue with setup? (y/N)"
if ($confirmation -ne 'y' -and $confirmation -ne 'Y') {
    Write-Host "❌ Setup cancelled." -ForegroundColor Red
    exit 1
}

try {
    Write-Host ""
    Write-Host "Step 1: Testing PostgreSQL connection..." -ForegroundColor Blue
    
    # Set environment variable for password
    $env:PGPASSWORD = $DB_PASS_PLAIN
    
    # Test PostgreSQL connection
    $testResult = & psql -h $DB_HOST -p $DB_PORT -U $DB_USER -d postgres -c "SELECT version();" 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ PostgreSQL connection successful!" -ForegroundColor Green
    } else {
        Write-Host "❌ Cannot connect to PostgreSQL. Please check your credentials." -ForegroundColor Red
        Write-Host "Error: $testResult" -ForegroundColor Red
        exit 1
    }
    
    Write-Host ""
    Write-Host "Step 2: Creating database '$DB_NAME'..." -ForegroundColor Blue
    
    # Check if database exists
    $dbExists = & psql -h $DB_HOST -p $DB_PORT -U $DB_USER -d postgres -tAc "SELECT 1 FROM pg_database WHERE datname='$DB_NAME';" 2>&1
    
    if ($dbExists -eq "1") {
        Write-Host "⚠️  Database '$DB_NAME' already exists, skipping creation." -ForegroundColor Yellow
    } else {
        $createResult = & psql -h $DB_HOST -p $DB_PORT -U $DB_USER -d postgres -c "CREATE DATABASE `"$DB_NAME`";" 2>&1
        if ($LASTEXITCODE -eq 0) {
            Write-Host "✅ Database '$DB_NAME' created successfully!" -ForegroundColor Green
        } else {
            Write-Host "❌ Failed to create database '$DB_NAME'." -ForegroundColor Red
            Write-Host "Error: $createResult" -ForegroundColor Red
            exit 1
        }
    }
    
    Write-Host ""
    Write-Host "Step 3: Updating .env configuration..." -ForegroundColor Blue
    
    # Check and copy .env file if needed
    if (-not (Test-Path ".env")) {
        if (Test-Path ".env.example") {
            Copy-Item ".env.example" ".env"
            Write-Host "✅ Copied .env.example to .env" -ForegroundColor Green
        } else {
            Write-Host "❌ No .env.example file found!" -ForegroundColor Red
            exit 1
        }
    }
    
    # Update .env file
    $envContent = Get-Content ".env" -Raw
    
    $replacements = @{
        'DB_CONNECTION=.*' = "DB_CONNECTION=pgsql"
        'DB_HOST=.*' = "DB_HOST=$DB_HOST"
        'DB_PORT=.*' = "DB_PORT=$DB_PORT"
        'DB_DATABASE=.*' = "DB_DATABASE=$DB_NAME"
        'DB_USERNAME=.*' = "DB_USERNAME=$DB_USER"
        'DB_PASSWORD=.*' = "DB_PASSWORD=$DB_PASS_PLAIN"
    }
    
    foreach ($pattern in $replacements.Keys) {
        $replacement = $replacements[$pattern]
        if ($envContent -match "(?m)^$pattern") {
            $envContent = $envContent -replace "(?m)^$pattern", $replacement
        } else {
            $envContent += "`n$replacement"
        }
    }
    
    Set-Content ".env" $envContent
    Write-Host "✅ .env file updated successfully!" -ForegroundColor Green
    
    Write-Host ""
    Write-Host "Step 4: Testing Laravel database connection..." -ForegroundColor Blue
    
    # Clear config cache
    & php artisan config:clear | Out-Null
    
    # Test Laravel connection
    $testLaravel = & php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database connection successful!';" 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Laravel database connection successful!" -ForegroundColor Green
    } else {
        Write-Host "❌ Laravel database connection failed!" -ForegroundColor Red
        Write-Host "Error: $testLaravel" -ForegroundColor Red
        exit 1
    }
    
    Write-Host ""
    Write-Host "Step 5: Running migrations and seeders..." -ForegroundColor Blue
    
    $migrateResult = & php artisan migrate:fresh --seed 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ Database migration and seeding completed!" -ForegroundColor Green
    } else {
        Write-Host "❌ Migration and seeding failed!" -ForegroundColor Red
        Write-Host "Error: $migrateResult" -ForegroundColor Red
        exit 1
    }
    
    Write-Host ""
    Write-Host "🎉 PT Smart CRM setup completed successfully!" -ForegroundColor Green
    Write-Host ""
    Write-Host "📋 Next Steps:" -ForegroundColor Yellow
    Write-Host "1. Run: " -NoNewline; Write-Host "php artisan serve" -ForegroundColor Blue
    Write-Host "2. Visit: " -NoNewline; Write-Host "http://localhost:8000" -ForegroundColor Blue
    Write-Host ""
    Write-Host "🔑 Default Login Credentials:" -ForegroundColor Yellow
    Write-Host "Admin: admin@ptsmart.com / password"
    Write-Host "Manager: budi.manager@ptsmart.com / password"
    Write-Host "Sales: ahmad.sales@ptsmart.com / password"
    Write-Host ""
    Write-Host "Happy coding! 🚀" -ForegroundColor Green
    
} catch {
    Write-Host "❌ An error occurred: $($_.Exception.Message)" -ForegroundColor Red
    exit 1
} finally {
    # Clean up environment variable
    Remove-Item env:PGPASSWORD -ErrorAction SilentlyContinue
}
