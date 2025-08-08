<div class="login-card animate__animated animate__fadeInUp text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Logo" class="logo-img">
    <h3>تسجيل دخول الأدمن</h3>
    <p class="text-muted small mb-4"></p>
    @include('admin.layouts.partials.validation-errors')
    <form method="POST" action="{{ route('admin.login') }}" class="text-start">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label text-black">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                required autofocus autocomplete="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text-black">كلمة المرور</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="current-password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-login btn-lg">تسجيل الدخول</button>
        </div>
    </form>
</div>
