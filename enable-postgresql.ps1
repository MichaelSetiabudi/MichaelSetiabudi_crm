# Enable PostgreSQL Extension for PHP (XAMPP)
Write-Host "🔧 Enabling PostgreSQL Extension for PHP (XAMPP)" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan

$phpIniPath = "D:\xampp\php\php.ini"

# Check if php.ini exists
if (-not (Test-Path $phpIniPath)) {
    Write-Host "❌ php.ini not found at: $phpIniPath" -ForegroundColor Red
    Write-Host "Please check your XAMPP installation path" -ForegroundColor Yellow
    pause
    exit 1
}

# Backup php.ini
$backupPath = "$phpIniPath.backup"
if (-not (Test-Path $backupPath)) {
    Copy-Item $phpIniPath $backupPath
    Write-Host "✅ Backup created: $backupPath" -ForegroundColor Green
}

Write-Host "📝 Enabling PostgreSQL extensions in php.ini..." -ForegroundColor Blue

# Read php.ini content
$content = Get-Content $phpIniPath

# Enable PostgreSQL extensions
$content = $content -replace ';extension=pdo_pgsql', 'extension=pdo_pgsql'
$content = $content -replace ';extension=pgsql', 'extension=pgsql'

# Write back to php.ini
Set-Content $phpIniPath $content

Write-Host "✅ PostgreSQL extensions enabled in php.ini" -ForegroundColor Green

Write-Host ""
Write-Host "🔄 Important: Please restart Apache/XAMPP now!" -ForegroundColor Yellow
Write-Host "📋 Steps to restart XAMPP:" -ForegroundColor Yellow
Write-Host "1. Open XAMPP Control Panel" -ForegroundColor White
Write-Host "2. Stop Apache" -ForegroundColor White  
Write-Host "3. Start Apache" -ForegroundColor White
Write-Host "4. Run: php artisan db:setup" -ForegroundColor White

Write-Host ""
Write-Host "Press any key to continue..." -ForegroundColor Gray
Read-Host
