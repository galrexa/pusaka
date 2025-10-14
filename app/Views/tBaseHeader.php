<!-- tBaseHeader.php - REFACTORED dengan Admin Menu di User Profile Dropdown -->
<header class="navbar navbar-expand-lg navbar-dark sticky-top modern-header">
  <div class="container-fluid">
    <!-- Sidebar Toggle Button - HANYA TAMPIL DI MOBILE -->
    <button class="sidebar-toggle-btn d-lg-none" id="sidebarToggle" type="button">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Brand Logo -->
    <a class="modern-brand" href="<?=base_url()?>">
      <div class="brand-logo-container">
        <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo" style="max-width: 100%; height: auto;">
      </div>
      <span class="brand-text"><?=APP_NAME?></span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Menu - KOSONG (Admin menu sudah dipindah ke user profile) -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Bisa tambahkan menu lain di sini jika diperlukan -->
      </ul>

      <!-- Right Menu - User Profile -->
      <?php if(session()->get('login')){?>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link modern-nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="user-avatar me-2">
                <img src="<?=session()->get('pegawai_foto')?>" alt="Profile" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;">
              </div>
              <span class="user-name d-none d-lg-inline"><?=session()->get('nama')?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end modern-dropdown-menu">
              <!-- User Menu -->
              <li>
                <a class="dropdown-item modern-dropdown-item" href="<?=site_url('kepegawaian/profile')?>">
                  <i class="fa fa-user-circle me-2"></i> Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item modern-dropdown-item" href="<?=site_url('data/pengguna/form?id='.string_to(session()->get('id'),'encode'))?>">
                  <i class="fa fa-key me-2"></i> Ubah Password
                </a>
              </li>
              <li>
                <a class="dropdown-item modern-dropdown-item" href="<?=site_url('auth/activate2fa')?>">
                  <i class="fa fa-cog me-2"></i> 2FA Setting
                </a>
              </li>

              <!-- Administrator Menu - HANYA MUNCUL JIKA PUNYA AKSES -->
              <?php if(return_access_link(['app', 'ngemail'])){?>
                <li><hr class="dropdown-divider"></li>
                <li class="modern-dropdown-header">
                  <small class="text-muted fw-bold">
                    <i class="fas fa-tools me-1"></i> Administrator Menu
                  </small>
                </li>
                <li>
                  <a class="dropdown-item modern-dropdown-item" href="<?=site_url('ngemail')?>">
                    <i class="fa fa-envelope me-2"></i> Email
                  </a>
                </li>
                <?php if(return_access_link(['app'])){?>
                  <li>
                    <a class="dropdown-item modern-dropdown-item" href="<?=site_url('app')?>">
                      <i class="fa fa-wrench me-2"></i> Konfigurasi Sistem
                    </a>
                  </li>
                <?php }?>
              <?php }?>

              <!-- Log Out -->
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item modern-dropdown-item text-danger" href="#" onclick="log_out()">
                  <i class="fa fa-sign-out-alt me-2"></i> Log Out
                </a>
              </li>
            </ul>
          </li>
        </ul>
      <?php }?>
    </div>
  </div>
</header>
