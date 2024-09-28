<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Notify\SMS\SMSController;
use App\Http\Controllers\Admin\User\Role\RoleController;
use App\Http\Controllers\Admin\Content\FAQ\FAQController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Content\Menu\MenuController;
use App\Http\Controllers\Admin\Content\Page\PageController;
use App\Http\Controllers\Admin\Market\Order\OrderController;
use App\Http\Controllers\Admin\Notify\Email\EmailController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Customer\Dashboard\MyOrderController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Customer\AddressAndDeliveryController;
use App\Http\Controllers\Admin\Market\Payment\PaymentController;
use App\Http\Controllers\Admin\Notify\Email\EmailFileController;
use App\Http\Controllers\Admin\User\Customer\CustomerController;
use App\Http\Controllers\Customer\Dashboard\MyAddressController;
use App\Http\Controllers\Customer\Dashboard\MyProfileController;
use App\Http\Controllers\Admin\Content\Article\ArticleController;
use App\Http\Controllers\Customer\Dashboard\MyFavoriteController;
use App\Http\Controllers\Admin\Market\Delivery\DeliveryController;
use App\Http\Controllers\Admin\User\AdminUser\AdminUserController;
use App\Http\Controllers\Admin\User\Permission\PermissionController;
use App\Http\Controllers\Admin\Market\Discount\Copan\CopanController;
use App\Http\Controllers\Admin\Market\Showcase\Brand\BrandController;
use App\Http\Controllers\Admin\Market\Showcase\Store\StoreController;
use App\Http\Controllers\Customer\SaleProcess\ShoppingCartController;
use App\Http\Controllers\Admin\Market\Discount\Common\CommonController;
// use App\Http\Controllers\Customer\SaleProcess\AddressAndDeliveryController;
use App\Http\Controllers\Admin\Market\Showcase\Banner\BannerController;
use App\Http\Controllers\Admin\Market\Showcase\Comment\CommentController;
use App\Http\Controllers\Admin\Market\Showcase\Product\ProductController;
use App\Http\Controllers\Admin\Market\Showcase\Product\WarrantyController;
use App\Http\Controllers\Customer\SaleProcess\ProfileCompletionController;
use App\Http\Controllers\Admin\Market\Showcase\Category\CategoryController;
use App\Http\Controllers\Admin\Market\Showcase\Property\PropertyController;
use App\Http\Controllers\Admin\Market\Showcase\Product\ProductMetaController;
use App\Http\Controllers\Customer\ProductController as HomeProductController;
use App\Http\Controllers\Admin\Market\Showcase\Product\ProductColorController;
use App\Http\Controllers\Admin\Market\Showcase\Product\ProductGalleryController;
use App\Http\Controllers\Admin\Market\Showcase\Property\PropertyValueController;
use App\Http\Controllers\Admin\Market\Discount\AmazingSale\AmazingSaleController;
use App\Http\Controllers\Admin\Content\Comment\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Content\Category\CategoryController as ContentCategoryController;
use App\Http\Controllers\Customer\SaleProcess\PaymentController as SaleProcessPaymentController;
use App\Http\Controllers\Customer\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix("admin")->namespace("Admin")->group(function () {

    Route::get("/", [AdminController::class, "index"])->name("admin.home");

    Route::prefix("market")->namespace("Market")->group(function () {

        Route::prefix("showcase")->namespace("Showcase")->group(function () {

            Route::prefix("category")->namespace("Category")->group(function () {
                Route::get("/", [CategoryController::class, "index"])->name("admin.market.showcase.category.index");
                Route::get("/create", [CategoryController::class, "create"])->name("admin.market.showcase.category.create");
                Route::post("/store", [CategoryController::class, "store"])->name("admin.market.showcase.category.store");
                Route::get("/edit/{category:slug}", [CategoryController::class, "edit"])->name("admin.market.showcase.category.edit");
                Route::put("/update/{category:slug}", [CategoryController::class, "update"])->name("admin.market.showcase.category.update");
            });

            Route::prefix("property")->namespace("Property")->group(function () {

                Route::get("/", [PropertyController::class, "index"])->name("admin.market.showcase.property.index");
                Route::get("/create", [PropertyController::class, "create"])->name("admin.market.showcase.property.create");
                Route::post("/store", [PropertyController::class, "store"])->name("admin.market.showcase.property.store");
                Route::get("/edit/{attribute}", [PropertyController::class, "edit"])->name("admin.market.showcase.property.edit");
                Route::put("/update/{attribute}", [PropertyController::class, "update"])->name("admin.market.showcase.property.update");


                Route::prefix("value")->namespace("PropertyValue")->group(function () {

                    Route::get("/{attribute}", [PropertyValueController::class, "index"])->name("admin.market.showcase.property.value.index");
                    Route::get("/create/{attribute}", [PropertyValueController::class, "create"])->name("admin.market.showcase.property.value.create");
                    Route::post("/store/{attribute}", [PropertyValueController::class, "store"])->name("admin.market.showcase.property.value.store");
                    Route::get("/edit/{categoryValue}", [PropertyValueController::class, "edit"])->name("admin.market.showcase.property.value.edit");
                    Route::put("/update/{categoryValue}", [PropertyValueController::class, "update"])->name("admin.market.showcase.property.value.update");
                    Route::delete("/destroy/{categoryValue}", [PropertyValueController::class, "destroy"])->name("admin.market.showcase.property.value.destroy");

                });

            });

            Route::prefix("brand")->namespace("Brand")->group(function () {
                Route::get("/", [BrandController::class, "index"])->name("admin.market.showcase.brand.index");
                Route::get("/create", [BrandController::class, "create"])->name("admin.market.showcase.brand.create");
                Route::post("/store", [BrandController::class, "store"])->name("admin.market.showcase.brand.store");
                Route::get("/edit/{brand:slug}", [BrandController::class, "edit"])->name("admin.market.showcase.brand.edit");
                Route::put("/update/{brand:slug}", [BrandController::class, "update"])->name("admin.market.showcase.brand.update");
            });

            Route::prefix("banner")->namespace("Bnner")->group(function () {
                Route::get("/", [BannerController::class, "index"])->name("admin.market.showcase.banner.index");
                Route::get("/create", [BannerController::class, "create"])->name("admin.market.showcase.banner.create");
                Route::post("/store", [BannerController::class, "store"])->name("admin.market.showcase.banner.store");
                Route::get("/edit/{banner}", [BannerController::class, "edit"])->name("admin.market.showcase.banner.edit");
                Route::put("/update/{banner}", [BannerController::class, "update"])->name("admin.market.showcase.banner.update");
            });

            Route::prefix("product")->namespace("Product")->group(function () {

                Route::get("/", [ProductController::class, "index"])->name("admin.market.showcase.product.index");
                Route::get("/create", [ProductController::class, "create"])->name("admin.market.showcase.product.create");
                Route::post("/store", [ProductController::class, "store"])->name("admin.market.showcase.product.store");
                Route::get("/edit/{product:slug}", [ProductController::class, "edit"])->name("admin.market.showcase.product.edit");
                Route::put("/update/{product:slug}", [ProductController::class, "update"])->name("admin.market.showcase.product.update");

                Route::prefix("product-meta")->namespace("ProductMeta")->group(function () {

                    Route::get("/{product:slug}", [ProductMetaController::class, "index"])->name("admin.market.showcase.product-meta.index");
                    Route::get("/create/{product:slug}", [ProductMetaController::class, "create"])->name("admin.market.showcase.product-meta.create");
                    Route::post("/store/{product:slug}", [ProductMetaController::class, "store"])->name("admin.market.showcase.product-meta.store");
                    Route::delete("/destroy/{product}/{productMeta}", [ProductMetaController::class, "destroy"])->name("admin.market.showcase.product-meta.destroy");

                });

                Route::prefix("product-color")->namespace("ProductColor")->group(function () {

                    Route::get("/{product:slug}", [ProductColorController::class, "index"])->name("admin.market.showcase.product-color.index");
                    Route::get("/create/{product:slug}", [ProductColorController::class, "create"])->name("admin.market.showcase.product-color.create");
                    Route::post("/store/{product:slug}", [ProductColorController::class, "store"])->name("admin.market.showcase.product-color.store");
                    Route::get("/edit/{product:slug}/{color}", [ProductColorController::class, "edit"])->name("admin.market.showcase.product-color.edit");
                    Route::put("/update/{product:slug}/{color}", [ProductColorController::class, "update"])->name("admin.market.showcase.product-color.update");
                    Route::delete("/destroy/{product:slug}/{color}", [ProductColorController::class, "destroy"])->name("admin.market.showcase.product-color.destroy");
                    Route::post("/status/{product:slug}/{color}", [ProductColorController::class, "status"])->name("admin.market.showcase.product-color.status");

                });

                Route::prefix("product-gallery")->namespace("ProductGallery")->group(function () {

                    Route::get("/{product:slug}", [ProductGalleryController::class, "index"])->name("admin.market.showcase.product-gallery.index");
                    Route::get("create/{product:slug}", [ProductGalleryController::class, "create"])->name("admin.market.showcase.product-gallery.create");
                    Route::post("store/{product:slug}", [ProductGalleryController::class, "store"])->name("admin.market.showcase.product-gallery.store");
                    Route::delete("destroy/{productGallery}", [ProductGalleryController::class, "destroy"])->name("admin.market.showcase.product-gallery.destroy");

                });

                Route::prefix("warranty")->namespace("Warranty")->group(function () {

                    Route::get("/{product:slug}", [WarrantyController::class, "index"])->name("admin.market.showcase.warranty.index");
                    Route::get("create/{product:slug}", [WarrantyController::class, "create"])->name("admin.market.showcase.warranty.create");
                    Route::post("store/{product:slug}", [WarrantyController::class, "store"])->name("admin.market.showcase.warranty.store");
                    Route::get("edit/{product:slug}/{warranty}", [WarrantyController::class, "edit"])->name("admin.market.showcase.warranty.edit");
                    Route::put("update/{product:slug}/{warranty}", [WarrantyController::class, "update"])->name("admin.market.showcase.warranty.update");
                    Route::delete("destroy/{product:slug}/{warranty}", [WarrantyController::class, "destroy"])->name("admin.market.showcase.warranty.destroy");

                });

            });

            Route::prefix("store")->namespace("Store")->group(function () {
                Route::get("/", [StoreController::class, "index"])->name("admin.market.showcase.store.index");
                Route::get("/create/{product:slug}", [StoreController::class, "addToStore"])->name("admin.market.showcase.store.add-to-store");
                Route::post("/store/{product:slug}", [StoreController::class, "store"])->name("admin.market.showcase.store.add-to-store.store");
                Route::get("/edit-store/{product:slug}", [StoreController::class, "editStore"])->name("admin.market.showcase.store.edit-store.editStore");
                Route::put("/update-store/{product:slug}", [StoreController::class, "updateStore"])->name("admin.market.showcase.store.edit-store.updateStore");
            });

            Route::prefix("comment")->namespace("Comment")->group(function () {
                Route::get("/", [CommentController::class, "index"])->name("admin.market.showcase.comment.index");
                Route::get("/show/{comment:id}", [CommentController::class, "show"])->name("admin.market.showcase.comment.show");
                Route::post("/response/{comment:id}", [CommentController::class, "response"])->name("admin.market.showcase.comment.response");
            });

        });

        Route::prefix("order")->namespace("Order")->group(function () {

            Route::get("/", [OrderController::class, "allOrders"])->name("admin.market.order.allOrders");
            Route::get("new-order", [OrderController::class, "newOrders"])->name("admin.market.order.newOrders");
            Route::get("sending", [OrderController::class, "sending"])->name("admin.market.order.sending");
            Route::get("unpaid", [OrderController::class, "sending"])->name("admin.market.order.unpaid");
            Route::get("canceled", [OrderController::class, "sending"])->name("admin.market.order.canceled");
            Route::get("returned", [OrderController::class, "sending"])->name("admin.market.order.returned");
            Route::get("/show/{order}", [OrderController::class, "show"])->name("admin.market.order.show");
            Route::get("/detail/{order}", [OrderController::class, "detail"])->name("admin.market.order.detail");

        });

        Route::prefix("payment")->namespace("Payment")->group(function () {

            Route::get("/", [PaymentController::class, "allPayments"])->name("admin.market.payment.allPayments");
            Route::get("online-payment", [PaymentController::class, "onlinePayments"])->name("admin.market.payment.onlinePayments");
            Route::get("offline-payment", [PaymentController::class, "offlinePayments"])->name("admin.market.payment.offlinePayments");
            Route::get("on-side-payment", [PaymentController::class, "onSidePayments"])->name("admin.market.payment.onSidePayments");
            Route::get("show/{payment}", [PaymentController::class, "show"])->name("admin.market.payment.show");

        });

        Route::prefix("discount")->namespace("Discount")->group(function () {

            Route::prefix("copan")->namespace("Copan")->group(function () {

                Route::get("/", [CopanController::class, "index"])->name("admin.market.discount.copan.index");
                Route::get("/create", [CopanController::class, "create"])->name("admin.market.discount.copan.create");
                Route::post("/store", [CopanController::class, "store"])->name("admin.market.discount.copan.store");
                Route::get("/edit/{copan}", [CopanController::class, "edit"])->name("admin.market.discount.copan.edit");
                Route::put("/update/{copan}", [CopanController::class, "update"])->name("admin.market.discount.copan.update");

            });

            Route::prefix("common")->namespace("Common")->group(function () {

                Route::get("/", [CommonController::class, "index"])->name("admin.market.discount.common.index");
                Route::get("/create", [CommonController::class, "create"])->name("admin.market.discount.common.create");
                Route::post("/store", [CommonController::class, "store"])->name("admin.market.discount.common.store");
                Route::get("/edit/{commonDiscount}", [CommonController::class, "edit"])->name("admin.market.discount.common.edit");
                Route::put("/update/{commonDiscount}", [CommonController::class, "update"])->name("admin.market.discount.common.update");

            });

            Route::prefix("amazing-sale")->namespace("AmazingSale")->group(function () {

                Route::get("/", [AmazingSaleController::class, "index"])->name("admin.market.discount.amazing-sale.index");
                Route::get("/create", [AmazingSaleController::class, "create"])->name("admin.market.discount.amazing-sale.create");
                Route::post("/store", [AmazingSaleController::class, "store"])->name("admin.market.discount.amazing-sale.store");
                Route::get("/edit/{amazingSale}", [AmazingSaleController::class, "edit"])->name("admin.market.discount.amazing-sale.edit");
                Route::put("/update/{amazingSale}", [AmazingSaleController::class, "update"])->name("admin.market.discount.amazing-sale.update");

            });

        });

        Route::prefix("delivery")->namespace("Delivery")->group(function () {

            Route::get("/", [DeliveryController::class, "index"])->name("admin.market.delivery.index");
            Route::get("/create", [DeliveryController::class, "create"])->name("admin.market.delivery.create");
            Route::post("/store", [DeliveryController::class, "store"])->name("admin.market.delivery.store");
            Route::get("/edit/{delivery}", [DeliveryController::class, "edit"])->name("admin.market.delivery.edit");
            Route::put("/update/{delivery}", [DeliveryController::class, "update"])->name("admin.market.delivery.update");

        });

    });

    Route::prefix("content")->namespace("Content")->group(function () {

        Route::prefix("category")->namespace("Category")->group(function () {

            Route::get("/", [ContentCategoryController::class, "index"])->middleware("acl:operator,show-category")->name("admin.content.category.index");
            Route::get("/create", [ContentCategoryController::class, "create"])->middleware("acl:admin")->name("admin.content.category.create");
            Route::post("/store", [ContentCategoryController::class, "store"])->name("admin.content.category.store");
            Route::get("/edit/{postCategory:slug}", [ContentCategoryController::class, "edit"])->name("admin.content.category.edit");
            Route::put("/update/{postCategory:slug}", [ContentCategoryController::class, "update"])->name("admin.content.category.update");

        });

        Route::prefix("article")->namespace("Article")->group(function () {

            Route::get("/", [ArticleController::class, "index"])->name("admin.content.article.index");
            Route::get("/create", [ArticleController::class, "create"])->name("admin.content.article.create");
            Route::post("/store", [ArticleController::class, "store"])->name("admin.content.article.store");
            Route::get("/edit/{article:slug}", [ArticleController::class, "edit"])->name("admin.content.article.edit");
            Route::put("/update/{article:slug}", [ArticleController::class, "update"])->name("admin.content.article.update");

        });

        Route::prefix("comment")->namespace("Comment")->group(function () {

            Route::get("/", [ContentCommentController::class, "index"])->name("admin.content.comment.index");
            Route::get("/show/{comment:id}", [ContentCommentController::class, "show"])->name("admin.content.comment.show");
            Route::post("/response/{comment:id}", [ContentCommentController::class, "response"])->name("admin.content.comment.response");

        });

        Route::prefix("menu")->namespace("Menu")->group(function () {

            Route::get("/", [MenuController::class, "index"])->name("admin.content.menu.index");
            Route::get("/create", [MenuController::class, "create"])->name("admin.content.menu.create");
            Route::post("/store", [MenuController::class, "store"])->name("admin.content.menu.store");
            Route::get("/edit/{menu:id}", [MenuController::class, "edit"])->name("admin.content.menu.edit");
            Route::put("/update/{menu:id}", [MenuController::class, "update"])->name("admin.content.menu.update");

        });

        Route::prefix("faq")->namespace("FAQ")->group(function () {

            Route::get("/", [FAQController::class, "index"])->name("admin.content.faq.index");
            Route::get("/create", [FAQController::class, "create"])->name("admin.content.faq.create");
            Route::post("/store", [FAQController::class, "store"])->name("admin.content.faq.store");
            Route::get("/edit/{fAQ:slug}", [FAQController::class, "edit"])->name("admin.content.faq.edit");
            Route::put("/update/{fAQ:slug}", [FAQController::class, "update"])->name("admin.content.faq.update");

        });

        Route::prefix("page")->namespace("Page")->group(function () {

            Route::get("/", [PageController::class, "index"])->name("admin.content.page.index");
            Route::get("/create", [PageController::class, "create"])->name("admin.content.page.create");
            Route::post("/store", [PageController::class, "store"])->name("admin.content.page.store");
            Route::get("/edit/{page:slug}", [PageController::class, "edit"])->name("admin.content.page.edit");
            Route::put("/update/{page:slug}", [PageController::class, "update"])->name("admin.content.page.update");

        });

    });

    Route::prefix("user")->namespace("User")->group(function () {

        Route::prefix("admin-user")->namespace("AdminUser")->group(function () {

            Route::get('/', [AdminUserController::class, 'index'])->name("admin.user.admin-user.index");
            Route::get('/create', [AdminUserController::class, 'create'])->name("admin.user.admin-user.create");
            Route::post('/store', [AdminUserController::class, 'store'])->name("admin.user.admin-user.store");
            Route::get('/edit/{user:id}', [AdminUserController::class, 'edit'])->name("admin.user.admin-user.edit");
            Route::put('/update/{user:id}', [AdminUserController::class, 'update'])->name("admin.user.admin-user.update");
            Route::get('/role-user/{user:id}', [AdminUserController::class, 'roleUser'])->name("admin.user.admin-user.role-user");
            Route::post('/role-user/{user:id}/store', [AdminUserController::class, 'roleUserStore'])->name("admin.user.admin-user.role-user.store");
            Route::get('/permission-user/{user:id}', [AdminUserController::class, 'permissionUser'])->name("admin.user.admin-user.permission-user");
            Route::post('/permission-user/{user:id}/store', [AdminUserController::class, 'permissionUserStore'])->name("admin.user.admin-user.permission-user.store");

        });

        Route::prefix("customer")->namespace("Customer")->group(function () {

            Route::get('/', [CustomerController::class, 'index'])->name("admin.user.customer.index");
            Route::get('/create', [CustomerController::class, 'create'])->name("admin.user.customer.create");
            Route::post('/store', [CustomerController::class, 'store'])->name("admin.user.customer.store");
            Route::get('/edit', [CustomerController::class, 'edit'])->name("admin.user.customer.edit");
            Route::put('/update', [CustomerController::class, 'update'])->name("admin.user.customer.update");

        });

        Route::prefix("role")->namespace("Role")->group(function () {

            Route::get('/', [RoleController::class, 'index'])->name("admin.user.role.index");
            Route::get('/create', [RoleController::class, 'create'])->name("admin.user.role.create");
            Route::post('/store', [RoleController::class, 'store'])->name("admin.user.role.store");
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name("admin.user.role.edit");
            Route::put('/update/{role}', [RoleController::class, 'update'])->name("admin.user.role.update");
            Route::get('/permission-edit/{role}', [RoleController::class, 'permissionEdit'])->name("admin.user.role.permission-edit");
            Route::put('/permission-update/{role}', [RoleController::class, 'permissionUpdate'])->name("admin.user.role.permission-update");

        });

        Route::prefix("permissions")->namespace("Permission")->group(function () {

            Route::get('/', [PermissionController::class, 'index'])->name("admin.user.permissions.index");
            Route::get('/create', [PermissionController::class, 'create'])->name("admin.user.permissions.create");
            Route::post('/store', [PermissionController::class, 'store'])->name("admin.user.permissions.store");
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name("admin.user.permissions.edit");
            Route::put('/update/{permission}', [PermissionController::class, 'update'])->name("admin.user.permissions.update");

        });


    });

    Route::prefix("ticket")->namespace("Ticket")->group(function () {

        Route::prefix("category")->namespace("Category")->group(function () {

            Route::get("/", [TicketCategoryController::class, "index"])->name("admin.ticket.category.index");
            Route::get("/create", [TicketCategoryController::class, "create"])->name("admin.ticket.category.create");
            Route::post("/store", [TicketCategoryController::class, "store"])->name("admin.ticket.category.store");
            Route::get("/edit/{ticketCategory}", [TicketCategoryController::class, "edit"])->name("admin.ticket.category.edit");
            Route::put("/update/{ticketCategory}", [TicketCategoryController::class, "update"])->name("admin.ticket.category.update");

        });

        Route::prefix("priority")->namespace("Priority")->group(function () {

            Route::get("/", [TicketPriorityController::class, "index"])->name("admin.ticket.priority.index");
            Route::get("/create", [TicketPriorityController::class, "create"])->name("admin.ticket.priority.create");
            Route::post("/store", [TicketPriorityController::class, "store"])->name("admin.ticket.priority.store");
            Route::get("/edit/{ticketPriority}", [TicketPriorityController::class, "edit"])->name("admin.ticket.priority.edit");
            Route::put("/update/{ticketPriority}", [TicketPriorityController::class, "update"])->name("admin.ticket.priority.update");

        });

        Route::prefix("admin")->namespace("Admin")->group(function () {

            Route::get("/", [TicketAdminController::class, "index"])->name("admin.ticket.admin.index");

        });

        Route::get("/show/{ticket}", [TicketController::class, "show"])->name("admin.ticket.show");
        Route::post("/response/{ticket}", [TicketController::class, "response"])->name("admin.ticket.response");
        Route::get("/new-tickets", [TicketController::class, "newTickets"])->name("admin.ticket.new-tickets");
        Route::get("/open-tickets", [TicketController::class, "openTickets"])->name("admin.ticket.open-tickets");
        Route::get("/close-tickets", [TicketController::class, "closeTickets"])->name("admin.ticket.close-tickets");

    });

    Route::prefix("notify")->namespace("Notify")->group(function () {

        Route::prefix("email")->namespace("Email")->group(function () {

            Route::get("/", [EmailController::class, "index"])->name("admin.notify.email.index");
            Route::get("/create", [EmailController::class, "create"])->name("admin.notify.email.create");
            Route::post("/store", [EmailController::class, "store"])->name("admin.notify.email.store");
            Route::get("/edit/{email:id}", [EmailController::class, "edit"])->name("admin.notify.email.edit");
            Route::put("/update/{email:id}", [EmailController::class, "update"])->name("admin.notify.email.update");

            Route::prefix("all-files")->namespace("EmailFile")->group(function () {
                Route::get("/{email:id}", [EmailFileController::class, "index"])->name("admin.notify.email.all-files.index");
                Route::get("/create/{email:id}", [EmailFileController::class, "create"])->name("admin.notify.email.all-files.create");
                Route::post("/store/{email:id}", [EmailFileController::class, "store"])->name("admin.notify.email.all-files.store");
                Route::get("/edit/{email:id}/{file:id}", [EmailFileController::class, "edit"])->name("admin.notify.email.all-files.edit");
                Route::put("/update/{email:id}/{file:id}", [EmailFileController::class, "update"])->name("admin.notify.email.all-files.update");
            });

        });

        Route::prefix("sms")->namespace("SMS")->group(function () {

            Route::get("/", [SMSController::class, "index"])->name("admin.notify.sms.index");
            Route::get("/create", [SMSController::class, "create"])->name("admin.notify.sms.create");
            Route::post("/store", [SMSController::class, "store"])->name("admin.notify.sms.store");
            Route::get("/edit/{SMS:id}", [SMSController::class, "edit"])->name("admin.notify.sms.edit");
            Route::put("/update/{SMS:id}", [SMSController::class, "update"])->name("admin.notify.sms.update");

        });

    });

    Route::prefix("setting")->namespace("Setting")->group(function () {

        Route::get("/", [SettingController::class, "index"])->name("admin.setting.index");

    });

});


