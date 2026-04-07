<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Fleetbase\Models\Company;
use Fleetbase\FleetOps\Models\OrderConfig;
use Fleetbase\FleetOps\Models\Entity;

class MaritimeWorkflowSeeder extends Seeder
{
    public function run(): void
    {
        $companyUuid = Company::query()->value('uuid');

        if (!$companyUuid) {
            throw new \RuntimeException('No company found. Cannot seed maritime workflow without a company_uuid.');
        }

        $orderConfig = OrderConfig::firstOrCreate(
            [
                'company_uuid' => $companyUuid,
                'namespace'    => 'maritime-export',
            ],
            [
                'name'        => 'Sea Freight Export',
                'description' => 'B2B maritime export workflow for containerized sea freight operations.',
                'key'         => 'sea-freight-export',
                'status'      => 'active',
                'version'     => '1.0.0',
                'flow'        => [
                    ['status' => 'Draft', 'color' => '#6B7280'],
                    ['status' => 'Container Stuffed', 'color' => '#3B82F6'],
                    ['status' => 'Gated In (Port)', 'color' => '#8B5CF6'],
                    ['status' => 'Loaded on Vessel', 'color' => '#10B981'],
                    ['status' => 'In Transit', 'color' => '#2563EB'],
                    ['status' => 'Arrived at POD', 'color' => '#F59E0B'],
                    ['status' => 'Released', 'color' => '#059669'],
                ],
                'entities'    => [
                    [
                        'name' => 'Shipping Container',
                        'type' => 'container',
                    ],
                ],
                'meta'        => [
                    'mode' => 'maritime',
                    'custom_fields' => [
                        ['label' => 'Vessel Name', 'type' => 'text', 'required' => true],
                        ['label' => 'IMO Number', 'type' => 'text', 'required' => false],
                        ['label' => 'Voyage Number', 'type' => 'text', 'required' => false],
                        ['label' => 'Bill of Lading', 'type' => 'text', 'required' => false],
                        ['label' => 'Port of Loading', 'type' => 'place', 'required' => false],
                        ['label' => 'Port of Discharge', 'type' => 'place', 'required' => false],
                    ],
                ],
            ]
        );

        Entity::firstOrCreate(
            [
                'company_uuid' => $companyUuid,
                'name'         => 'Shipping Container',
                'type'         => 'container',
            ],
            [
                'uuid'            => (string) Str::uuid(),
                'description'     => 'Standard maritime shipping container entity.',
                'length'          => '12.19',
                'width'           => '2.44',
                'height'          => '2.59',
                'dimensions_unit' => 'm',
                'meta'            => [
                    'container_type' => '40FT_STANDARD',
                    'supported_sizes' => ['20GP', '40GP', '40HC'],
                ],
            ]
        );

        $this->command?->info('Maritime workflow seeded successfully.');
        $this->command?->info('Order Config: ' . $orderConfig->name);
    }
}