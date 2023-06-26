<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(["name" => "Index-Roles", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Role", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Role", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Role", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Role", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Role", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Permissions", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Permission", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Permission", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Permission", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Permission", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Permission", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Admins", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Admin", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Admin", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Admin", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Admin", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Admin", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Beneficiaries", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Beneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Beneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Beneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Beneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Beneficiary", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Donors", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Donor", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Donor", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Donor", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Donor", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Donor", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Faqs", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Faq", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Faq", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Faq", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Faq", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Faq", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Bills", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Bill", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Bill", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Bill", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Bill", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Bill", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Suppliers", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Supplier", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Supplier", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Supplier", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Supplier", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Supplier", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Currencies", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Currency", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Currency", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Currency", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Currency", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Currency", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Services", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Service", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Service", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Service", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Service", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Service", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Categories", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Category", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Category", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Category", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Category", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Category", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-SubCategories", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-SubCategory", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-SubCategory", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-SubCategory", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-SubCategory", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-SubCategory", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Countries", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Country", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Country", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Country", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Country", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Country", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Cities", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-City", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-City", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-City", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-City", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-City", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Areas", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Area", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Area", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Area", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Area", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Area", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-Campaigns", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-Campaign", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-Campaign", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-Campaign", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-Campaign", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-Campaign", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-ContactRequests", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-ContactRequest", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-ContactRequest", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-ContactRequest", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-ContactRequest", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-ContactRequest", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-CampaignsBeneficiaries", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-CampaignBeneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-CampaignBeneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-CampaignBeneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-CampaignBeneficiary", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-CampaignBeneficiary", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-CampaignsDonors", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-CampaignDonor", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-CampaignDonor", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-CampaignDonor", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-CampaignDonor", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-CampaignDonor", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-CampaignsServices", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-CampaignService", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-CampaignService", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-CampaignService", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-CampaignService", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-CampaignService", "guard_name" => "admin"]);

        Permission::create(["name" => "Index-CampaignImages", "guard_name" => "admin"]);
        Permission::create(["name" => "Create-CampaignImage", "guard_name" => "admin"]);
        Permission::create(["name" => "Update-CampaignImage", "guard_name" => "admin"]);
        Permission::create(["name" => "Delete-CampaignImage", "guard_name" => "admin"]);
        Permission::create(["name" => "Restore-CampaignImage", "guard_name" => "admin"]);
        Permission::create(["name" => "forceDelete-CampaignImage", "guard_name" => "admin"]);
    }
}
