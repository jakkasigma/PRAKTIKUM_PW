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
    }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <main class="h-screen overflow-y-auto scroll-smooth snap-y snap-mandatory selection:bg-brand-ink selection:text-brand-bg relative">
    
    <!-- Fixed Navigation Bar -->
    <nav class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-8 py-6 mix-blend-difference text-white">
      <a href="#" class="font-serif text-2xl font-bold tracking-widest uppercase">JAKKA.</a>
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'hidden md:flex gap-8 text-[10px] uppercase tracking-[0.2em] font-medium list-none',
        'fallback_cb'    => '__return_false',
      ) );
      ?>
    </nav>

    <!-- Hero Section -->
    <div class="snap-start h-screen" id="home">
      <section class="h-screen w-full relative flex items-center justify-center overflow-hidden bg-zinc-900 text-white">
        <div class="absolute inset-0 bg-neutral-800">
          <?php $hero_img = get_header_image() ? get_header_image() : get_template_directory_uri() . '/aset/banner.jpg'; ?>
          <img src="<?php echo esc_url($hero_img); ?>" alt="Banner" class="w-full h-full object-cover object-center grayscale opacity-60">
        </div>
        <div class="relative z-10 text-center px-4">
          <h1 class="font-serif text-[12vw] md:text-[15vw] leading-none tracking-tighter uppercase animate-slide-up">
            portofolio
          </h1>
        </div>
        <div class="absolute bottom-12 left-12 right-12 flex justify-between items-center text-[10px] uppercase tracking-[0.3em] font-medium mix-blend-difference">
          <span><?php bloginfo('name'); ?></span>
          <span>Void Core</span>
        </div>
      </section>
    </div>
    
    <!-- Table of Contents -->
    <div class="snap-start min-h-screen">
      <section id="toc" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <h2 class="font-serif text-5xl md:text-7xl mb-16">Table of Content</h2>
          <div class="grid md:grid-cols-2 gap-x-24 gap-y-8">
            <a href="#about" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ About Me</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">01</span>
            </a>
            <!-- ... Repeat for other items ... -->
             <a href="#project-1" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Web Ecosystem</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">02</span>
            </a>
            <a href="#project-2" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Macro ML Guide</span>
              <div class="flex-1 border-b border-brand-ink/20 mb-1.5 group-hover:border-brand-ink/50 transition-colors"></div>
              <span class="ml-4 font-serif text-2xl group-hover:scale-110 transition-transform">03</span>
            </a>
            <a href="#project-3" class="flex items-end group cursor-pointer w-full text-left no-underline text-brand-ink">
              <span class="font-medium mr-4 text-sm uppercase tracking-wider group-hover:italic transition-all">■ Urban Vision</span>
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
      <section id="about" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
              <h2 class="font-serif text-5xl md:text-6xl mb-8">About Me</h2>
              <div class="space-y-6 text-sm leading-relaxed max-w-md">
                <p class="font-medium italic text-lg text-neutral-800">Hello! I am Virgi Herwan</p>
                <p>Saya mahasiswa Informatika, junior programmer, dan fotografer. Saya suka membangun pengalaman web yang terasa modern, punya karakter, dan tetap nyaman dipakai tanpa beban efek yang berlebihan.</p>
                <p>Fokus saya adalah menciptakan harmoni antara fungsionalitas kode dan estetika visual, memastikan setiap proyek memiliki identitas yang kuat dan eksekusi yang rapi.</p>
                <p class="font-medium border-b border-brand-ink/10 pb-1 inline-block">Let's create something unforgettable together.</p>
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
      <section id="project-1" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-6">
              <h2 class="font-serif text-5xl md:text-6xl">Web Ecosystem</h2>
              <div class="text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>2024</span>
                <span class="w-8 h-[1px] bg-brand-ink/20"></span>
                <span>Development</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">Eksplorasi UI web, landing page, dan pengalaman digital yang lebih rapi serta responsif. Fokus pada performa dan kemudahan penggunaan.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-2 gap-4 h-[60vh]">
                <?php 
                $p1_img1 = get_theme_mod('project1_img1_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                $p1_img2 = get_theme_mod('project1_img2_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                $p1_img3 = get_theme_mod('project1_img3_setting') ?: get_template_directory_uri() . '/aset/aset_porto_web.png';
                ?>
                <div class="bg-neutral-200 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden row-span-2">
                  <img src="<?php echo esc_url($p1_img1); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-300 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden">
                  <img src="<?php echo esc_url($p1_img2); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-400 grayscale hover:grayscale-0 transition-all duration-500 overflow-hidden">
                  <img src="<?php echo esc_url($p1_img3); ?>" class="w-full h-full object-cover" alt="" />
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
      <section id="project-2" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-6">
              <h2 class="font-serif text-5xl md:text-6xl">Macro ML Guide</h2>
              <div class="text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>2023</span>
                <span class="w-8 h-[1px] bg-brand-ink/20"></span>
                <span>Gaming Meta</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">Analisis gameplay Mobile Legends yang fokus ke tempo, map control, dan objective play.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-2 gap-4 h-[60vh]">
                <?php 
                $p2_img1 = get_theme_mod('project2_img1_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                $p2_img2 = get_theme_mod('project2_img2_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                $p2_img3 = get_theme_mod('project2_img3_setting') ?: get_template_directory_uri() . '/aset/foto game.jpg';
                ?>
                <div class="bg-neutral-200 overflow-hidden">
                  <img src="<?php echo esc_url($p2_img1); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-300 overflow-hidden row-span-2">
                  <img src="<?php echo esc_url($p2_img2); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-400 overflow-hidden">
                  <img src="<?php echo esc_url($p2_img3); ?>" class="w-full h-full object-cover" alt="" />
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
      <section id="project-3" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-12 gap-12 items-start h-full">
            <div class="md:col-span-4 space-y-6">
              <h2 class="font-serif text-5xl md:text-6xl">Urban Vision</h2>
              <div class="text-sm uppercase tracking-widest font-semibold flex items-center gap-4">
                <span>2024</span>
                <span class="w-8 h-[1px] bg-brand-ink/20"></span>
                <span>Photography</span>
              </div>
              <p class="text-sm leading-relaxed text-neutral-700">Koleksi visual dengan komposisi yang menonjolkan mood dan atmosfer alam.</p>
            </div>
            <div class="md:col-span-8 h-full">
              <div class="grid grid-cols-3 grid-rows-2 gap-4 h-[60vh]">
                <?php 
                $p3_img1 = get_theme_mod('project3_img1_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                $p3_img2 = get_theme_mod('project3_img2_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                $p3_img3 = get_theme_mod('project3_img3_setting') ?: get_template_directory_uri() . '/aset/fotografi.jpg';
                ?>
                <div class="bg-neutral-200 overflow-hidden col-span-2 row-span-2">
                  <img src="<?php echo esc_url($p3_img1); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-300 overflow-hidden">
                  <img src="<?php echo esc_url($p3_img2); ?>" class="w-full h-full object-cover" alt="" />
                </div>
                <div class="bg-neutral-400 overflow-hidden">
                  <img src="<?php echo esc_url($p3_img3); ?>" class="w-full h-full object-cover" alt="" />
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
      <section id="abilities" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <h2 class="font-serif text-5xl md:text-7xl mb-16">Abilities</h2>
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
                  <h4 class="font-serif text-xl italic">Web Ecosystem</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Membangun antarmuka dan alur web yang terstruktur untuk kebutuhan sistem, dashboard, dan project berbasis data.</p>
                </div>
                <div class="space-y-3">
                  <h4 class="font-serif text-xl italic">Gaming Meta</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Menganalisis macro dan micro gameplay dengan pendekatan strategi, rotasi map, dan pengambilan objective.</p>
                </div>
                <div class="space-y-3">
                  <h4 class="font-serif text-xl italic">Photon Capture</h4>
                  <p class="text-xs leading-relaxed text-neutral-500">Mengolah visual dan komposisi foto agar terasa kuat secara mood, dokumentasi, dan storytelling.</p>
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
      <section id="contact" class="min-h-screen w-full flex flex-col p-8 md:p-12 relative overflow-hidden bg-brand-bg scroll-snap-align-start">
        <div class="flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full">
          <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="relative aspect-[3/3] bg-neutral-200 overflow-hidden grayscale hover:grayscale-0 transition-all duration-500">
              <?php $contact_img = get_theme_mod('contact_image_setting') ? get_theme_mod('contact_image_setting') : get_template_directory_uri() . '/aset/foto contact.jpg'; ?>
              <img src="<?php echo esc_url($contact_img); ?>" alt="Contact" class="w-full h-full object-cover" style="object-position: 30% 70%;"/>
            </div>
            <div>
              <h2 class="font-serif text-5xl md:text-7xl mb-12">Contact Information</h2>
              <div class="grid grid-cols-2 gap-12">
                <div class="space-y-8">
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Phone</p>
                    <p class="text-sm"><?php echo esc_html(get_theme_mod('jakka_phone_setting', '+62 878 1710 9749')); ?></p>
                    <p class="text-sm">Yogyakarta Base</p>
                  </div>
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Email</p>
                    <p class="text-sm underline"><?php echo esc_html(get_theme_mod('jakka_email_setting', 'virgilaki@gmail.com')); ?></p>
                  </div>
                </div>
                <div class="space-y-8">
                  <div>
                    <p class="text-[10px] uppercase tracking-widest font-semibold mb-2">Address</p>
                    <p class="text-sm"><?php echo esc_html(get_theme_mod('jakka_address_setting', 'Kraton, Yogyakarta')); ?></p>
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
      <a href="#abilities" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Abilities"></a>
      <a href="#contact" class="w-1 h-1 rounded-full bg-white opacity-40 hover:opacity-100 transition-opacity" title="Contact"></a>
    </div>

  </main>
  <?php wp_footer(); ?>
</body>
</html>