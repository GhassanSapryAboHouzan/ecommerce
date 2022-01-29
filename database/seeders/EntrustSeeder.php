<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $adminRole = Role::create([
            'name' => 'admin', 'display_name' => 'Administration', 'description' => 'Administrator', 'allowed_route' => 'admin',
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $supervisorRole = Role::create([
            'name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor', 'allowed_route' => 'admin',
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $customerRole = Role::create([
            'name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer', 'allowed_route' => null,
        ]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'admin',
            'email' => 'admin@ecommerceMind.test',
            'email_verified_at' => now(),
            'mobile' => '0592404941',
            'password' => bcrypt('123456'),
            'user_image' => '',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        $admin->attachRole($adminRole);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Supervisor
        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'System',
            'username' => 'supervisor',
            'email' => 'supervisor@ecommerceMind.test',
            'email_verified_at' => now(),
            'mobile' => '0592404942',
            'password' => bcrypt('123456'),
            'user_image' => '',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        $supervisor->attachRole($supervisorRole);

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// customer
        $customer = User::create([
            'first_name' => 'ghassan',
            'last_name' => 'abo houzan',
            'username' => 'ghassan',
            'email' => 'kassper1986@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '0592404940',
            'password' => bcrypt('123456'),
            'user_image' => '',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);
        $customer->attachRole($customerRole);


        /*
         * Create 1000 fake users with their addresses.
         */

        User::factory()->count(10)->hasAddresses(1)->create();


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Permissions
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// main
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Main
        $manageMain = Permission::create(['name' => 'main', 'display_name_ar' => 'الرئيسية', 'display_name_en' => 'Main', 'description' => 'Main Page', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fas fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1',]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Product Categories
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Product Categories
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name_ar' => 'المجموعات', 'display_name_en' => 'Categories', 'description' => 'Categories page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();
        /// show Product Categories
        $showProductCategories = Permission::create(['name' => 'show_product_categories', 'display_name_ar' => 'المجموعات', 'display_name_en' => 'Categories', 'description' => 'Categories page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Product Categories
        $createProductCategories = Permission::create(['name' => 'create_product_categories', 'display_name_ar' => 'اضافة مجموعة', 'display_name_en' => 'Create Category', 'description' => 'Create Category page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => 'circle', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Product Categories
        $displayProductCategories = Permission::create(['name' => 'display_product_categories', 'display_name_ar' => 'عرض المجموعات', 'display_name_en' => 'Show Category', 'description' => 'Show Category page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => 'circle', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Product Categories
        $updateProductCategories = Permission::create(['name' => 'update_product_categories', 'display_name_ar' => 'تعديل المجموعة', 'display_name_en' => 'Update Category', 'description' => 'Update Category page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => 'circle', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Product Categories
        $deleteProductCategories = Permission::create(['name' => 'delete_product_categories', 'display_name_ar' => 'حذف المجموعة', 'display_name_en' => 'Delete Category', 'description' => 'Delete Category page', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => 'circle', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Product Tags
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Tags
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name_ar' => 'الأوسمة', 'display_name_en' => 'Tags', 'description' => 'Tags page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tag', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageTags->parent_show = $manageTags->id;
        $manageTags->save();
        /// show Tags
        $showTags = Permission::create(['name' => 'show_tags', 'display_name_ar' => 'الأوسمة', 'display_name_en' => 'Tags', 'description' => 'Tags page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tag', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Tags
        $createTags = Permission::create(['name' => 'create_tags', 'display_name_ar' => 'اضافة وسم', 'display_name_en' => 'Create Tag', 'description' => 'Create Tag page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.create', 'icon' => 'circle', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Tags
        $displayTags = Permission::create(['name' => 'display_tags', 'display_name_ar' => 'عرض الأوسمة', 'display_name_en' => 'Show Tags', 'description' => 'Show Tags page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.show', 'icon' => 'circle', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Tags
        $updateTags = Permission::create(['name' => 'update_tags', 'display_name_ar' => 'تعديل الوسم', 'display_name_en' => 'Update Tag', 'description' => 'Update Tag page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => 'circle', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Tags
        $deleteTags = Permission::create(['name' => 'delete_tags', 'display_name_ar' => 'حذف الوسم', 'display_name_en' => 'Delete Tag', 'description' => 'Delete Tag page', 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => 'circle', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Products
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Products
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name_ar' => 'المنتجات', 'display_name_en' => 'Products', 'description' => 'Products page', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-edit', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();
        /// show Products
        $showProducts = Permission::create(['name' => 'show_products', 'display_name_ar' => 'المنتجات', 'display_name_en' => 'Products', 'description' => 'Products page', 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-edit', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Products
        $createProducts = Permission::create(['name' => 'create_products', 'display_name_ar' => 'اضافة منتج', 'display_name_en' => 'Create Product', 'description' => 'Create Product page', 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => 'circle', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Products
        $displayProducts = Permission::create(['name' => 'display_products', 'display_name_ar' => 'عرض منتج', 'display_name_en' => 'Show Product', 'description' => 'Show Product page', 'route' => 'products', 'module' => 'products', 'as' => 'products.show', 'icon' => 'circle', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Products
        $updateProducts = Permission::create(['name' => 'update_products', 'display_name_ar' => 'تعديل منتج', 'display_name_en' => 'Update Product', 'description' => 'Update Product page', 'route' => 'products', 'module' => 'products', 'as' => 'products.edit', 'icon' => 'circle', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Products
        $deleteProducts = Permission::create(['name' => 'delete_products', 'display_name_ar' => 'حذف منتج', 'display_name_en' => 'Delete Product', 'description' => 'Delete Product page', 'route' => 'products', 'module' => 'products', 'as' => 'products.destroy', 'icon' => 'circle', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Product Coupons
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Product Coupons
        $manageProductCoupons = Permission::create(['name' => 'manage_product_coupons', 'display_name_ar' => 'الكوبونات', 'display_name_en' => 'Products Coupons', 'description' => 'Product Coupons page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percentage', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageProductCoupons->parent_show = $manageProductCoupons->id;
        $manageProductCoupons->save();
        /// show Product Coupons
        $showProductCoupons = Permission::create(['name' => 'show_product_coupons', 'display_name_ar' => 'الكوبونات', 'display_name_en' => 'Products Coupons', 'description' => 'Products Coupons page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percentage', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Product Coupons
        $createProductCoupons = Permission::create(['name' => 'create_product_coupons', 'display_name_ar' => 'اضافة كوبون', 'display_name_en' => 'Create Coupon', 'description' => 'Create Product Coupon page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.create', 'icon' => 'circle', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Product Coupons
        $displayProductCoupons = Permission::create(['name' => 'display_product_coupons', 'display_name_ar' => 'عرض كوبون', 'display_name_en' => 'Show Coupon', 'description' => 'Show Product Coupon page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.show', 'icon' => 'circle', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Product Coupons
        $updateProductCoupons = Permission::create(['name' => 'update_product_coupons', 'display_name_ar' => 'تعديل كوبون', 'display_name_en' => 'Update Coupon', 'description' => 'Update Product Coupon page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.edit', 'icon' => 'circle', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Product Coupons
        $deleteProductCoupons = Permission::create(['name' => 'delete_product_coupons', 'display_name_ar' => 'حذف كوبون', 'display_name_en' => 'Delete Coupon', 'description' => 'Delete Product Coupon page', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.destroy', 'icon' => 'circle', 'parent' => $manageProductCoupons->id, 'parent_original' => $manageProductCoupons->id, 'parent_show' => $manageProductCoupons->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Product Reviews
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Product Reviews
        $manageProductReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name_ar' => 'تعليقات المنتج', 'display_name_en' => 'Products Reviews', 'description' => 'Product Reviews page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $manageProductReviews->parent_show = $manageProductReviews->id;
        $manageProductReviews->save();
        /// show Product Reviews
        $showProductReviews = Permission::create(['name' => 'show_product_reviews', 'display_name_ar' => 'تعليقات المنتج', 'display_name_en' => 'Products Reviews', 'description' => 'Products Reviews page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Product Reviews
        $createProductReviews = Permission::create(['name' => 'create_product_reviews', 'display_name_ar' => 'اضافة تعليق', 'display_name_en' => 'Create Review ', 'description' => 'Create Product Review page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.create', 'icon' => 'circle', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Product Reviews
        $displayProductReviews = Permission::create(['name' => 'display_product_reviews', 'display_name_ar' => 'عرض تعليق', 'display_name_en' => 'Show Review', 'description' => 'Show Product Review page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.show', 'icon' => 'circle', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Product Reviews
        $updateProductReviews = Permission::create(['name' => 'update_product_reviews', 'display_name_ar' => 'تعديل تعليق', 'display_name_en' => 'Update Review', 'description' => 'Update Product Review page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.edit', 'icon' => 'circle', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Product Reviews
        $deleteProductReviews = Permission::create(['name' => 'delete_product_reviews', 'display_name_ar' => 'حذف تعليق', 'display_name_en' => 'Delete Review', 'description' => 'Delete Product Review page', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.destroy', 'icon' => 'circle', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Customers
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Customers
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name_ar' => 'العملاء', 'display_name_en' => 'Customers', 'description' => 'Customers page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30',]);
        $manageCustomers->parent_show = $manageCustomers->id;
        $manageCustomers->save();
        /// show Customers
        $showCustomers = Permission::create(['name' => 'show_customers', 'display_name_ar' => 'العملاء', 'display_name_en' => 'Customers', 'description' => 'Customers page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Customers
        $createCustomers = Permission::create(['name' => 'create_customers', 'display_name_ar' => 'اضافة عميل', 'display_name_en' => 'Create Customer ', 'description' => 'Create Customer page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => 'circle', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Customers
        $displayCustomers = Permission::create(['name' => 'display_customers', 'display_name_ar' => 'عرض عميل', 'display_name_en' => 'Show Customer', 'description' => 'Show Customer page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => 'circle', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Customers
        $updateCustomers = Permission::create(['name' => 'update_customers', 'display_name_ar' => 'تعديل العميل', 'display_name_en' => 'Update Customer', 'description' => 'Update Customer page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => 'circle', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Customers
        $deleteCustomers = Permission::create(['name' => 'delete_customers', 'display_name_ar' => 'حذف العميل', 'display_name_en' => 'Delete Customer', 'description' => 'Delete Customer page', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => 'circle', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Customer Addresses
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Customer Addresses
        $manageCustomerAddresses = Permission::create(['name' => 'manage_customer_addresses', 'display_name_ar' => 'عنوان المستخدمين', 'display_name_en' => 'Customer Addresses', 'description' => 'Customer Addresses page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '35',]);
        $manageCustomerAddresses->parent_show = $manageCustomerAddresses->id;
        $manageCustomerAddresses->save();
        /// show Customer Addresses
        $showCustomerAddresses = Permission::create(['name' => 'show_customer_addresses', 'display_name_ar' => 'عنوان المستخدمين', 'display_name_en' => 'Customer Addresses', 'description' => 'Customer Addresses page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Customer Addresses
        $createCustomerAddresses = Permission::create(['name' => 'create_customer_addresses', 'display_name_ar' => 'اضافة عنوان مستخدم', 'display_name_en' => 'Create Customer Address ', 'description' => 'Create Customer Address page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.create', 'icon' => 'circle', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Customer Addresses
        $displayCustomerAddresses = Permission::create(['name' => 'display_customer_addresses', 'display_name_ar' => 'عرض عنوان المستخدم', 'display_name_en' => 'Show Customer Address', 'description' => 'Show Customer Address page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.show', 'icon' => 'circle', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Customer Addresses
        $updateCustomerAddresses = Permission::create(['name' => 'update_customer_addresses', 'display_name_ar' => 'تعديل عنوان المستخدم', 'display_name_en' => 'Update Customer Address', 'description' => 'Update Customer Address page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.edit', 'icon' => 'circle', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Customer Addresses
        $deleteCustomerAddresses = Permission::create(['name' => 'delete_customer_addresses', 'display_name_ar' => 'حذف عنوان المستخدم', 'display_name_en' => 'Delete Customer Address', 'description' => 'Delete Customer Address page', 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.destroy', 'icon' => 'circle', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Orders
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Orders
        $manageOrders = Permission::create(['name' => 'manage_orders', 'display_name_ar' => 'الطلبات', 'display_name_en' => 'Orders', 'description' => 'Orders page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
        $manageOrders->parent_show = $manageOrders->id;
        $manageOrders->save();
        /// show Orders
        $showOrders = Permission::create(['name' => 'show_orders', 'display_name_ar' => 'الطلبات', 'display_name_en' => 'Orders', 'description' => 'Orders page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '1',]);
        /// create Orders
        $createOrders = Permission::create(['name' => 'create_orders', 'display_name_ar' => 'اضافة طلب', 'display_name_en' => 'Create Order ', 'description' => 'Create Order page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.create', 'icon' => 'circle', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Orders
        $displayOrders = Permission::create(['name' => 'display_orders', 'display_name_ar' => 'عرض الطلب', 'display_name_en' => 'Show Order', 'description' => 'Show Orders page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.show', 'icon' => 'circle', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Orders
        $updateOrders = Permission::create(['name' => 'update_orders', 'display_name_ar' => 'تعديل الطلب', 'display_name_en' => 'Update Order', 'description' => 'Update Orders page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.edit', 'icon' => 'circle', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Orders
        $deleteOrders = Permission::create(['name' => 'delete_orders', 'display_name_ar' => 'حذف الطلب', 'display_name_en' => 'Delete Order ', 'description' => 'Delete Orders  page', 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.destroy', 'icon' => 'circle', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Countries
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Countries
        $manageCountries = Permission::create(['name' => 'manage_countries', 'display_name_ar' => 'الدول', 'display_name_en' => 'Countries', 'description' => 'Countries page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageCountries->parent_show = $manageCountries->id;
        $manageCountries->save();
        /// show Countries
        $showCountries = Permission::create(['name' => 'show_countries', 'display_name_ar' => 'الدول', 'display_name_en' => 'Countries', 'description' => 'Countries page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create Countries
        $createCountries = Permission::create(['name' => 'create_countries', 'display_name_ar' => 'اضافة دولة', 'display_name_en' => 'Create Country ', 'description' => 'Create Country page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.create', 'icon' => 'circle', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Countries
        $displayCountries = Permission::create(['name' => 'display_countries', 'display_name_ar' => 'عرض الدولة', 'display_name_en' => 'Show Country', 'description' => 'Show Country page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.show', 'icon' => 'circle', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Countries
        $updateCountries = Permission::create(['name' => 'update_countries', 'display_name_ar' => 'تعديل الدولة', 'display_name_en' => 'Update Country', 'description' => 'Update Country page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.edit', 'icon' => 'circle', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Countries
        $deleteCountries = Permission::create(['name' => 'delete_countries', 'display_name_ar' => 'حذف الدولة', 'display_name_en' => 'Delete Country', 'description' => 'Delete Country page', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.destroy', 'icon' => 'circle', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// States
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage States
        $manageStates = Permission::create(['name' => 'manage_states', 'display_name_ar' => 'المحافظات', 'display_name_en' => 'States', 'description' => 'States page', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $manageStates->parent_show = $manageStates->id;
        $manageStates->save();
        /// show States
        $showStates = Permission::create(['name' => 'show_states', 'display_name_ar' => 'المحافظات', 'display_name_en' => 'States', 'description' => 'States page', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create States
        $createStates = Permission::create(['name' => 'create_states', 'display_name_ar' => 'اضافة محافظة', 'display_name_en' => 'Create State ', 'description' => 'Create State page', 'route' => 'states', 'module' => 'states', 'as' => 'states.create', 'icon' => 'circle', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display States
        $displayStates = Permission::create(['name' => 'display_states', 'display_name_ar' => 'عرض المحافظة', 'display_name_en' => 'Show State', 'description' => 'Show State page', 'route' => 'states', 'module' => 'states', 'as' => 'states.show', 'icon' => 'circle', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update States
        $updateStates = Permission::create(['name' => 'update_states', 'display_name_ar' => 'تعديل الدولة', 'display_name_en' => 'Update State', 'description' => 'Update State page', 'route' => 'states', 'module' => 'states', 'as' => 'states.edit', 'icon' => 'circle', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete States
        $deleteStates = Permission::create(['name' => 'delete_states', 'display_name_ar' => 'حذف المحافظة', 'display_name_en' => 'Delete State', 'description' => 'Delete State page', 'route' => 'states', 'module' => 'states', 'as' => 'states.destroy', 'icon' => 'circle', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Cities
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Cities
        $manageCities = Permission::create(['name' => 'manage_cities', 'display_name_ar' => 'المدن', 'display_name_en' => 'Cities', 'description' => 'Cities page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageCities->parent_show = $manageCities->id;
        $manageCities->save();
        /// show Cities
        $showCities = Permission::create(['name' => 'show_cities', 'display_name_ar' => 'المدن', 'display_name_en' => 'Cities', 'description' => 'Cities page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create Cities
        $createCities = Permission::create(['name' => 'create_cities', 'display_name_ar' => 'اضافة مدينة', 'display_name_en' => 'Create City ', 'description' => 'Create City page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.create', 'icon' => 'circle', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Cities
        $displayCities = Permission::create(['name' => 'display_cities', 'display_name_ar' => 'عرض المدينة', 'display_name_en' => 'Show City', 'description' => 'Show City page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.show', 'icon' => 'circle', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Cities
        $updateCities = Permission::create(['name' => 'update_cities', 'display_name_ar' => 'تعديل المدينة', 'display_name_en' => 'Update City', 'description' => 'Update City page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.edit', 'icon' => 'circle', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Cities
        $deleteCities = Permission::create(['name' => 'delete_cities', 'display_name_ar' => 'حذف المدينة', 'display_name_en' => 'Delete City', 'description' => 'Delete City page', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.destroy', 'icon' => 'circle', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Shipping Companies
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Shipping Companies
        $manageShippingCompanies = Permission::create(['name' => 'manage_shipping_companies', 'display_name_ar' => 'شركات الشحن', 'display_name_en' => 'Shipping Companies', 'description' => 'Shipping Companies page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-truck', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '60',]);
        $manageShippingCompanies->parent_show = $manageShippingCompanies->id;
        $manageShippingCompanies->save();
        /// show Shipping Companies
        $showShippingCompanies = Permission::create(['name' => 'show_shipping_companies', 'display_name_ar' => 'شركات الشحن', 'display_name_en' => 'Shipping Companies', 'description' => 'Shipping Companies page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-truck', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create Shipping Companies
        $createShippingCompanies = Permission::create(['name' => 'create_shipping_companies', 'display_name_ar' => 'اضافة شركة شحن', 'display_name_en' => 'Shipping Company', 'description' => 'Create Shipping Company page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.create', 'icon' => 'circle', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Shipping Companies
        $displayShippingCompanies = Permission::create(['name' => 'display_shipping_companies', 'display_name_ar' => 'عرض شركة الشحن', 'display_name_en' => 'Show Shipping Company', 'description' => 'Show Shipping Company page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.show', 'icon' => 'circle', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Shipping Companies
        $updateShippingCompanies = Permission::create(['name' => 'update_shipping_companies', 'display_name_ar' => 'تعديل شركة الشحن', 'display_name_en' => 'Update Shipping Company', 'description' => 'Update Shipping Company page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.edit', 'icon' => 'circle', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Shipping Companies
        $deleteShippingCompanies = Permission::create(['name' => 'delete_shipping_companies', 'display_name_ar' => 'حذف شركة الشحن', 'display_name_en' => 'Delete Shipping Company', 'description' => 'Delete Shipping Company page', 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.destroy', 'icon' => 'circle', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Payment Methods
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Payment Methods
        $managePaymentMethods = Permission::create(['name' => 'manage_payment_methods', 'display_name_ar' => 'طرق الدفع', 'display_name_en' => 'Payment Methods', 'description' => 'Payment Methods page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '100',]);
        $managePaymentMethods->parent_show = $managePaymentMethods->id;
        $managePaymentMethods->save();
        /// show Payment Methods
        $showPaymentMethods = Permission::create(['name' => 'show_payment_methods', 'display_name_ar' => 'طرق الدفع', 'display_name_en' => 'Payment Methods', 'description' => 'Payment Methods page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create Payment Methods
        $createPaymentMethods = Permission::create(['name' => 'create_payment_methods', 'display_name_ar' => 'اضافة طريقة دفع', 'display_name_en' => 'Create Payment Method ', 'description' => 'Create Payment Method page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.create', 'icon' => 'circle', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Payment Methods
        $displayPaymentMethods = Permission::create(['name' => 'display_payment_methods', 'display_name_ar' => 'عرض طريقة دفع', 'display_name_en' => 'Show Payment Method', 'description' => 'Show Payment Method page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.show', 'icon' => 'circle', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Payment Methods
        $updatePaymentMethods = Permission::create(['name' => 'update_payment_methods', 'display_name_ar' => 'تعديل طريقة الدفع', 'display_name_en' => 'Update Payment Method', 'description' => 'Update Payment Method page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.edit', 'icon' => 'circle', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Payment Methods
        $deletePaymentMethods = Permission::create(['name' => 'delete_payment_methods', 'display_name_ar' => 'حذف طريقة الدفع', 'display_name_en' => 'Delete Payment Method', 'description' => 'Delete Payment Method page', 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.destroy', 'icon' => 'circle', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0',]);


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Supervisors
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Manage Supervisors
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name_ar' => 'المشرفين', 'display_name_en' => 'Supervisors', 'description' => 'Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-users', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '100',]);
        $manageSupervisors->parent_show = $manageSupervisors->id;
        $manageSupervisors->save();
        /// show Supervisors
        $showSupervisors = Permission::create(['name' => 'show_supervisors', 'display_name_ar' => 'المشرفين', 'display_name_en' => 'Supervisors', 'description' => 'Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-users', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '1',]);
        /// create Supervisors
        $createSupervisors = Permission::create(['name' => 'create_supervisors', 'display_name_ar' => 'اضافة مشرف', 'display_name_en' => 'Create Supervisor ', 'description' => 'Create Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => 'circle', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// display Supervisors
        $displaySupervisors = Permission::create(['name' => 'display_supervisors', 'display_name_ar' => 'عرض مشرف', 'display_name_en' => 'Show Supervisor', 'description' => 'Show Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => 'circle', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// update Supervisors
        $updateSupervisors = Permission::create(['name' => 'update_supervisors', 'display_name_ar' => 'تعديل المشرف', 'display_name_en' => 'Update Supervisor', 'description' => 'Update Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => 'circle', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0',]);
        /// delete Supervisors
        $deleteSupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name_ar' => 'حذف المشرف', 'display_name_en' => 'Delete Supervisor', 'description' => 'Delete Supervisor page', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => 'circle', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0',]);


    }
}
