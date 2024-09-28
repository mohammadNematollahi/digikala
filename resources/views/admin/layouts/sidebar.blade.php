<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{ route('admin.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش فروش</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>ویترین</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.showcase.banner.index') }}">بنر</a>
                    <a href="{{ route('admin.market.showcase.category.index') }}">دسته بندی</a>
                    <a href="{{ route('admin.market.showcase.property.index') }}">فرم کالا</a>
                    <a href="{{ route('admin.market.showcase.brand.index') }}">برندها</a>
                    <a href="{{ route('admin.market.showcase.product.index') }}">کالاها</a>
                    <a href="{{ route('admin.market.showcase.store.index') }}">انبار</a>
                    <a href="{{ route('admin.market.showcase.comment.index') }}">نظرات</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>سفارشات</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.order.newOrders') }}"> جدید</a>
                    <a href="{{ route('admin.market.order.sending') }}">در حال ارسال</a>
                    <a href="{{ route('admin.market.order.unpaid') }}">پرداخت نشده</a>
                    <a href="{{ route('admin.market.order.canceled') }}">باطل شده</a>
                    <a href="{{ route('admin.market.order.returned') }}">مرجوعی</a>
                    <a href="{{ route('admin.market.order.allOrders') }}">تمام سفارشات</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>پرداخت ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.payment.allPayments') }}">تمام پرداخت ها</a>
                    <a href="{{ route('admin.market.payment.onlinePayments') }}">پرداخت های آنلاین</a>
                    <a href="{{ route('admin.market.payment.offlinePayments') }}">پرداخت های آفلاین</a>
                    <a href="{{ route('admin.market.payment.onSidePayments') }}">پرداخت در محل</a>
                </section>
            </section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>تخفیف ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.discount.copan.index') }}">کپن تخفیف</a>
                    <a href="{{ route('admin.market.discount.common.index') }}">تخفیف عمومی</a>
                    <a href="{{ route('admin.market.discount.amazing-sale.index') }}">فروش شگفت انگیز</a>
                </section>
            </section>

            <a href="{{ route('admin.market.delivery.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>روش های ارسال</span>
            </a>



            <section class="sidebar-part-title">بخش محتوی</section>
            <a href="{{ route('admin.content.category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>دسته بندی</span>
            </a>
            <a href="{{ route('admin.content.article.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>پست ها</span>
            </a>
            <a href="{{ route('admin.content.comment.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>نظرات</span>
            </a>
            <a href="{{ route('admin.content.menu.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>منو</span>
            </a>
            <a href="{{ route('admin.content.faq.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>سوالات متداول</span>
            </a>
            <a href="{{ route('admin.content.page.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>پیج ساز</span>
            </a>



            <section class="sidebar-part-title">بخش کاربران</section>
            <a href="{{ route('admin.user.customer.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>مشتریان</span>
            </a>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>سطوح دسترسی ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.user.admin-user.index') }}">کاربران ادمین</a>
                    <a href="{{ route('admin.user.role.index') }}">نقش ها</a>
                    <a href="{{ route('admin.user.permissions.index') }}">سطوح دسترسی</a>
                </section>
            </section>

            <section class="sidebar-part-title">تیکت ها</section>
            <a href="{{ route('admin.ticket.category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>دسته بندی تیک ها</span>
            </a>
            <a href="{{ route('admin.ticket.priority.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>اولویت تیک ها</span>
            </a>
            <a href="{{ route('admin.ticket.admin.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>ادمین های قابل پاسخگو</span>
            </a>
            <a href="{{ route('admin.ticket.new-tickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های جدید</span>
            </a>
            <a href="{{ route('admin.ticket.open-tickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های باز</span>
            </a>
            <a href="{{ route('admin.ticket.close-tickets') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تیکت های بسته</span>
            </a>



            <section class="sidebar-part-title">اطلاع رسانی</section>
            <a href="{{ route('admin.notify.email.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>اعلامیه ایمیلی</span>
            </a>
            <a href="{{ route('admin.notify.sms.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>اعلامیه پیامکی</span>
            </a>



            <section class="sidebar-part-title">تنظیمات</section>
            <a href="{{ route('admin.setting.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>تنظیمات</span>
            </a>

        </section>
    </section>
</aside>
