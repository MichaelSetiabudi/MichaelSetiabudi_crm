-- Script untuk mengecek database CRM di pgAdmin
-- Copy dan paste ke pgAdmin Query Tool

-- 1. Cek database yang ada
\l

-- 2. Connect ke database smart_crm dan cek semua tabel
\c smart_crm
\dt

-- 3. Cek jumlah data di setiap tabel
SELECT 'users' as table_name, COUNT(*) as total FROM users
UNION ALL
SELECT 'leads' as table_name, COUNT(*) as total FROM leads
UNION ALL
SELECT 'products' as table_name, COUNT(*) as total FROM products
UNION ALL
SELECT 'projects' as table_name, COUNT(*) as total FROM projects
UNION ALL
SELECT 'customers' as table_name, COUNT(*) as total FROM customers
UNION ALL
SELECT 'customer_products' as table_name, COUNT(*) as total FROM customer_products
ORDER BY table_name;

-- 4. Cek data users dengan roles
SELECT id, name, email, role, created_at 
FROM users 
ORDER BY role, name;

-- 5. Cek data products
SELECT id, name, type, price, description 
FROM products 
ORDER BY type, price;

-- 6. Cek data leads terbaru
SELECT id, name, email, phone, status, priority, created_at 
FROM leads 
ORDER BY created_at DESC 
LIMIT 10;

-- 7. Cek data projects dengan approval
SELECT p.id, p.project_code, p.status, p.project_value, p.installation_date,
       u.name as sales_person, l.name as customer_name
FROM projects p
JOIN users u ON p.sales_id = u.id
JOIN leads l ON p.lead_id = l.id
ORDER BY p.created_at DESC;
