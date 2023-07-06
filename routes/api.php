<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignOperationsController;
use App\Http\Controllers\CampaignImagesController;
use App\Http\Controllers\CampaignsBeneficiariesController;
use App\Http\Controllers\CampaignsDonorsController;
use App\Http\Controllers\CampaignsServicesController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Clear Cache
 */
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    // Artisan::call('route:cache');
    // Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache has been cleared';
});
/** End */

/**
 * Faqs
 */
Route::get('/faqs/archive', [FaqController::class, 'Archives']);
Route::apiResource("faqs", FaqController::class);
Route::put('/faqs/{faq}/restore', [FaqController::class, 'restore']);
Route::delete('/faqs/{faq}/force-delete', [FaqController::class, 'forceDelete']);
/** End */

/**
 * Suppliers
 */
Route::get('/suppliers/archive', [SupplierController::class, 'Archives']);
Route::apiResource("suppliers", SupplierController::class);
Route::put('/suppliers/{supplier}/restore', [SupplierController::class, 'restore']);
Route::delete('/suppliers/{supplier}/force-delete', [SupplierController::class, 'forceDelete']);
/** End */

/**
 * Countries
 */
Route::get('/countries/archive', [CountryController::class, 'Archives']);
Route::apiResource('countries', CountryController::class);
Route::put('/countries/{country}/restore', [CountryController::class, 'restore']);
Route::delete('/countries/{country}/force-delete', [CountryController::class, 'forceDelete']);
/** End */

/**
 * Cities
 */
Route::get('/cities/archive', [CityController::class, 'Archives']);
Route::apiResource('cities', CityController::class);
Route::put('/cities/{city}/restore', [CityController::class, 'restore']);
Route::delete('/cities/{city}/force-delete', [CityController::class, 'forceDelete']);
/** End */

/** Areas */
Route::get('/areas/archive', [AreaController::class, 'Archives']);
Route::apiResource('areas', AreaController::class);
Route::put('/areas/{area}/restore', [AreaController::class, 'restore']);
Route::delete('/areas/{area}/force-delete', [AreaController::class, 'forceDelete']);
/** End */

/**
 * Categories
 */
Route::get('/categories/archive', [CategoryController::class, 'Archives']);
Route::apiResource('categories', CategoryController::class);
Route::put('/categories/{category}/restore', [CategoryController::class, 'restore']);
Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete']);
/** End */

/**
 * subCategories
 * (Multi-Word)
 */
Route::apiResource('sub-categories', SubCategoryController::class);
Route::put('/sub-categories/{subCategory}/restore', [SubCategoryController::class, 'restore']);
Route::delete('/sub-categories/{subCategory}/force-delete', [SubCategoryController::class, 'forceDelete']);
/** End */

/**
 * Services
 */
Route::get('/services/archive', [ServiceController::class, 'Archives']);
Route::apiResource('services', ServiceController::class);
Route::put('/services/{service}/restore', [ServiceController::class, 'restore']);
Route::delete('/services/{service}/force-delete', [ServiceController::class, 'forceDelete']);
/** End */

/**
 * Admins
 */
Route::get('/admins/archive', [AdminController::class, 'Archives']);
Route::apiResource('admins', AdminController::class);
Route::put('/admins/{admin}/restore', [AdminController::class, 'restore']);
Route::delete('/admins/{admin}/force-delete', [AdminController::class, 'forceDelete']);
/** End */

/**
 * Currencies
 */
Route::apiResource('currencies', CurrencyController::class);
Route::put('/currencies/{currency}/restore', [CurrencyController::class, 'restore']);
Route::delete('/currencies/{currency}/force-delete', [CurrencyController::class, 'forceDelete']);
/** End */

/**
 * Campaigns
 */
Route::get('/campaigns/archive', [CampaignController::class, 'Archives']);
Route::apiResource('campaigns', CampaignController::class);
Route::put('/campaigns/{campaign}/restore', [CampaignController::class, 'restore']);
Route::delete('/campaigns/{campaign}/force-delete', [CampaignController::class, 'forceDelete']);
/** End */

/**
 * Donors
 */
