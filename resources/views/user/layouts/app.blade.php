<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechBlog')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Custom Styles -->
    @yield('styles')
    
    <style>
        body { 
            background: #f6f8fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .user-navbar { 
            background: #fff; 
            border-bottom: 1px solid #eee; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
        }
        .nav-link {
            color: #495057 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #667eea !important;
        }
        .btn-link {
            color: #dc3545 !important;
            text-decoration: none;
        }
        .btn-link:hover {
            color: #c82333 !important;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('user.layouts.partials.header')

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('user.layouts.partials.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    <!-- Custom Scripts -->
    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set maxlength attribute for all text inputs
            document.querySelectorAll('input[type="text"]').forEach(function(input) {
                input.setAttribute('maxlength', 255);
    
                // Prevent pasting more than 255 characters
                input.addEventListener('input', function() {
                    if (this.value.length > 255) {
                        this.value = this.value.slice(0, 255);
                    }
    
                     // Prevent very long words
                    const words = this.value.split(/\s+/);
                    for (let word of words) {
                        if (word.length > 50) {
                            this.value = this.value.replace(word, word.slice(0, 50));
                        }
                    }
    
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[type="email"]').forEach(function(input) {
                input.setAttribute('maxlength', 254);
    
                input.addEventListener('input', function() {
                    if (this.value.length > 254) {
                        this.value = this.value.slice(0, 254);
                    }
    
                     // Prevent very long words
                    const words = this.value.split(/\s+/);
                    for (let word of words) {
                        if (word.length > 50) {
                            this.value = this.value.replace(word, word.slice(0, 50));
                        }
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set maxlength attribute for all text inputs
            document.querySelectorAll('textarea').forEach(function(input) {
                input.setAttribute('maxlength', 10000);
    
                // Prevent pasting more than 255 characters
                input.addEventListener('input', function() {
                    if (this.value.length > 10000) {
                        this.value = this.value.slice(0, 10000);
                    }
    
                    // Prevent very long words
                    const words = this.value.split(/\s+/);
                    for (let word of words) {
                        if (word.length > 50) {
                            this.value = this.value.replace(word, word.slice(0, 50));
                        }
                    }
                });
            });
        });
    </script>
    <script>
        function restrictNumberInputsTo18Digits() {
            document.querySelectorAll('input[type="number"]').forEach(function(input) {
                input.addEventListener('input', function() {
                    // Remove non-digit characters and limit to 15 digits
                    let digits = this.value.replace(/\D/g, '').slice(0, 18);
                    this.value = digits;
                });
            });
        }
    
        document.addEventListener('DOMContentLoaded', function () {
            restrictNumberInputsTo18Digits();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('form').on('submit', function () {
                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);
                setTimeout(function() {
                    submitButton.prop('disabled', false);
                }, 2000);
            });
        });
    </script>
</body>
</html>
