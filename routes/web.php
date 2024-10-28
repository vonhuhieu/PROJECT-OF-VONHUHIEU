<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin

Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin'],
], function(){

    // Trang Chủ
    Route::get('/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'dashboard']);

    // Tài khoản
        // Cập nhật
        Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'profile']);
        Route::post('/profile', [App\Http\Controllers\admin\ProfileController::class, 'profile_update']);

        // Đăng xuất
        Route::get('/admin_logout', [App\Http\Controllers\admin\ProfileController::class, 'admin_logout']);

    // Quốc tịch
        // Danh sách
        Route::get('/country_list', [App\Http\Controllers\admin\CountryController::class, 'country_list']);

        // Thêm
        Route::get('/country_add', [App\Http\Controllers\admin\CountryController::class, 'country_add_form']);
        Route::post('/country_add', [App\Http\Controllers\admin\CountryController::class, 'country_add']);

        // Xóa
        Route::get('/country_delete/{id_country}', [App\Http\Controllers\admin\CountryController::class, 'country_delete']);

    // Bài viết
        // Danh sách
        Route::get('/blog_list', [App\Http\Controllers\admin\BlogController::class, 'blog_list']);

        // Thêm
        Route::get('/blog_add', [App\Http\Controllers\admin\BlogController::class, 'blog_add_form']);
        Route::post('/blog_add', [App\Http\Controllers\admin\BlogController::class, 'blog_add']);

        // Cập nhật
        Route::get('/blog_update/{id_blog}', [App\Http\Controllers\admin\BlogController::class, 'blog_update_form']);
        Route::post('/blog_update/{id_blog}', [App\Http\Controllers\admin\BlogController::class, 'blog_update']);

        // Xóa
        Route::get('/blog_delete/{id_blog}', [App\Http\Controllers\admin\BlogController::class, 'blog_delete']);

    // Danh mục
        // Danh sách
            // Xem danh sách danh mục cha
            Route::get('/category_list', [App\Http\Controllers\admin\CategoryController::class, 'category_list']);

            // Xem danh sách danh mục con
            Route::get('/category_list/{id_category}', [App\Http\Controllers\admin\CategoryController::class, 'categoryCon_list']);

            // Thêm danh mục con
            Route::get('/category_add/{id_category}', [App\Http\Controllers\admin\CategoryController::class, 'categoryCon_add_form']);
            Route::post('/category_add/{id_category}', [App\Http\Controllers\admin\CategoryController::class, 'categoryCon_add']);

            // Xóa danh mục con
            Route::get('/categoryCon_delete/{id_categoryCon}', [App\Http\Controllers\admin\CategoryController::class, 'categoryCon_delete']);

        // Thêm
        Route::get('/category_add', [App\Http\Controllers\admin\CategoryController::class, 'category_add_form']);
        Route::post('/category_add', [App\Http\Controllers\admin\CategoryController::class, 'category_add']);

        // Xóa
        Route::get('/category_delete/{id_category}', [App\Http\Controllers\admin\CategoryController::class, 'category_delete']);

    // Thương hiệu
        // Danh sách
        Route::get('/brand_list', [App\Http\Controllers\admin\BrandController::class, 'brand_list']);
        
        // Thêm
            Route::get('/brand_add', [App\Http\Controllers\admin\BrandController::class, 'brand_add_form']);
            Route::post('/brand_add', [App\Http\Controllers\admin\BrandController::class, 'brand_add']);

        // Xóa
            Route::get('/brand_delete/{id_brand}', [App\Http\Controllers\admin\BrandController::class, 'brand_delete']);

    // Góp ý của người dùng
        // Danh sách
        Route::get('/opinion_list', [App\Http\Controllers\admin\ContactController::class, 'opinion_list']);

        // Xóa
        Route::get('/opinion_delete/{id_opinion}', [App\Http\Controllers\admin\ContactController::class, 'opinion_delete']);

        // Trả lời
        Route::get('/opinion_replay/{id_opinion}', [App\Http\Controllers\admin\ContactController::class, 'opinion_replay_form']);
        Route::post('/opinion_replay/{id_opinion}', [App\Http\Controllers\admin\ContactController::class, 'opinion_replay']);

    // Quản lý tài khoản người dùng
        // Danh sách
        Route::get('/manage_user_list', [App\Http\Controllers\admin\ManageUserController::class, 'manage_user_list']);

        // Xóa
        Route::get('/delete_user/{id_user}', [App\Http\Controllers\admin\ManageUserController::class, 'delete_user']);

    // Quản lý tất cả sản phẩm
        // Danh sách
        Route::get('/manage_product_list', [App\Http\Controllers\admin\ManageProductController::class, 'manage_product_list']);

        // Xóa
        Route::get('/delete_product/{id_product}', [App\Http\Controllers\admin\ManageProductController::class, 'delete_product']);
}); 

