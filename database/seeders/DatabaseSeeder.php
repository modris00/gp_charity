<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([Role::class, Permission::class]);
        $this->call([RoleSeeder::class]);
        $this->call([PermissionSeeder::class]);

        \App\Models\Country::create([
            'name' => 'country1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\City::create([
            'name' => 'city1',
            'country_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Area::create([
            'name' => 'area1',
            'city_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Category::create([
            'name' => 'category1',
            'description' => 'cat1 description',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\SubCategory::create([
            'name' => 'SubCategory1',
            'description' => 'subCat1 description',
            'category_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin =   \App\Models\Admin::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $roleAdmin = Role::findById(1, 'admin');
        $admin->assignRole($roleAdmin);


        $donor = \App\Models\Donor::create([
            'name' => 'Donor1',
            'phone' => '987654321',
            'username' => 'Donor1_username',
            'email' => 'Donor1_email@app.com',
            'area_id' => '1',
            'password' => Hash::make(123456),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $roleDonor = Role::findById(3, 'donor');
        $donor->assignRole($roleDonor);


        $beneficiary =  \App\Models\Beneficiary::create([
            'name' => 'Beneficiary1',
            'age' => '20',
            'gender' => 'Male',
            "phone" => "0592403622",
            'username' => 'Beneficiary1_username',
            'email' => 'Beneficiary1_email@app.com',
            'area_id' => '1',
            'password' => Hash::make(123456),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $roleBeneficiary = Role::findById(2, 'beneficiary');
        $beneficiary->assignRole($roleBeneficiary);

        $role = Role::findById(2, "beneficiary");
        $beneficiary->assignRole($role);



        $donor = \App\Models\Donor::create([
            'name' => 'Donor1',
            'phone' => '987654321',
            'username' => 'Donor1_username',
            'email' => 'Donor1_email@app.com',
            'area_id' => '1',
            'password' => Hash::make(123456),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $role = Role::findById(3, "donor");
        $donor->assignRole($role);


        \App\Models\Faq::create([
            'question' => 'question1',
            'answer' => 'answer question1',
            'question_type' => 'For Donor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Supplier::create([
            'name' => 'Supplier1',
            'phone' => '987654321',
            'address' => 'address Supplier1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Service::create([
            'name' => 'Service1',
            'description' => 'service1 description',
            'active' => 1,
            'sub_category_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Currency::create([
            'name' => 'Currency1',
            'abbreviation' => 'C1Abv',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Campaign::create([
            'title' => 'Campaign1 title name',
            'amount' => '1000',
            'status' => 'Finished',
            'start_date' => now(),
            'end_date' => now(),
            'admin_id' => '1',
            'currency_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\CampaignsServices::create([
            'amount' => '2000',
            'description' => 'description camp_serv1',
            'status' => 1,
            'start_date' => now(),
            'end_date' => now(),

            'campaign_id' => '1',
            'service_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Bill::create([
            'cost' => '123',
            'description' => 'description bill1',

            'campaign_id' => '1',
            'supplier_id' => '1',
            'currency_id' => '1',
            'campaign_service_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\CampaignOperations::create([
            'date' => now(),
            'description' => 'description operation1',
            'cost' => '1000',
            'cost_type' => 'Primary',

            'admin_id' => '1',
            'campaign_id' => '1',
            'service_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\ContactRequest::create([
            'actor_id' => '1',
            'actor_type' => 'App\Models\Donor',
            'title' => 'contact_request 1',
            'message' => 'message contact_request 1',
            'email' => 'contact1@email.com',
            'phone' => '1231231231',
            'response' => 'contact1 response',
            'isClosed' => 1,

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\CampaignsDonors::create([
            'amount' => '700',

            'campaign_id' => '1',
            'donor_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\CampaignsBeneficiaries::create([
            'amount' => '800',
            'description' => 'description camp_bene1',
            'status' => 'finished',

            'campaign_id' => '1',
            'beneficiary_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\CampaignImages::create([
            'image' => 'image.png',
            'description' => 'image1 description',
            'active' => 1,
            'campaign_id' => '1',

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