/*
|--------------------------------------------------------------------------
|  HOME Routes
|--------------------------------------------------------------------------
*/




Route::get('/', [HomeController::class, "home"])->name("customer.home");
Route::get('/search/{category:slug?}', [SearchController::class, "search"])->name("customer.search");
Route::get('/ajax-search', [SearchController::class, "ajaxSearch"])->name("customer.ajax.search");

Route::prefix("product")->group(function () {

    Route::get('/{product:slug}', [HomeProductController::class, "show"])->name("customer.product.show");
    Route::post('/add-comment/{product}', [HomeProductController::class, "addComment"])->name("customer.product.add-comment");
    Route::get('/change-status-favorite/{product}', [HomeProductController::class, "addToFavorite"])->name("customer.product.change-status-favorite");
    Route::get('/{product:slug}', [HomeProductController::class, "show"])->name("customer.product.show");

});

Route::prefix("address-delivery")->middleware("profile.completion")->group(function () {

    Route::get('/', [AddressAndDeliveryController::class, "setAddressAndDelivery"])->name("customer.address-delivery");
    Route::post('/add-address', [AddressAndDeliveryController::class, "addAddress"])->name("customer.address-delivery.add.address");

    Route::get('/edit-address/{address}', [AddressAndDeliveryController::class, "editAddress"])->name("customer.address-delivery.edit.address");

    Route::put('/update-address/{address}', [AddressAndDeliveryController::class, "updateAddress"])->name("customer.address-delivery.update.address");
    Route::get('/set-city/{province}', [AddressAndDeliveryController::class, "getCity"])->name("customer.address-delivery.set-city");
    Route::post('/add-order', [AddressAndDeliveryController::class, "addToOrder"])->name("customer.address-delivery.addToOrder");

});

