<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Residential Products
            [
                'name' => 'SmartHome Basic',
                'description' => 'Paket internet rumah basic dengan kecepatan 20 Mbps, cocok untuk kebutuhan browsing dan streaming ringan.',
                'price' => 250000,
                'bandwidth' => '20 Mbps',
                'speed_mbps' => 20,
                'type' => 'residential',
                'is_active' => true,
                'features' => [
                    'Download Speed: 20 Mbps',
                    'Upload Speed: 5 Mbps',
                    'Unlimited Quota',
                    'WiFi Router Included',
                    '24/7 Technical Support'
                ]
            ],
            [
                'name' => 'SmartHome Standard',
                'description' => 'Paket internet rumah standar dengan kecepatan 50 Mbps, ideal untuk keluarga dengan multiple devices.',
                'price' => 400000,
                'bandwidth' => '50 Mbps',
                'speed_mbps' => 50,
                'type' => 'residential',
                'is_active' => true,
                'features' => [
                    'Download Speed: 50 Mbps',
                    'Upload Speed: 15 Mbps',
                    'Unlimited Quota',
                    'WiFi Router Included',
                    'Smart TV Box',
                    '24/7 Technical Support'
                ]
            ],
            [
                'name' => 'SmartHome Premium',
                'description' => 'Paket internet rumah premium dengan kecepatan 100 Mbps, untuk gaming dan streaming 4K.',
                'price' => 650000,
                'bandwidth' => '100 Mbps',
                'speed_mbps' => 100,
                'type' => 'residential',
                'is_active' => true,
                'features' => [
                    'Download Speed: 100 Mbps',
                    'Upload Speed: 25 Mbps',
                    'Unlimited Quota',
                    'WiFi 6 Router Included',
                    'Smart TV Box Premium',
                    'Gaming Optimization',
                    '24/7 Technical Support'
                ]
            ],
            [
                'name' => 'SmartHome Ultra',
                'description' => 'Paket internet rumah ultra dengan kecepatan 200 Mbps, untuk power user dan content creator.',
                'price' => 1000000,
                'bandwidth' => '200 Mbps',
                'speed_mbps' => 200,
                'type' => 'residential',
                'is_active' => true,
                'features' => [
                    'Download Speed: 200 Mbps',
                    'Upload Speed: 50 Mbps',
                    'Unlimited Quota',
                    'WiFi 6 Router Premium',
                    'Smart TV Box Ultra',
                    'Gaming & Streaming Optimization',
                    'Priority Customer Support',
                    '24/7 Technical Support'
                ]
            ],

            // Business Products
            [
                'name' => 'SmartBiz Starter',
                'description' => 'Paket internet bisnis untuk usaha kecil dengan kecepatan 50 Mbps dan static IP.',
                'price' => 800000,
                'bandwidth' => '50 Mbps',
                'speed_mbps' => 50,
                'type' => 'business',
                'is_active' => true,
                'features' => [
                    'Download Speed: 50 Mbps',
                    'Upload Speed: 25 Mbps',
                    'Unlimited Quota',
                    'Static IP Address',
                    'Business Router',
                    'Email Support',
                    'SLA 99.5%',
                    '24/7 Technical Support'
                ]
            ],
            [
                'name' => 'SmartBiz Professional',
                'description' => 'Paket internet bisnis profesional dengan kecepatan 100 Mbps dan fitur keamanan enhanced.',
                'price' => 1200000,
                'bandwidth' => '100 Mbps',
                'speed_mbps' => 100,
                'type' => 'business',
                'is_active' => true,
                'features' => [
                    'Download Speed: 100 Mbps',
                    'Upload Speed: 50 Mbps',
                    'Unlimited Quota',
                    'Static IP Address',
                    'Business Router with Security',
                    'Firewall Protection',
                    'VPN Support',
                    'Priority Support',
                    'SLA 99.7%',
                    '24/7 Technical Support'
                ]
            ],
            [
                'name' => 'SmartBiz Enterprise',
                'description' => 'Paket internet bisnis enterprise dengan kecepatan 200 Mbps dan fitur enterprise-grade.',
                'price' => 2000000,
                'bandwidth' => '200 Mbps',
                'speed_mbps' => 200,
                'type' => 'business',
                'is_active' => true,
                'features' => [
                    'Download Speed: 200 Mbps',
                    'Upload Speed: 100 Mbps',
                    'Unlimited Quota',
                    'Multiple Static IP',
                    'Enterprise Router',
                    'Advanced Firewall',
                    'VPN & MPLS Support',
                    'Load Balancing',
                    'Dedicated Account Manager',
                    'SLA 99.9%',
                    '24/7 Technical Support'
                ]
            ],

            // Enterprise Products
            [
                'name' => 'SmartCorp Dedicated 500',
                'description' => 'Dedicated internet untuk korporasi dengan kecepatan 500 Mbps dan redundansi.',
                'price' => 5000000,
                'bandwidth' => '500 Mbps',
                'speed_mbps' => 500,
                'type' => 'enterprise',
                'is_active' => true,
                'features' => [
                    'Dedicated 500 Mbps',
                    'Symmetrical Speed',
                    'Unlimited Bandwidth',
                    'Multiple Static IP Block',
                    'Redundant Connection',
                    'Advanced Security Suite',
                    'MPLS & VPN Ready',
                    'Network Monitoring',
                    'Dedicated Support Team',
                    'SLA 99.95%',
                    'On-site Technical Support'
                ]
            ],
            [
                'name' => 'SmartCorp Dedicated 1G',
                'description' => 'Dedicated internet enterprise dengan kecepatan 1 Gbps untuk kebutuhan data center.',
                'price' => 8000000,
                'bandwidth' => '1 Gbps',
                'speed_mbps' => 1000,
                'type' => 'enterprise',
                'is_active' => true,
                'features' => [
                    'Dedicated 1 Gbps',
                    'Symmetrical Speed',
                    'Unlimited Bandwidth',
                    'Full IP Block (/28)',
                    'Dual Redundant Connection',
                    'Enterprise Security Suite',
                    'MPLS, VPN & BGP',
                    'Real-time Monitoring',
                    'NOC Support 24/7',
                    'SLA 99.99%',
                    'On-site Technical Support',
                    'Disaster Recovery Support'
                ]
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