Route::get('/donors/archive', [DonorController::class, 'Archives']);
Route::apiResource('donors', DonorController::class);
Route::put('/donors/{donor}/restore', [DonorController::class, 'restore']);
Route::delete('/donors/{donor}/force-delete', [DonorController::class, 'forceDelete']);
/** End */

/**
 * Beneficiaries
 */
Route::get('/beneficiaries/archive', [BeneficiaryController::class, 'Archives']);
Route::apiResource('beneficiaries', BeneficiaryController::class);
Route::put('/beneficiaries/{beneficiary}/restore', [BeneficiaryController::class, 'restore']);
Route::delete('/beneficiaries/{beneficiary}/force-delete', [BeneficiaryController::class, 'forceDelete']);
/** End */

/**
 * Contact-Requests
 * (Multi-Word)
 */
Route::get('/contact-requests/archive', [ContactRequestController::class, 'Archives']);
Route::apiResource('contact-requests', ContactRequestController::class);
Route::delete('/contact-requests/{contactRequest}/force-delete', [ContactRequestController::class, 'forceDelete']);
Route::put('/contact-requests/{contactRequest}/restore', [ContactRequestController::class, 'restore']);
/** End */

/**
 * Bills
 */
Route::apiResource('bills', BillController::class);
Route::delete('/bills/{bill}/force-delete', [BillController::class, 'forceDelete']);
Route::put('/bills/{bill}/restore', [BillController::class, 'restore']);
/** End */

/**
 * Campaigns Operations
 * (Multi-Word)
 */
Route::get('/campaign-operations/archive', [CampaignOperationsController::class, 'Archives']);
Route::apiResource('campaign-operations', CampaignOperationsController::class);
Route::get("campaign-operations/{campaignOperation}/restore", [CampaignOperationsController::class, 'restore']);
Route::delete("campaign-operations/{campaignOperation}/forceDelete", [CampaignOperationsController::class, 'forceDelete']);
/** End */

/**
 * Campaign Images
 * (Multi-Word)
 */
Route::apiResource('campaign-images', CampaignImagesController::class);
Route::get("campaign-images/{campaignImage}/restore", [CampaignImagesController::class, 'restore']);
Route::delete("campaign-images/{campaignImage}/forceDelete", [CampaignImagesController::class, 'forceDelete']);
/** End */

/**
 * Campaigns-Services
 * (Multi-Word)
 */
Route::apiResource('campaigns-services', CampaignsServicesController::class);
Route::get("campaigns-services/{campaignService}/restore", [CampaignsServicesController::class, 'restore']);
Route::delete("campaigns-services/{campaignService}/forceDelete", [CampaignsServicesController::class, 'forceDelete']);
/** End */

/**
 * Campaigns-Donors
 * (Multi-Word)
 */
Route::apiResource('campaigns-donors', CampaignsDonorsController::class);
Route::get("campaigns-donors/{campaignDonor}/restore", [CampaignsDonorsController::class, 'restore']);
Route::delete("campaigns-donors/{campaignDonor}/forceDelete", [CampaignsDonorsController::class, 'forceDelete']);
/** End */

/**
 * Campaigns-Beneficiaries
 * (Multi-Word)
 */
Route::apiResource('campaigns-beneficiaries', CampaignsBeneficiariesController::class);
Route::get("campaigns-beneficiaries/{campaignBeneficiary}/restore", [CampaignsBeneficiariesController::class, 'restore']);
Route::delete("campaigns-beneficiaries/{campaignBeneficiary}/forceDelete", [CampaignsBeneficiariesController::class, 'forceDelete']);
/** End */

/**
 * Roles & Permissions
 */
// Route::middleware('auth:admin-api')->group(function() {
Route::apiResource('roles', RoleController::class);
// Route::delete('/roles/{role}/force-delete', [RoleController::class, 'forceDelete']);
// Route::put('/roles/{role}/restore', [RoleController::class, 'restore']);


Route::apiResource('permissions', PermissionController::class);
// Route::delete('/permissions/{permission}/force-delete', [PermissionController::class, 'forceDelete']);
// Route::put('/permissions/{permission}/restore', [PermissionController::class, 'restore']);

Route::put('/roles/{role}/permission/{permission}', [RoleController::class, 'updateRolePermission']);
// });
