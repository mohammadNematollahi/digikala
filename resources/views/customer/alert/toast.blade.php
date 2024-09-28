<div id="toast-container" style="position: fixed; bottom: 10px; right: 10px; z-index: 1000;">
    <div class="toast show" id="login-toast" style="display: none">
        <div class="toast-header">
            <strong class="me-auto">فروشگاه</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>برای افزودن به علاقه مندی ها و حس کاربری بهتر ثبت نام کنید</p>
            <a href="{{ route('customer.login-register') }}" class="link-info">ثبت نام</a>
        </div>
    </div>
</div>


@if (session('notLogin'))
    <div id="toast-container" style="position: fixed; bottom: 10px; right: 10px; z-index: 1000;">
        <div class="toast show">
            <div class="toast-header">
                <strong class="me-auto">فروشگاه</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                <p>{{ session('notLogin') }}</p>
                <a href="{{ route('customer.login-register') }}" class="link-info">ثبت نام</a>
            </div>
        </div>
    </div>
@endif