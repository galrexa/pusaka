<!-- login.php - SIMPLIFIED CLEAN VERSION -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PUSAKA</title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendors/fontawesome/css/all.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
    <script src="<?=base_url('assets/js/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <?php if($status=="true"){?>
        <script src="<?=base_url()?>/assets/js/app.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php } ?>
    
</head>
<body>
    <canvas id="canvas"></canvas>
    
    <div class="login-container-split">
        <div class="login-wrapper-split">
            
            <!-- LEFT SIDE: Form Login (40%) -->
            <div class="login-form-side">
                <div class="login-card-split">
                    <!-- Logo & Header -->
                    <div class="login-header-split">
                        <div class="logo-container-split">
                            <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo PUSAKA">
                        </div>
                        <h1 class="login-title-split">PUSAKA</h1>
                        <p class="login-subtitle-split">Login untuk mengakses aplikasi</p>
                    </div>

                    <!-- Form Section -->
                    <div class="login-form-content">
                        <?php if(session()->get('message')){?>
                            <div class="alert alert-danger alert-modern" id="flashdata_message">
                                <i class="fa fa-exclamation-circle me-2"></i><?=session()->get('message')?>
                            </div>
                        <?php }?>

                        <?=form_open('', ['id'=>'form_login'])?>
                            <!-- Username Input -->
                            <div class="modern-form-group">
                                <label class="modern-label">Username atau Email</label>
                                <div class="input-group-modern">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" class="modern-input with-icon" name="username" id="username" placeholder="Masukkan username atau email" required>
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="modern-form-group">
                                <label class="modern-label">Password</label>
                                <div class="input-group-modern password-input-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" class="modern-input with-icon with-toggle" name="password" id="password" placeholder="Masukkan password" required>
                                    <span class="password-toggle" onclick="show_hide_password()">
                                        <i class="fa fa-eye" id="addon-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <!-- Captcha -->
                            <?php if($status=="true"){?>
                                <div class="modern-form-group">
                                    <div class="g-recaptcha" data-sitekey="<?=$sitekey?>"></div>
                                </div>
                            <?php } ?>

                            <!-- Login Button -->
                            <button type="submit" class="btn-login-split">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Masuk
                            </button>
                        <?=form_close()?>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="login-copyright">
                    <i class="fas fa-copyright me-1"></i> 2025 Sekretariat Bappisus
                </div>
            </div>

            <!-- RIGHT SIDE: Illustration (60%) -->
            <div class="login-illustration-side">
                <div class="illustration-content">
                    <!-- Animated Icon Placeholder -->
                    <div class="illustration-icon-group">
                        <div class="icon-item icon-1">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="icon-item icon-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="icon-item icon-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="icon-item icon-4">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="icon-item icon-5">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="icon-item icon-6">
                            <i class="fas fa-folder-open"></i>
                        </div>
                    </div>

                    <!-- Simple Text -->
                    <div class="illustration-text-simple">
                        <h2>PUSAKA</h2>
                        <p>Pusat Aplikasi Kesekretariatan</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        // Flash Message Auto Hide
        $(function(){
            $("#flashdata_message").fadeTo(5000, 500).slideUp(500, function(){
                $("#flashdata_message").slideUp(500);
            });
        });

        // Show/Hide Password
        function show_hide_password() {
            var addon_eye = $('#addon-eye').attr('class');
            if(addon_eye == 'fa fa-eye') {
                $('#addon-eye').prop('class', 'fa fa-eye-slash');
                $('#password').prop('type', 'text');
            } else {
                $('#addon-eye').prop('class', 'fa fa-eye');
                $('#password').prop('type', 'password');
            }
        }

        // Form Submit
        $('#form_login').on('submit', function(e) {
            $('.btn-login-split').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
            let data = $(this);
            e.preventDefault();
            $.ajax({
                crossDomain: true,
                crossOrigin: true,
                dataType: 'json',
                type: "POST",
                data: data.serialize(),
                headers: {
                    "Key": "<?=$api_key?>",
                },
                success: function(responseData, textStatus, jqXHR) {
                    var dt = responseData;
                    if(dt.status == 1) {
                        if(dt.data.options && dt.data.options.toptp == 1) {
                            window.location.assign('<?=site_url('auth/otp')?>');
                        } else {
                            window.location.assign('<?=base_url()?>');
                        }
                    } else {
                        alert(dt.message.replace(/<p>|<\/p>/g, ""));
                    }
                    $('.btn-login-split').prop('disabled', false).html('<i class="fas fa-sign-in-alt me-2"></i>Masuk');
                    $('input[name=<?=csrf_token()?>]').val(dt.csrf);
                }
            });
        });

        // Page Load Animation
        window.addEventListener('load', function() {
            const formSide = document.querySelector('.login-form-side');
            const illustrationSide = document.querySelector('.login-illustration-side');
            
            formSide.style.opacity = '0';
            formSide.style.transform = 'translateX(-50px)';
            illustrationSide.style.opacity = '0';
            illustrationSide.style.transform = 'translateX(50px)';
            
            setTimeout(() => {
                formSide.style.transition = 'all 0.8s ease';
                illustrationSide.style.transition = 'all 0.8s ease';
                formSide.style.opacity = '1';
                formSide.style.transform = 'translateX(0)';
                illustrationSide.style.opacity = '1';
                illustrationSide.style.transform = 'translateX(0)';
            }, 100);
        });

        // CANVAS BACKGROUND ANIMATION
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        
        let mouse = {
            x: undefined,
            y: undefined,
            radius: 100
        };

        canvas.addEventListener('mousemove', (event) => {
            mouse.x = event.clientX;
            mouse.y = event.clientY;
        });

        canvas.addEventListener('mouseleave', () => {
            mouse.x = undefined;
            mouse.y = undefined;
        });

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.baseX = this.x;
                this.baseY = this.y;
                this.radius = Math.random() * 2 + 0.5;
                this.alpha = Math.random() * 0.3 + 0.1;
                this.vx = (Math.random() - 0.5) * 0.5;
                this.vy = (Math.random() - 0.5) * 0.5;
            }

            update() {
                if (mouse.x !== undefined && mouse.y !== undefined) {
                    const dx = mouse.x - this.x;
                    const dy = mouse.y - this.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    
                    if (distance < mouse.radius) {
                        const force = (mouse.radius - distance) / mouse.radius;
                        const angle = Math.atan2(dy, dx);
                        this.vx -= Math.cos(angle) * force * 0.5;
                        this.vy -= Math.sin(angle) * force * 0.5;
                    }
                }
                
                this.x += this.vx;
                this.y += this.vy;
                this.vx *= 0.95;
                this.vy *= 0.95;
                
                const dx = this.baseX - this.x;
                const dy = this.baseY - this.y;
                this.x += dx * 0.05;
                this.y += dy * 0.05;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${this.alpha})`;
                ctx.fill();
            }
        }

        const particles = [];
        const numParticles = 80;

        for (let i = 0; i < numParticles; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });

            requestAnimationFrame(animate);
        }

        animate();
    </script>
</body>
</html>
