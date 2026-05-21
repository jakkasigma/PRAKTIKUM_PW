<?php
/** Theme Jakka Sigma Portfolio */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            serif: ['Playfair Display', 'ui-serif', 'Georgia', 'serif'],
          },
          colors: {
            brand: {
              bg: '#f5f2ed',
              ink: '#1a1a1a',
            }
          }
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    @layer utilities {
      .scroll-snap-align-start {
        scroll-snap-align: start;
      }
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
      }
    }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class('bg-zinc-900'); ?>>
  <?php wp_body_open(); ?>
  <main class="h-dvh md:h-screen overflow-y-auto overflow-x-hidden scroll-smooth snap-y snap-mandatory selection:bg-brand-ink selection:text-brand-bg relative no-scrollbar">
    
    <!-- Fixed Navigation Bar -->
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 md:px-8 py-6 mix-blend-difference text-white">
      <a href="#home" class="font-serif text-2xl font-bold tracking-widest uppercase relative z-[60]">JAKKA.</a>
      
      <!-- Desktop Menu -->
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'hidden md:flex gap-8 text-[10px] uppercase tracking-[0.2em] font-medium list-none',
        'fallback_cb'    => '__return_false',
      ) );
      ?>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="md:hidden flex flex-col justify-center items-end gap-[6px] w-8 h-8 z-[60] relative focus:outline-none">
        <span class="w-6 h-[1.5px] bg-white transition-all duration-300 transform"></span>
        <span class="w-4 h-[1.5px] bg-white transition-all duration-300 transform"></span>
      </button>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-neutral-900 z-40 translate-x-full transition-transform duration-500 ease-in-out flex flex-col justify-center items-center">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'flex flex-col gap-8 text-sm uppercase tracking-[0.3em] font-medium list-none text-brand-bg text-center',
        'fallback_cb'    => '__return_false',
      ) );
      ?>
    </div>

    <!-- Hero Section -->
    <div class="snap-start h-dvh md:h-screen" id="home">
      <section class="h-dvh md:h-screen w-full relative flex items-center justify-center overflow-hidden bg-zinc-900 text-white">
        <div class="absolute inset-0 bg-neutral-800">
          <?php $hero_img = get_header_image() ? get_header_image() : get_template_directory_uri() . '/aset/banner.jpg'; ?>
          <img src="<?php echo esc_url($hero_img); ?>" alt="Banner" class="w-full h-full object-cover object-center grayscale opacity-60">
        </div>
        <div class="relative z-10 text-center px-4">
          <h1 class="font-serif text-[12vw] md:text-[15vw] leading-none tracking-tighter uppercase animate-slide-up">
            portofolio
          </h1>
        </div>
        <div class="absolute bottom-8 left-6 right-6 md:bottom-12 md:left-12 md:right-12 flex justify-between items-center text-[10px] uppercase tracking-[0.3em] font-medium text-white mix-blend-difference z-20">
          <span><?php bloginfo('name'); ?></span>
          <span>Void Core</span>
        </div>
      </section>
    </div>
    
    <!-- Table of Contents -->
    <div class="snap-start min-h-screen">
      <section id="toc" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <h2 class="font-serif text-4xl md:text-7xl mb-12 md:mb-16">Table of Content</h2>
          <div class="grid md:grid-cols-2 gap-x-24 gap-y-8">
            <a href="#about" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ About Me</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">01</span>
            </a>
            <!-- ... Repeat for other items ... -->
             <a href="#project-1" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ KopiSop</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">02</span>
            </a>
            <a href="#project-2" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Smart Museum Guide</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">03</span>
            </a>
            <a href="#project-3" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Visual Journal</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">04</span>
            </a>
            <a href="#abilities" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Abilities & Services</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">05</span>
            </a>
            <a href="#contact" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Contact Information</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">06</span>
            </a>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center"></div>
          <div class="w-1/3 text-right">Void Architect</div>
        </footer>
      </section>
    </div>

    <!-- About Section -->
    <div class="snap-start min-h-screen">
      <section id="about" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div>
              <h2 class="font-serif text-4xl md:text-6xl mb-6 md:mb-8">About Me</h2>
              <div class="space-y-6 text-sm leading-relaxed max-w-md">
                <p class="font-medium italic text-lg text-neutral-800">Halo! Saya Virgi Herwan</p>
                <p>Saya mahasiswa semester 2 yang berbasis di Yogyakarta. Sebagai junior programmer, saya melihat koding bukan sekadar menyusun logika, tapi juga tentang bagaimana membangun sebuah struktur yang rapi dan bermakna.</p>
                <p>Di luar baris kode, saya juga menyukai fotografi sebagai salah satu cara saya mengekspresikan diri. Dengan memperhatikan dan mengamati lingkungan sekitar, saya mendapatkan inspirasi untuk membangun proyek-proyek yang bermanfaat. Karena bagi saya, cara pandang itulah yang memungkinkan saya menghasilkan karya, baik dalam bentuk kode maupun foto yang berkesan.</p>
                <p class="font-medium border-b border-brand-ink/10 pb-1 inline-block">Mari ciptakan sesuatu yang berkesan bersama.</p>
              </div>
            </div>
            <div class="relative aspect-[5/5] bg-neutral-200 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
              <?php $profile_img = get_theme_mod('profile_image_setting') ?: get_template_directory_uri() . '/aset/aset_porto_fotoprofile.jpg'; ?>
              <img src="<?php echo esc_url($profile_img); ?>" 
                   alt="Profile"
                   class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                   style="object-position: 30% 80%;"/>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">01</div>
          <div class="w-1/3 text-right">Programmer</div>
        </footer>
      </section>
    </div>

    <!-- Project 1 Section -->
    <div class="snap-start min-h-screen">
      <section id="project-1" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-8 md:gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-4 md:space-y-6">
              <h2 class="font-serif text-4xl md:text-6xl">KopiSop</h2>
              <div class="text-xs md:text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>Development</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">KopiSop adalah platform operasional cafe yang saya bangun untuk menyatukan workflow admin dan staf dalam satu sistem terpadu. Proyek ini mencakup dashboard admin bergaya command center, pengelolaan karyawan, jadwal, absensi, payroll, approval izin dan tukar shift, pesan internal, hingga portal staf mobile-first yang dirancang agar cepat, rapi, dan nyaman dipakai dalam operasional harian.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-2 grid-rows-2 gap-2 md:gap-4 h-[45vh] md:h-[60vh]">
                <?php 
                $p1_img1 = get_theme_mod('project1_img1_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                $p1_img2 = get_theme_mod('project1_img2_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                $p1_img3 = get_theme_mod('project1_img3_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                ?>
                <div class="item-1 bg-neutral-200 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden row-span-2 group">
                  <img src="<?php echo esc_url($p1_img1); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-2 bg-neutral-300 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden group">
                  <img src="<?php echo esc_url($p1_img2); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-3 bg-neutral-400 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden group">
                  <img src="<?php echo esc_url($p1_img3); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">02</div>
          <div class="w-1/3 text-right">Web Developer</div>
        </footer>
      </section>
    </div>

    <!-- Project 2 Section -->
    <div class="snap-start min-h-screen">
      <section id="project-2" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-8 md:gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-4 md:space-y-6">
              <h2 class="font-serif text-4xl md:text-6xl">Smart Museum Guide</h2>
              <div class="text-xs md:text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>Interactive App</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">Proyek inovatif di bidang Seni Budaya yang mengintegrasikan teknologi IoT dan Artificial Intelligence (AI) untuk mentransformasi pengalaman konvensional di museum menjadi lebih interaktif, inklusif, dan modern. Sistem ini menggantikan papan keterangan statis dengan panduan digital yang dapat diakses langsung melalui perangkat pengunjung.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-2 grid-rows-2 gap-2 md:gap-4 h-[45vh] md:h-[60vh]">
                <?php 
                $p2_img1 = get_theme_mod('project2_img1_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                $p2_img2 = get_theme_mod('project2_img2_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                $p2_img3 = get_theme_mod('project2_img3_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                ?>
                <div class="item-1 bg-neutral-200 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p2_img1); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-2 bg-neutral-300 overflow-hidden row-span-2 grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p2_img2); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-3 bg-neutral-400 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p2_img3); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">03</div>
          <div class="w-1/3 text-right">Analyst</div>
        </footer>
      </section>
    </div>

    <!-- Project 3 Section -->
    <div class="snap-start min-h-screen">
      <section id="project-3" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-8 md:gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-4 md:space-y-6">
              <h2 class="font-serif text-4xl md:text-6xl">Visual Journal</h2>
              <div class="text-xs md:text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>Photography</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">Setiap tempat punya cerita dan atmosfer yang berbeda, dan itulah yang saya tangkap di sini. Jurnal ini adalah kumpulan fragmen—baik itu sejarah sebuah ruang atau memori pribadi—yang saya temui saat mengamati lingkungan. Bagi saya, kepekaan dalam merasakan atmosfer ini adalah sumber ide yang kemudian saya tuangkan ke dalam struktur dan logika proyek digital saya.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-3 grid-rows-2 gap-2 md:gap-4 h-[45vh] md:h-[60vh]">
                <?php 
                $p3_img1 = get_theme_mod('project3_img1_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                $p3_img2 = get_theme_mod('project3_img2_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                $p3_img3 = get_theme_mod('project3_img3_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                ?>
                <div class="item-1 bg-neutral-200 overflow-hidden col-span-2 row-span-2 grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p3_img1); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-2 bg-neutral-300 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p3_img2); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
                <div class="item-3 bg-neutral-400 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
                  <img src="<?php echo esc_url($p3_img3); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">04</div>
          <div class="w-1/3 text-right">Photographer</div>
        </footer>
      </section>
    </div>

    <!-- Abilities Section -->
    <div class="snap-start min-h-screen">
      <section id="abilities" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <h2 class="font-serif text-4xl md:text-7xl mb-12 md:mb-16">Abilities</h2>
          <div class="grid md:grid-cols-12 gap-12">
            <div class="md:col-span-5 space-y-8">
              <p class="text-[10px] uppercase tracking-[0.3em] font-bold text-neutral-400">Technical Matrix</p>
              <div class="grid grid-cols-2 gap-y-4 text-sm font-medium tracking-tight">
                <div class="flex items-center gap-3"><span>■</span> HTML5 / CSS3</div>
                <div class="flex items-center gap-3"><span>■</span> JavaScript</div>
                <div class="flex items-center gap-3"><span>■</span> Python Core</div>
                <div class="flex items-center gap-3"><span>■</span> Laravel</div>
                <div class="flex items-center gap-3"><span>■</span> UI Design</div>
                <div class="flex items-center gap-3"><span>■</span> Photography</div>
              </div>
            </div>
            <div class="md:col-span-7 space-y-12">
              <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-3">
                  <h4 class="font-serif text-xl italic">Web Development</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Building structured web interfaces and functional applications like POS systems and interactive guides with clean code architecture.</p>
                </div>
                <div class="space-y-3">
                  <h4 class="font-serif text-xl italic">System Analysis</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Analyzing system requirements to create effective logic, database structures, and seamless user experiences for digital products.</p>
                </div>
                <div class="space-y-3">
                  <h4 class="font-serif text-xl italic">Photon Capture</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Processing visuals and photo compositions to evoke strong moods, visual documentation, and artistic storytelling.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">05</div>
          <div class="w-1/3 text-right">Photographer</div>
        </footer>
      </section>
    </div>

    <!-- Contact Section -->
    <div class="snap-start min-h-screen">
      <section id="contact" class="min-h-dvh md:min-h-screen w-full flex flex-col px-6 pt-28 pb-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-2 gap-8 md:gap-16 items-center">
            <div class="relative aspect-video md:aspect-square bg-neutral-200 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500 group">
              <?php $contact_img = get_theme_mod('contact_image_setting') ? get_theme_mod('contact_image_setting') : get_template_directory_uri() . '/aset/foto contact.jpg'; ?>
              <img src="<?php echo esc_url($contact_img); ?>" alt="Contact" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" style="object-position: 30% 70%;"/>
            </div>
            <div>
              <h2 class="font-serif text-4xl md:text-7xl mb-8 md:mb-12">Contact Information</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <div class="space-y-8">
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Phone</p>
                    <p class="text-sm"><?php echo esc_html(get_theme_mod('jakka_phone_setting', '+62 878 1710 9749')); ?></p>
                  </div>
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Email</p>
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('jakka_email_setting', 'virgilaki@gmail.com')); ?>" class="text-sm underline hover:text-neutral-500 transition-colors"><?php echo esc_html(get_theme_mod('jakka_email_setting', 'virgilaki@gmail.com')); ?></a>
                  </div>
                </div>
                <div class="space-y-8">
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Address</p>
                    <p class="text-sm"><?php echo esc_html(get_theme_mod('jakka_address_setting', 'Kraton, Yogyakarta')); ?></p>
                  </div>
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Socials</p>
                    <div class="flex flex-row flex-wrap gap-6 text-sm">
                      <a href="#" target="_blank" class="flex items-center gap-2 hover:text-neutral-500 transition-colors w-fit group">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span class="underline">Instagram</span>
                      </a>
                      <a href="#" target="_blank" class="flex items-center gap-2 hover:text-neutral-500 transition-colors w-fit group">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                          <rect x="2" y="9" width="4" height="12"></rect>
                          <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                        <span class="underline">LinkedIn</span>
                      </a>
                      <a href="#" target="_blank" class="flex items-center gap-2 hover:text-neutral-500 transition-colors w-fit group">
                        <svg class="w-4 h-4 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                        </svg>
                        <span class="underline">GitHub</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="w-full flex justify-between items-center text-[10px] uppercase tracking-[0.2em] font-medium pt-8 mt-auto border-t border-brand-ink/10">
          <div class="w-1/3"><?php bloginfo('name'); ?></div>
          <div class="w-1/3 text-center">06</div>
          <div class="w-1/3 text-right">Photographer</div>
        </footer>
      </section>
    </div>

    <!-- Progress indicator -->
    <div class="fixed right-8 top-1/2 -translate-y-1/2 flex-col gap-4 z-50 mix-blend-difference hidden md:flex">
      <a href="#home" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Home"></a>
      <a href="#toc" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Table of Contents"></a>
      <a href="#about" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="About"></a>
      <a href="#project-1" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Project 1"></a>
      <a href="#project-2" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Project 2"></a>
      <a href="#project-3" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Gallery"></a>
      <a href="#abilities" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Abilities"></a>
      <a href="#contact" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Contact"></a>
    </div>

  </main>
  <?php wp_footer(); ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('mobile-menu-btn');
      const menu = document.getElementById('mobile-menu');
      const spans = btn.querySelectorAll('span');
      
      function toggleMenu() {
        const isMenuOpen = !menu.classList.contains('translate-x-full');
        if (isMenuOpen) {
          // Close menu
          menu.classList.add('translate-x-full');
          spans[0].classList.remove('-rotate-45', 'translate-y-[3.5px]');
          spans[1].classList.remove('rotate-45', 'w-6', '-translate-y-[3.5px]');
          spans[1].classList.add('w-4');
        } else {
          // Open menu
          menu.classList.remove('translate-x-full');
          spans[0].classList.add('-rotate-45', 'translate-y-[3.5px]');
          spans[1].classList.remove('w-4');
          spans[1].classList.add('rotate-45', 'w-6', '-translate-y-[3.5px]');
        }
      }

      btn.addEventListener('click', toggleMenu);
      
      // Close menu when clicking any link inside
      const links = menu.querySelectorAll('a');
      links.forEach(link => {
        link.addEventListener('click', toggleMenu);
      });
    });
  </script>
</body>
</html>