<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\Pages\AuthenticationResources\Login::class)->name('login');

Route::group(['middleware' => 'auth'], function () {

  // Route::get('/dashboard', \App\Livewire\Pages\DashboardResources\Dashboard::class)->name('dashboard');

  Route::get('/dashboard', \App\Livewire\Pages\DashboardResources\Dashboard::class)->name('dashboard');

  Route::get('/product-category-firsts', \App\Livewire\Pages\ProductCategoryFirstResources\ProductCategoryFirstList::class)->name('product_category_firsts.list');
  Route::get('/product-category-firsts/create', \App\Livewire\Pages\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->name('product_category_firsts.create');
  Route::get('/product-category-firsts/edit/{id}', \App\Livewire\Pages\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->name('product_category_firsts.edit');
  Route::get('/product-category-firsts/show/{id}/{readonly}', \App\Livewire\Pages\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->where('readonly', 'readonly')->name('product_category_firsts.show');

  Route::get('/product-category-seconds', \App\Livewire\Pages\ProductCategorySecondResources\ProductCategorySecondList::class)->name('product_category_seconds.list');
  Route::get('/product-category-seconds/create', \App\Livewire\Pages\ProductCategorySecondResources\ProductCategorySecondCrud::class)->name('product_category_seconds.create');
  Route::get('/product-category-seconds/edit/{id}', \App\Livewire\Pages\ProductCategorySecondResources\ProductCategorySecondCrud::class)->name('product_category_seconds.edit');
  Route::get('/product-category-seconds/show/{id}/{readonly}', \App\Livewire\Pages\ProductCategorySecondResources\ProductCategorySecondCrud::class)->where('readonly', 'readonly')->name('product_category_seconds.show');

  
  // Route::get('/employees', \App\Livewire\Pages\Employees\EmployeeIndex::class);
  // Route::get('/employees/create', \App\Livewire\Pages\Employees\EmployeeCrud::class);

  // Route::get('/marketplaces', \App\Livewire\Pages\Marketplaces\MarketplaceIndex::class);
  // Route::get('/marketplaces/create', \App\Livewire\Pages\Marketplaces\MarketplaceCrud::class)->name('marketplace.create');
  // Route::get('/marketplaces/edit/{id}', \App\Livewire\Pages\Marketplaces\MarketplaceCrud::class)->name('marketplace.edit');

  // Route::get('/meta-property-groups', \App\Livewire\Pages\MetaPropertyGroups\MetaPropertyGroupIndex::class);
  // Route::get('/meta-property-groups/create', \App\Livewire\Pages\MetaPropertyGroups\MetaPropertyGroupCrud::class);
  // Route::get('/meta-property-groups/edit/{id}', \App\Livewire\Pages\MetaPropertyGroups\MetaPropertyGroupCrud::class);

  // Route::get('/meta-properties', \App\Livewire\Pages\MetaProperties\MetaPropertyIndex::class);
  // Route::get('/meta-properties/create', \App\Livewire\Pages\MetaProperties\MetaPropertyCrud::class);
  // Route::get('/meta-properties/edit/{id}', \App\Livewire\Pages\MetaProperties\MetaPropertyCrud::class);

  // Route::get('/product-category-seconds', \App\Livewire\Pages\ProductCategorySecondResources\ProductCategorySecondList::class);
  // Route::get('/product-category-seconds/create', \App\Livewire\Pages\ProductCategorySeconds\ProductCategorySecondCrud::class);
  // Route::get('/product-category-seconds/edit/{id}', \App\Livewire\Pages\ProductCategorySeconds\ProductCategorySecondCrud::class);

  // Route::get('/product-category-firsts', \App\Livewire\Pages\ProductCategoryFirstResources\ProductCategoryFirstList::class);
  // Route::get('/product-category-firsts/create', \App\Livewire\Pages\ProductCategoryFirsts\ProductCategoryFirstCrud::class);
  // Route::get('/product-category-firsts/edit/{id}', \App\Livewire\Pages\ProductCategoryFirsts\ProductCategoryFirstCrud::class);

  // Route::get('/products', \App\Livewire\Pages\Products\ProductIndex::class);
  // Route::get('/products/create', \App\Livewire\Pages\Products\ProductCrud::class);
  // Route::get('/products/edit/{id}', \App\Livewire\Pages\Products\ProductCrud::class);


  Route::get('/products', \App\Livewire\Pages\ProductResources\ProductList::class);
  Route::get('/product-contents', \App\Livewire\Pages\ProductContentResources\ProductContentList::class);
  // Route::get('/product-contents/create', \App\Livewire\Pages\ProductContents\ProductContentCrud::class);
  Route::get('/product-contents/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentCrud::class);
  Route::get('/product-content-metas/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentMetaCrud::class);
  Route::get('/product-content-displays/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentDisplayCrud::class);
  // Route::get('/product-content-videos/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentVideoCrud::class);
  // Route::get('/product-content-specifications/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentSpecificationCrud::class);
  // Route::get('/product-content-features/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentFeatureCrud::class);
  // Route::get('/product-content-qnas/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentQnaCrud::class);
  // Route::get('/product-content-reviews/edit/{id}', \App\Livewire\Pages\ProductContentResources\ProductContentReviewCrud::class);

});

