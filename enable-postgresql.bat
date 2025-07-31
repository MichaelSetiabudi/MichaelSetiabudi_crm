@echo off
echo 🔧 Enabling PostgreSQL Extension for PHP (XAMPP)
echo ================================================

REM Backup php.ini first
copy "D:\xampp\php\php.ini" "D:\xampp\php\php.ini.backup" >nul 2>&1
echo ✅ Backup php.ini created

REM Enable PostgreSQL extensions
echo 📝 Enabling PostgreSQL extensions in php.ini...

REM Use PowerShell to uncomment the extensions
powershell -Command "(Get-Content 'D:\xampp\php\php.ini') -replace ';extension=pdo_pgsql', 'extension=pdo_pgsql' | Set-Content 'D:\xampp\php\php.ini'"
powershell -Command "(Get-Content 'D:\xampp\php\php.ini') -replace ';extension=pgsql', 'extension=pgsql' | Set-Content 'D:\xampp\php\php.ini'"

echo ✅ PostgreSQL extensions enabled in php.ini

echo 🔄 Please restart Apache/XAMPP for changes to take effect
echo 📋 After restart, run: php artisan db:setup

pause