// Frontend

Route::group([
    'prefix' => 'frontend',
], function(){
    // Trang chủ

        // Giao diện chung
        Route::get('/index', [App\Http\Controllers\frontend\IndexController::class, 'index']);

        Route::group([
            'prefix' => 'index',
        ], function(){
            // Giao diện theo danh mục
            Route::get('/category/{id_category}', [App\Http\Controllers\frontend\IndexController::class, 'category']);

            // Giao diện theo thương hiệu
            Route::get('/brand/{id_brand}', [App\Http\Controllers\frontend\IndexController::class, 'brand']);
        });

    Route::group([
        'middleware' => 'memberIsLogin',
    ], function(){
        // Đăng ký
        Route::get('/member_register', [App\Http\Controllers\frontend\MemberController::class, 'member_register_form']);
        Route::post('/member_register', [App\Http\Controllers\frontend\MemberController::class, 'member_register']);

        // Đăng nhập
        Route::get('/member_login', [App\Http\Controllers\frontend\MemberController::class, 'member_login_form']);
        Route::post('/member_login', [App\Http\Controllers\frontend\MemberController::class, 'member_login']);

        // Quên mật khẩu

            // Form nhập email 
            Route::get('/member_forget_password', [App\Http\Controllers\frontend\MemberController::class, 'member_forget_password_form']);
            Route::post('/member_forget_password', [App\Http\Controllers\frontend\MemberController::class, 'member_forget_password']);

            // Form nhập mật khẩu mới
            Route::get('/member_reset_password/{token}', [App\Http\Controllers\frontend\MemberController::class, 'member_reset_password_form']);
            Route::post('/member_reset_password/{token}', [App\Http\Controllers\frontend\MemberController::class, 'member_reset_password']);

    });

    // Đăng xuất
    Route::get('/member_logout', [App\Http\Controllers\frontend\MemberController::class, 'member_logout']);

    // Blog
        // Danh sách bài viết
        Route::get('/blog_list', [App\Http\Controllers\frontend\BlogController::class, 'blog_list']);

        // Chi tiết bài viết
        Route::get('/blog_detail/{id_blog}', [App\Http\Controllers\frontend\BlogController::class, 'blog_detail']);

        // Đánh giá
        Route::post('/blog_detail_rate', [App\Http\Controllers\frontend\BlogController::class, 'blog_detail_rate']);

        // Bình luận
            // CmtCha
            Route::post('/blog_detail_cmt', [App\Http\Controllers\frontend\BlogController::class, 'blog_detail_cmt']);

            // Replay
            Route::post('/blog_detail_replay', [App\Http\Controllers\frontend\BlogController::class, 'blog_detail_replay']);

        Route::group([
            'middleware' => ['member'],
        ], function(){
            // Tài khoản
            Route::get('/account', [App\Http\Controllers\frontend\AccountController::class, 'account']);

            // Các menu trong tài khoản
            Route::group([
                'prefix' => 'account',
            ], function(){
            
                // Cập nhật tài khoản
                Route::get('/account_update', [App\Http\Controllers\frontend\AccountController::class, 'account_update_form']);
                Route::post('/account_update', [App\Http\Controllers\frontend\AccountController::class, 'account_update']);

                // Sản phẩm đăng bán
                    // Danh sách
                    Route::get('/my_product', [App\Http\Controllers\frontend\AccountController::class, 'my_product']);

                    // Thêm
                    Route::get('/add_product', [App\Http\Controllers\frontend\AccountController::class, 'add_product_form']);

                        // Hiện input sale khi cần thiết
                        Route::post('/add_product_show_sale_input', [App\Http\Controllers\frontend\AccountController::class, 'add_product_show_sale_input']);
                    Route::post('/add_product', [App\Http\Controllers\frontend\AccountController::class, 'add_product']);

                    // Cập nhật
                    Route::get('/update_product/{id_product}', [App\Http\Controllers\frontend\AccountController::class, 'update_product_form']);
                    Route::post('/update_product/{id_product}', [App\Http\Controllers\frontend\AccountController::class, 'update_product']);

                    // Xóa
                    Route::get('/delete_product/{id_product}', [App\Http\Controllers\frontend\AccountController::class, 'delete_product']);
            });

            // Liên hệ 
            Route::get('/contact', [App\Http\Controllers\frontend\ContactController::class, 'contact_form']);
            Route::post('/contact', [App\Http\Controllers\frontend\ContactController::class, 'contact']);
        });

        // Chi tiết sản phẩm
        Route::get('/product_detail/{id_product}', [App\Http\Controllers\frontend\ProductController::class, 'product_detail']);

            // Đánh giá
            Route::post('/product_detail_rate', [App\Http\Controllers\frontend\ProductController::class, 'product_detail_rate']);

            // Bình luận
            Route::post('/product_detail_review', [App\Http\Controllers\frontend\ProductController::class, 'product_detail_review']);

            // Phản hồi
            Route::post('/product_detail_replay', [App\Http\Controllers\frontend\ProductController::class, 'product_detail_replay']);
        
        // Thêm sản phẩm vào giỏ hàng ở trang chủ
        Route::post('/index_add_to_cart', [App\Http\Controllers\frontend\CartController::class, 'index_add_to_cart']);

        // Thêm sản phẩm vào giỏ hàng ở trang chi tiết
        Route::post('product_detail_add_to_cart', [App\Http\Controllers\frontend\CartController::class, 'product_detail_add_to_cart']);

        // Giỏ hàng
        Route::get('/cart', [App\Http\Controllers\frontend\CartController::class, 'cart']);

            // Thêm
            Route::post('/cart_quantity_up', [App\Http\Controllers\frontend\CartController::class, 'cart_quantity_up']);

            // Bớt
            Route::post('/cart_quantity_down', [App\Http\Controllers\frontend\CartController::class, 'cart_quantity_down']);

            // Xóa
            Route::post('/cart_quantity_delete', [App\Http\Controllers\frontend\CartController::class, 'cart_quantity_delete']);

        // Thanh toán
            Route::get('/checkout', [App\Http\Controllers\frontend\CheckoutController::class, 'checkout_form']);
            Route::post('/checkout', [App\Http\Controllers\frontend\CheckoutController::class, 'checkout']);

        // Tìm kiếm
            // Theo tên
            Route::get('/search', [App\Http\Controllers\frontend\SearchController::class, 'search']);
            Route::get('/search_result', [App\Http\Controllers\frontend\SearchController::class, 'search_result']);

            // Tìm kiếm nâng cao
            Route::get('/search_advanced', [App\Http\Controllers\frontend\SearchController::class, 'search_advanced_form']);
            Route::post('/search_advanced', [App\Http\Controllers\frontend\SearchController::class, 'search_advanced']);
            Route::get('/search_advanced_result', [App\Http\Controllers\frontend\SearchController::class, 'search_advanced_result']);

            // Tìm kiếm theo khoảng giá
            Route::post('/price_range', [App\Http\Controllers\frontend\SearchController::class, 'price_range']);

        // // Tính điểm trung bình - đã làm đồng thời trong phần đánh giá sản phẩm
        // Route::get('/product_average', [App\Http\Controllers\frontend\ProductController::class, 'product_average']);
});

// Mail test
Route::get('/mail_test', [App\Http\Controllers\MailController::class, 'mail_test']);