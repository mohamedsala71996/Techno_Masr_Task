<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'تسجيل دخول')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('styles')
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #233554 0%, #2d3a4b 100%);
            color: #23272f;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        .overlay-bg {
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.05;
            z-index: 1;
        }
    </style>
    @stack('head')
</head>
<body dir="rtl">
    <div class="overlay-bg"></div>
    @yield('content')
    @stack('scripts')
    <script>
        $(document).ready(function () {
            $('form').on('submit', function () {
                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
            document.querySelectorAll('input[type="password"]').forEach(function(input) {
                input.setAttribute('maxlength', 255);
    
                // Prevent pasting more than 255 characters
                input.addEventListener('input', function() {
                    if (this.value.length > 255) {
                        this.value = this.value.slice(0, 255);
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
    
</body>
</html>