Route::
        namespace("SaleProcess")->middleware('auth')->group(function () {

            Route::prefix("cart")->group(function () {

                Route::get('/', [ShoppingCartController::class, "cart"])->name("customer.shopping.cart");
                Route::post('/add-to-cart/{product}', [ShoppingCartController::class, "addToCart"])->name("customer.shopping.cart.add-to-cart");
                Route::put('/update-carts', [ShoppingCartController::class, "updateCarts"])->name("customer.shopping.cart.update-carts");
                Route::delete('/destory/{cart}', [ShoppingCartController::class, "destory"])->name("customer.shopping.cart.destory");

            });

            Route::prefix("sale-process")->group(function () {

                Route::prefix("profile-completion")->group(function () {

                    Route::get('/', [ProfileCompletionController::class, "profileCompletion"])->name("customer.sale-process.profile-completion");
                    Route::put('/profile-update', [ProfileCompletionController::class, "profileUpdate"])->name("customer.sale-process.profile-completion.update");

                });
        
                Route::prefix("payment")->namespace("Payment")->group(function () {

                    Route::get('/', [SaleProcessPaymentController::class, "payment"])->name("customer.sale-process.payment");
                    Route::post('/check-copan', [SaleProcessPaymentController::class, "checkCopan"])->name("customer.sale-process.payment.check-copan");
                    Route::post('/buy', [SaleProcessPaymentController::class, "buy"])->name("customer.sale-process.payment.buy");
                    Route::get('/call-back', [SaleProcessPaymentController::class, "paymentCallBack"])->name("payment.call-back");

                });

            });


        });


