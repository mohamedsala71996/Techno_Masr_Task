<style>
    .user-footer {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-top: 4rem;
    }
    
    .user-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        pointer-events: none;
    }
    
    .user-footer .container {
        position: relative;
        z-index: 2;
    }
    
    .user-footer .footer-brand {
        color: #fff;
        font-weight: 800;
        font-size: 1.5rem;
        letter-spacing: 1.5px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .user-footer .footer-brand i {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.8rem;
    }
    
    .user-footer .footer-description {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    

    
    .user-footer .footer-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #fff 0%, rgba(255,255,255,0.5) 100%);
        border-radius: 2px;
    }
    
    .user-footer .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .user-footer .footer-links li {
        margin-bottom: 0.75rem;
    }
    
    .user-footer .footer-links a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .user-footer .footer-links a:hover {
        color: #fff;
        transform: translateX(-5px);
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .user-footer .footer-links a i {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .user-footer .footer-divider {
        border-color: rgba(255, 255, 255, 0.2);
        margin: 2rem 0;
    }
    
    .user-footer .footer-bottom {
        text-align: center;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .user-footer .footer-bottom p {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 0.95rem;
    }
    
    @media (max-width: 768px) {
        .user-footer {
            text-align: center;
        }
        
        .user-footer .footer-section-title::after {
            left: 50%;
            transform: translateX(-50%);
        }
    }
</style>

<footer class="user-footer ">
    <div class="container ">
        <div class="row ">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <i class="fas fa-code"></i>
                    <span>TechBlog</span>
                </div>
                <p class="footer-description">
                    منصة تقنية متخصصة لمشاركة المعرفة والخبرات في عالم التكنولوجيا والبرمجة. 
                    نهدف إلى بناء مجتمع تقني نشط ومتطور.
                </p>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="footer-section-title">روابط سريعة</h6>
                <ul class="footer-links">
                    <li>
                        <a href="{{ route('user.home') }}">
                            <i class="fas fa-home"></i>
                            الرئيسية
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('user.posts.create') }}">
                                <i class="fas fa-plus"></i>
                                إضافة منشور
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.profile') }}">
                                <i class="fas fa-user"></i>
                                حسابي
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                تسجيل الدخول
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                تسجيل جديد
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <h6 class="footer-section-title">تواصل معنا</h6>
                <ul class="footer-links">
                    <li>
                        <a href="mailto:info@TechBlog.com">
                            <i class="fas fa-envelope"></i>
                            info@TechBlog.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        {{-- <hr class="footer-divider"> --}}
        
        <div class="footer-bottom">
            <p>
                &copy; {{ date('Y') }} TechBlog. جميع الحقوق محفوظة.
            </p>
        </div>
    </div>
</footer>
