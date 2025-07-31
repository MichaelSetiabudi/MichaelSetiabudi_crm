# Enable PostgreSQL Extension for PHP (XAMPP) - Simple Version
Write-Host "Enabling PostgreSQL Extension for PHP (XAMPP)" -ForegroundColor Cyan

$phpIniPath = "D:\xampp\php\php.ini"

if (-not (Test-Path $phpIniPath)) {
    Write-Host "php.ini not found at: $phpIniPath" -ForegroundColor Red
    Write-Host "Please check your XAMPP installation path" -ForegroundColor Yellow
    exit 1
}

# Backup php.ini
$backupPath = "$phpIniPath.backup"
if (-not (Test-Path $backupPath)) {
    Copy-Item $phpIniPath $backupPath
    Write-Host "Backup created: $backupPath" -ForegroundColor Green
}

Write-Host "Enabling PostgreSQL extensions in php.ini..." -ForegroundColor Blue

# Read and modify php.ini
$content = Get-Content $phpIniPath
$content = $content -replace ';extension=pdo_pgsql', 'extension=pdo_pgsql'
$content = $content -replace ';extension=pgsql', 'extension=pgsql'
Set-Content $phpIniPath $content

Write-Host "PostgreSQL extensions enabled successfully!" -ForegroundColor Green
Write-Host ""
Write-Host "IMPORTANT: Please restart Apache/XAMPP now!" -ForegroundColor Yellow
Write-Host "Then run: php artisan db:setup" -ForegroundColor White
