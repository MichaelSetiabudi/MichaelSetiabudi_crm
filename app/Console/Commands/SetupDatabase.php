<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use Exception;

class SetupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setup 
                            {--host=127.0.0.1 : Database host}
                            {--port=5432 : Database port}  
                            {--username=postgres : Database username}
                            {--password= : Database password}
                            {--database=smart_crm : Database name to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create PostgreSQL database and setup initial configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 PT Smart CRM Database Setup');
        $this->line('================================');
        
        // Check PostgreSQL driver first
        if (!$this->checkPostgreSQLDriver()) {
            return 1;
        }
        
        // Get database credentials
        $host = $this->option('host');
        $port = $this->option('port');
        $username = $this->option('username');
        $password = $this->option('password') ?: $this->secret('Enter PostgreSQL password');
        $database = $this->option('database');
        
        // Show configuration
        $this->table(['Setting', 'Value'], [
            ['Host', $host],
            ['Port', $port],
            ['Username', $username],
            ['Database to create', $database],
        ]);
        
        if (!$this->confirm('Continue with database setup?')) {
            $this->error('Setup cancelled.');
            return 1;
        }
        
        try {
            // Step 1: Test connection to PostgreSQL (without specific database)
            $this->info('📡 Testing PostgreSQL connection...');
            $this->testConnection($host, $port, $username, $password);
            $this->info('✅ PostgreSQL connection successful!');
            
            // Step 2: Create database if not exists
            $this->info("📦 Creating database '{$database}'...");
            $this->createDatabase($host, $port, $username, $password, $database);
            $this->info("✅ Database '{$database}' created successfully!");
            
            // Step 3: Update .env file
            $this->info('⚙️  Updating .env configuration...');
            $this->updateEnvFile($host, $port, $username, $password, $database);
            $this->info('✅ .env file updated successfully!');
            
            // Step 4: Test Laravel database connection
            $this->info('🔗 Testing Laravel database connection...');
            $this->testLaravelConnection();
            $this->info('✅ Laravel database connection successful!');
            
            $this->line('');
            $this->info('🎉 Database setup completed successfully!');
            $this->line('');
            $this->comment('Next steps:');
            $this->line('1. Run: php artisan migrate:fresh --seed');
            $this->line('2. Run: php artisan serve');
            $this->line('3. Visit: http://localhost:8000');
            
            return 0;
            
        } catch (Exception $e) {
            $this->error('❌ Setup failed: ' . $e->getMessage());
            return 1;
        }
    }
    
    private function testConnection($host, $port, $username, $password)
    {
        $dsn = "pgsql:host={$host};port={$port}";
        
        try {
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $pdo = null; // Close connection
        } catch (PDOException $e) {
            throw new Exception("Cannot connect to PostgreSQL: " . $e->getMessage());
        }
    }
    
    private function createDatabase($host, $port, $username, $password, $database)
    {
        $dsn = "pgsql:host={$host};port={$port}";
        
        try {
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            
            // Check if database exists
            $stmt = $pdo->prepare("SELECT 1 FROM pg_database WHERE datname = ?");
            $stmt->execute([$database]);
            
            if ($stmt->fetchColumn()) {
                $this->warn("Database '{$database}' already exists, skipping creation.");
                return;
            }
            
            // Create database
            $pdo->exec("CREATE DATABASE \"{$database}\"");
            $pdo = null; // Close connection
            
        } catch (PDOException $e) {
            throw new Exception("Cannot create database: " . $e->getMessage());
        }
    }
    
    private function updateEnvFile($host, $port, $username, $password, $database)
    {
        $envPath = base_path('.env');
        
        if (!file_exists($envPath)) {
            throw new Exception('.env file not found. Please copy .env.example to .env first.');
        }
        
        $envContent = file_get_contents($envPath);
        
        // Update database configuration
        $replacements = [
            '/^DB_CONNECTION=.*/m' => 'DB_CONNECTION=pgsql',
            '/^DB_HOST=.*/m' => "DB_HOST={$host}",
            '/^DB_PORT=.*/m' => "DB_PORT={$port}",
            '/^DB_DATABASE=.*/m' => "DB_DATABASE={$database}",
            '/^DB_USERNAME=.*/m' => "DB_USERNAME={$username}",
            '/^DB_PASSWORD=.*/m' => "DB_PASSWORD={$password}",
        ];
        
        foreach ($replacements as $pattern => $replacement) {
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                // Add if not exists
                $envContent .= "\n{$replacement}";
            }
        }
        
        file_put_contents($envPath, $envContent);
        
        // Clear config cache to reload new values
        $this->call('config:clear');
    }
    
    private function testLaravelConnection()
    {
        try {
            DB::connection()->getPdo();
            DB::connection()->getDatabaseName();
        } catch (Exception $e) {
            throw new Exception("Laravel database connection failed: " . $e->getMessage());
        }
    }
    
    private function checkPostgreSQLDriver()
    {
        $this->info('🔍 Checking PostgreSQL driver...');
        
        if (!in_array('pgsql', PDO::getAvailableDrivers())) {
            $this->error('❌ PostgreSQL PDO driver (pdo_pgsql) is not installed!');
            $this->line('');
            $this->comment('To fix this issue:');
            
            if (PHP_OS_FAMILY === 'Windows') {
                $this->line('1. Run: .\\enable-postgresql.ps1 (PowerShell)');
                $this->line('2. Or run: enable-postgresql.bat (Command Prompt)');
                $this->line('3. Restart Apache/XAMPP');
                $this->line('4. Run this command again');
            } else {
                $this->line('1. Install: sudo apt-get install php-pgsql (Ubuntu/Debian)');
                $this->line('2. Or install: sudo yum install php-pgsql (CentOS/RHEL)');
                $this->line('3. Or install: brew install php (macOS with Homebrew)');
                $this->line('4. Restart web server');
                $this->line('5. Run this command again');
            }
            
            return false;
        }
        
        $this->info('✅ PostgreSQL driver is available!');
        return true;
    }
}
