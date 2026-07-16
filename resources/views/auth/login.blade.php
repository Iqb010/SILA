<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SILA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #10b981;
            --accent2: #3b82f6;
            --accent-glow: rgba(16,185,129,0.35);
        }

        [data-theme="dark"] {
            --bg: #0a0a1a;
            --card-bg: rgba(20,20,40,0.55);
            --card-border: rgba(255,255,255,0.08);
            --text: #e2e8f0;
            --text-muted: #64748b;
            --input-bg: rgba(255,255,255,0.05);
            --input-border: rgba(255,255,255,0.08);
        }

        [data-theme="light"] {
            --bg: #eef2f7;
            --card-bg: rgba(255,255,255,0.6);
            --card-border: rgba(255,255,255,0.5);
            --text: #1a1a2e;
            --text-muted: #64748b;
            --input-bg: rgba(255,255,255,0.5);
            --input-border: rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', -apple-system, system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            color: var(--text);
            overflow: hidden;
            transition: background 0.5s ease, color 0.5s ease;
            -webkit-font-smoothing: antialiased;
        }

        #bgCanvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 1rem;
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.15);
            overflow: hidden;
            animation: cardAppear 0.8s cubic-bezier(.4,0,.2,1) both;
        }

        [data-theme="dark"] .login-card {
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .login-header {
            padding: 2.5rem 2rem 1.5rem;
            text-align: center;
        }

        .logo-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 30px var(--accent-glow);
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); box-shadow: 0 8px 30px var(--accent-glow); }
            50% { transform: translateY(-6px); box-shadow: 0 15px 40px var(--accent-glow); }
        }

        .login-header h2 {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 2px;
            margin-bottom: 0.25rem;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.82rem;
            font-weight: 400;
        }

        .login-body { padding: 0 2rem 2.5rem; }

        .login-alert {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.15);
            border-radius: 12px;
            padding: 0.65rem 1rem;
            font-size: 0.82rem;
            color: #ef4444;
            margin-bottom: 1.25rem;
            animation: shakeX 0.5s ease;
        }

        @keyframes shakeX {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        .form-group { margin-bottom: 1.15rem; position: relative; }

        .form-group label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
            display: block;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-muted);
            font-size: 0.95rem;
            transition: color 0.3s ease;
            z-index: 2;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.6rem;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            font-size: 0.88rem;
            color: var(--text);
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            outline: none;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .input-wrapper input:focus ~ .input-icon { color: var(--accent); }

        .input-wrapper input::placeholder { color: var(--text-muted); }

        .password-field {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .password-field input {
            width: 100%;
            padding: 0.7rem 3rem 0.7rem 2.6rem;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            font-size: 0.88rem;
            color: var(--text);
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            outline: none;
            font-family: inherit;
        }

        .password-field input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .password-field input:focus ~ .input-icon { color: var(--accent); }

        .password-field input::placeholder { color: var(--text-muted); }

        .password-field .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-muted);
            font-size: 0.95rem;
            transition: color 0.3s ease;
            z-index: 2;
            pointer-events: none;
        }

        .password-toggle-btn {
            position: absolute;
            right: 4px;
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            z-index: 3;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .password-toggle-btn:hover {
            color: var(--accent);
            background: rgba(16,185,129,0.08);
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-row .form-check-input {
            background-color: var(--input-bg);
            border-color: var(--input-border);
        }

        .remember-row .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .remember-row .form-check-label {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--accent), #059669);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px var(--accent-glow);
        }

        .btn-login:hover::after { opacity: 1; }
        .btn-login:active { transform: translateY(0) scale(0.98); }

        .theme-btn {
            position: fixed;
            top: 1.25rem; right: 1.25rem;
            width: 44px; height: 44px;
            border-radius: 14px;
            border: 1px solid var(--card-border);
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            color: var(--text);
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(.4,0,.2,1);
        }

        .theme-btn:hover {
            transform: rotate(30deg) scale(1.1);
            border-color: var(--accent);
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .theme-btn .icon-sun,
        .theme-btn .icon-moon { position: absolute; transition: all 0.4s ease; }

        [data-theme="light"] .theme-btn .icon-moon { opacity: 0; transform: rotate(-90deg) scale(0); }
        [data-theme="light"] .theme-btn .icon-sun { opacity: 1; transform: rotate(0) scale(1); }
        [data-theme="dark"] .theme-btn .icon-sun { opacity: 0; transform: rotate(90deg) scale(0); }
        [data-theme="dark"] .theme-btn .icon-moon { opacity: 1; transform: rotate(0) scale(1); }

        .login-footer {
            text-align: center;
            padding: 0 2rem 1.5rem;
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        @media (max-width: 480px) {
            .login-wrapper { max-width: 100%; }
            .login-header { padding: 2rem 1.5rem 1rem; }
            .login-body { padding: 0 1.5rem 2rem; }
        }
    </style>
</head>
<body>
    <canvas id="bgCanvas"></canvas>

    <button class="theme-btn" id="themeToggle">
        <i class="bi bi-sun-fill icon-sun"></i>
        <i class="bi bi-moon-stars-fill icon-moon"></i>
    </button>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon"><i class="bi bi-heart-pulse-fill"></i></div>
                <h2>SILA</h2>
                <p>Sistem Informasi Lansia Aktif</p>
            </div>
            <div class="login-body">
                @if($errors->any())
                    <div class="login-alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email" required autofocus>
                            <i class="bi bi-envelope input-icon"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="password-field">
                            <input type="password" id="passwordInput" name="password" placeholder="Masukkan password" required>
                            <i class="bi bi-lock input-icon"></i>
                            <button type="button" class="password-toggle-btn" id="togglePassword">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="remember-row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-login">
                        Masuk <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>
            </div>
            <div class="login-footer">
                &copy; {{ date('Y') }} SILA &mdash; Posyandu Lansia
            </div>
        </div>
    </div>

    <script>
    (function() {
        const html = document.documentElement;
        let currentTheme = localStorage.getItem('sila-theme') || 'light';
        html.setAttribute('data-theme', currentTheme);

        const canvas = document.getElementById('bgCanvas');
        const ctx = canvas.getContext('2d', { alpha: false });
        let particles = [];
        let shootingStars = [];
        let reqId;

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', () => {
            resizeCanvas();
            initParticles();
        });
        resizeCanvas();

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye-slash');
            icon.classList.toggle('bi-eye');
        });

        function starShape(ctx, cx, cy, spikes, outerR, innerR) {
            let rot = Math.PI / 2 * 3;
            let step = Math.PI / spikes;
            ctx.beginPath();
            ctx.moveTo(cx, cy - outerR);
            for (let i = 0; i < spikes; i++) {
                ctx.lineTo(cx + Math.cos(rot) * outerR, cy + Math.sin(rot) * outerR);
                rot += step;
                ctx.lineTo(cx + Math.cos(rot) * innerR, cy + Math.sin(rot) * innerR);
                rot += step;
            }
            ctx.lineTo(cx, cy - outerR);
            ctx.closePath();
        }

        class FallingStar {
            constructor(isDark) {
                this.isDark = isDark;
                this.reset(true);
            }
            reset(randomY = false) {
                this.x = Math.random() * canvas.width;
                this.y = randomY ? Math.random() * canvas.height : -(Math.random() * 40);
                this.size = Math.random() * 2.5 + 1;
                this.speed = Math.random() * 0.8 + 0.2;
                this.opacity = Math.random() * 0.7 + 0.3;
                this.twinkleSpeed = Math.random() * 0.03 + 0.01;
                this.twinklePhase = Math.random() * Math.PI * 2;
                this.drift = (Math.random() - 0.5) * 0.3;
                this.rotation = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.02;
            }
            update() {
                this.y += this.speed;
                this.x += this.drift;
                this.twinklePhase += this.twinkleSpeed;
                this.rotation += this.rotationSpeed;
                if (this.y > canvas.height + 20 || this.x < -20 || this.x > canvas.width + 20) {
                    this.reset(false);
                }
            }
            draw(ctx) {
                let twinkle = 0.5 + 0.5 * Math.sin(this.twinklePhase);
                let alpha = this.opacity * twinkle;

                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.rotation);
                ctx.globalAlpha = alpha;

                if (this.isDark) {
                    let t = Math.random();
                    let r = Math.round(100 + 155 * t);
                    let g = Math.round(150 + 105 * t);
                    ctx.fillStyle = `rgb(${r},${g},255)`;

                    if (this.size > 2) {
                        ctx.shadowColor = 'rgba(100,180,255,0.6)';
                        ctx.shadowBlur = 8;
                    }

                    starShape(ctx, 0, 0, 4, this.size * 1.8, this.size * 0.7);
                    ctx.fill();
                } else {
                    let colors = ['#f59e0b', '#f97316', '#fbbf24', '#fcd34d', '#fb923c'];
                    ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];

                    if (this.size > 2) {
                        ctx.shadowColor = 'rgba(251,191,36,0.5)';
                        ctx.shadowBlur = 10;
                    }

                    starShape(ctx, 0, 0, 5, this.size * 2, this.size * 0.8);
                    ctx.fill();

                    if (this.size > 1.5) {
                        ctx.globalAlpha = alpha * 0.15;
                        ctx.beginPath();
                        ctx.arc(0, 0, this.size * 4, 0, Math.PI * 2);
                        ctx.fillStyle = '#fbbf24';
                        ctx.fill();
                    }
                }

                ctx.restore();
            }
        }

        class ShootingStar {
            constructor(isDark) {
                this.isDark = isDark;
                this.reset();
            }
            reset() {
                this.x = Math.random() * canvas.width * 1.5;
                this.y = -(Math.random() * 100);
                this.length = Math.random() * 100 + 50;
                this.speed = Math.random() * 12 + 6;
                this.opacity = 0;
                this.maxOpacity = Math.random() * 0.7 + 0.3;
                this.active = false;
                this.delay = Math.random() * 300 + 50;
                this.tailWidth = Math.random() * 2 + 1;
            }
            update() {
                if (!this.active) {
                    this.delay--;
                    if (this.delay <= 0) this.active = true;
                    return;
                }

                this.x -= this.speed;
                this.y += this.speed * 0.6;
                if (this.opacity < this.maxOpacity) this.opacity += 0.06;

                if (this.x < -150 || this.y > canvas.height + 150) {
                    this.reset();
                }
            }
            draw(ctx) {
                if (!this.active) return;

                ctx.save();
                ctx.globalAlpha = this.opacity;
                ctx.translate(this.x, this.y);

                let angle = Math.atan2(this.speed * 0.6, -this.speed);
                ctx.rotate(angle + Math.PI);

                let grad = ctx.createLinearGradient(0, 0, this.length, 0);
                if (this.isDark) {
                    grad.addColorStop(0, 'rgba(150,200,255,1)');
                    grad.addColorStop(0.15, 'rgba(200,230,255,0.9)');
                    grad.addColorStop(0.4, 'rgba(100,160,255,0.4)');
                    grad.addColorStop(1, 'rgba(60,130,255,0)');
                } else {
                    grad.addColorStop(0, 'rgba(255,220,100,1)');
                    grad.addColorStop(0.15, 'rgba(255,180,50,0.9)');
                    grad.addColorStop(0.4, 'rgba(255,150,20,0.4)');
                    grad.addColorStop(1, 'rgba(255,120,0,0)');
                }

                ctx.fillStyle = grad;
                ctx.beginPath();
                ctx.moveTo(0, -this.tailWidth);
                ctx.lineTo(this.length, -0.5);
                ctx.lineTo(this.length, 0.5);
                ctx.lineTo(0, this.tailWidth);
                ctx.closePath();
                ctx.fill();

                ctx.beginPath();
                ctx.arc(0, 0, this.tailWidth + 0.5, 0, Math.PI * 2);
                if (this.isDark) {
                    ctx.fillStyle = '#c8e0ff';
                    ctx.shadowColor = 'rgba(150,200,255,0.8)';
                } else {
                    ctx.fillStyle = '#ffe082';
                    ctx.shadowColor = 'rgba(255,200,50,0.8)';
                }
                ctx.shadowBlur = 12;
                ctx.fill();

                ctx.restore();
            }
        }

        function initParticles() {
            cancelAnimationFrame(reqId);
            particles = [];
            shootingStars = [];
            let isDark = html.getAttribute('data-theme') === 'dark';
            let count = isDark ? 100 : 60;

            for (let i = 0; i < count; i++) {
                particles.push(new FallingStar(isDark));
            }

            for (let i = 0; i < 5; i++) {
                shootingStars.push(new ShootingStar(isDark));
            }
            animate();
        }

        function animate() {
            let isDark = html.getAttribute('data-theme') === 'dark';
            ctx.fillStyle = isDark ? '#0a0a1a' : '#eef2f7';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw(ctx);
            }
            for (let i = 0; i < shootingStars.length; i++) {
                shootingStars[i].update();
                shootingStars[i].draw(ctx);
            }
            reqId = requestAnimationFrame(animate);
        }

        document.getElementById('themeToggle').addEventListener('click', function() {
            currentTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', currentTheme);
            localStorage.setItem('sila-theme', currentTheme);
            initParticles();
        });

        initParticles();
    })();
    </script>
</body>
</html>