/*
|--------------------------------------------------------------------------
|   PROFILE
|--------------------------------------------------------------------------
*/


Route::prefix("dashboard")->middleware("auth")->group(function () {


    Route::get("my-orders", [MyOrderController::class, "myOrders"])->name("profile.my-orders");
    Route::get("my-addresses", [MyAddressController::class, "myAddress"])->name("profile.my-addresses");
    Route::get("my-favorites", [MyFavoriteController::class, "myFavorite"])->name("profile.my-favorites");
    
    Route::prefix("my-profile")->group(function(){

        Route::get("/", [MyProfileController::class, "myProfile"])->name("profile.my-profile");
        Route::get("/edit", [MyProfileController::class, "editProfile"])->name("profile.my-profile.edit");
        Route::put("/update", [MyProfileController::class, "updateProfile"])->name("profile.my-profile.update");

    });

});





/*
|--------------------------------------------------------------------------
|  LOGIN Routes
|--------------------------------------------------------------------------
*/

Route::get("/login-register", [CustomerAuthController::class, "loginRegister"])->name("customer.login-register");
Route::post("/login-register/create", [CustomerAuthController::class, "createOTPLoingRegister"])->name("customer.create.otp.login-register");
Route::get("/login-register/code/{token:token}", [CustomerAuthController::class, "sendCode"])->name("customer.send.code.login-register");
Route::post("/login-register/check-code", [CustomerAuthController::class, "checkCode"])->name("customer.check.code.login-register");
Route::get("/login-register/new-code/{token}", [CustomerAuthController::class, "newCode"])->name("customer.new.code.login-register");
Route::get("/logout", [CustomerAuthController::class, "logout"])->name("customer.logout");

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
