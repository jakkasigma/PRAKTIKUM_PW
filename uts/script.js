(function () {
  'use strict';

  // Data film
  var movies = {
    // Trending
    'Monster (2023)': {
      title:'MONSTER',year:2023,genre:'Drama, Mystery',duration:'2j 6m',rating:7.9,
      tagline:'"Who is the monster?"',
      synopsis:'Seorang ibu tunggal menemukan putranya berubah drastis setelah insiden di sekolah. Saat ia menuntut penjelasan dari guru dan pihak sekolah, kebenaran yang terungkap jauh lebih kompleks dari yang dibayangkan — sebuah cerita yang dilihat dari tiga sudut pandang berbeda.',
      director:'Hirokazu Kore-eda',poster:'https://www.themoviedb.org/t/p/w1280/kvUJUyUGOhEoiWWNH04IXoExPE2.jpg',backdrop:'https://i.pinimg.com/736x/f1/94/ca/f194ca18fa386f86824cf7e788078f24.jpg'
    },
    'Oppenheimer (2023)': {
      title:'OPPENHEIMER',year:2023,genre:'Drama, History, Thriller',duration:'3j 0m',rating:8.0,
      tagline:'"The world forever changes."',
      synopsis:'Kisah fisikawan J. Robert Oppenheimer dan perannya dalam pengembangan bom atom selama Proyek Manhattan pada Perang Dunia II, serta dampak moral yang menghantuinya seumur hidup.',
      director:'Christopher Nolan',poster:'https://www.themoviedb.org/t/p/w1280/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg'
    },
    'Inside Out 2 (2024)': {
      title:'INSIDE OUT 2',year:2024,genre:'Animasi, Komedi, Keluarga',duration:'1j 36m',rating:7.6,
      tagline:'"Make room for new emotions."',
      synopsis:'Riley memasuki masa remaja dan markas emosi di otaknya mengalami perombakan besar. Emosi-emosi baru seperti Anxiety, Envy, dan Ennui muncul dan mengambil alih kendali.',
      director:'Kelsey Mann',poster:'https://image.tmdb.org/t/p/w300/vpnVM9B6NMmQpWeZvzLvDESb2QY.jpg',backdrop:'https://image.tmdb.org/t/p/w1280/vpnVM9B6NMmQpWeZvzLvDESb2QY.jpg'
    },
    'Deadpool & Wolverine (2024)': {
      title:'DEADPOOL & WOLVERINE',year:2024,genre:'Action, Komedi, Sci-Fi',duration:'2j 8m',rating:7.7,
      tagline:'"Come together."',
      synopsis:'Deadpool menerima tawaran dari Time Variance Authority dan bergabung dengan Wolverine yang enggan untuk menyelamatkan multiverse dari ancaman baru yang berbahaya.',
      director:'Shawn Levy',poster:'https://image.tmdb.org/t/p/w300/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg',backdrop:'https://image.tmdb.org/t/p/w1280/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg'
    },
    'My Neighbor Totoro (1988)': {
      title:'MY NEIGHBOR TOTORO',year:1988,genre:'Animasi, Fantasi, Keluarga',duration:'1j 26m',rating:8.1,
      tagline:'"He\'s not scary at all!"',
      synopsis:'Dua gadis kecil, Satsuki dan Mei, pindah ke pedesaan Jepang bersama ayah mereka dan menemukan makhluk hutan ajaib bernama Totoro yang menjadi teman bermain mereka.',
      director:'Hayao Miyazaki',poster:'https://www.themoviedb.org/t/p/w1280/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg'
    },
    'Avatar: Fire and Ash (2025)': {
      title:'AVATAR: FIRE AND ASH',year:2025,genre:'Sci-Fi, Adventure, Action',duration:'2j 30m',rating:7.4,
      tagline:'"A new chapter rises."',
      synopsis:'Jake Sully dan Neytiri menghadapi ancaman baru di Pandora ketika kekuatan dari dunia luar kembali datang, memaksa mereka menjelajahi wilayah yang belum pernah dijamah dan menghadapi konflik yang lebih besar dari sebelumnya.',
      director:'James Cameron',poster:'https://www.themoviedb.org/t/p/w1280/aabwWZWx6z1aYP4PX2ADvbDKktd.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/aabwWZWx6z1aYP4PX2ADvbDKktd.jpg'
    },
    'Ponyo (2008)': {
      title:'PONYO',year:2008,genre:'Animasi, Fantasi, Adventure',duration:'1j 41m',rating:7.9,
      tagline:'"Welcome to a world where anything is possible."',
      synopsis:'Ponyo, seekor ikan emas ajaib, berteman dengan Sosuke, bocah berusia lima tahun. Ponyo ingin menjadi manusia, tapi keputusannya mengancam keseimbangan alam semesta.',
      director:'Hayao Miyazaki',poster:'https://www.themoviedb.org/t/p/w1280/yp8vEZflGynlEylxEesbYasc06i.jpg',backdrop:'https://i.pinimg.com/1200x/36/56/d8/3656d8082ea225976d599da9dbe5fafd.jpg'
    },
    'Grave of the Fireflies (1988)': {
      title:'GRAVE OF THE FIREFLIES',year:1988,genre:'Animasi, Drama, Perang',duration:'1j 29m',rating:8.4,
      tagline:'"A tale of survival in wartime Japan."',
      synopsis:'Di penghujung Perang Dunia II, dua bersaudara yatim piatu — Seita dan Setsuko — berjuang bertahan hidup di Jepang yang porak-poranda akibat pemboman. Sebuah kisah memilukan tentang kasih sayang dan kehilangan.',
      director:'Isao Takahata',poster:'https://www.themoviedb.org/t/p/w1280/6OjdsCUpUMwdDQTWG5x0Qm6zo8i.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/6OjdsCUpUMwdDQTWG5x0Qm6zo8i.jpg'
    },
    'Missing (2022)': {
      title:'MISSING',year:2022,genre:'Thriller, Mystery, Drama',duration:'1j 51m',rating:7.1,
      tagline:'"The search begins on a screen."',
      synopsis:'Seorang remaja menggunakan teknologi modern — media sosial, GPS, dan kamera pengawas — untuk mencari ibunya yang hilang secara misterius saat berlibur di Kolombia bersama pacar barunya.',
      director:'Nicholas D. Johnson & Will Merrick',poster:'https://www.themoviedb.org/t/p/w1280/eR26BRl4zu36xeIzWdYgtvRVH2d.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/eR26BRl4zu36xeIzWdYgtvRVH2d.jpg'
    },
    'Chainsaw Man - The Movie: Reze Arc (2025)': {
      title:'CHAINSAW MAN: REZE ARC',year:2025,genre:'Action, Horror, Animasi',duration:'2j 0m',rating:8.3,
      tagline:'"Love is a bomb."',
      synopsis:'Denji bertemu Reze, gadis misterius yang bekerja di kafe. Hubungan mereka berkembang, namun Reze menyimpan rahasia gelap sebagai Bomb Devil yang mengancam kehidupan Denji dan seluruh Tokyo.',
      director:'Ryuu Nakayama',poster:'https://www.themoviedb.org/t/p/w1280/pHyxb2RV5wLlboAwm9ZJ9qTVEDw.jpg',backdrop:'https://i.pinimg.com/1200x/7a/c3/c7/7ac3c7bb1a8886e3359aaa6d15ca5744.jpg'
    },

    // Marvel
    'Avengers: Endgame (2019)': {
      title:'AVENGERS: ENDGAME',year:2019,genre:'Action, Adventure, Sci-Fi',duration:'3j 1m',rating:8.4,
      tagline:'"Avenge the fallen."',
      synopsis:'Setelah Thanos memusnahkan separuh kehidupan di alam semesta, para Avengers yang tersisa harus melakukan apa pun untuk membatalkan tindakan Titan Gila tersebut dan memulihkan keseimbangan alam semesta.',
      director:'Anthony & Joe Russo',poster:'https://image.tmdb.org/t/p/w300/or06FN3Dka5tukK1e9sl16pB3iy.jpg',backdrop:'https://image.tmdb.org/t/p/w1280/or06FN3Dka5tukK1e9sl16pB3iy.jpg'
    },
    'Avengers: Infinity War (2018)': {
      title:'AVENGERS: INFINITY WAR',year:2018,genre:'Action, Adventure, Sci-Fi',duration:'2j 29m',rating:8.2,
      tagline:'"An entire universe. Once and for all."',
      synopsis:'Para Avengers dan sekutu mereka harus bersedia mengorbankan segalanya dalam upaya mengalahkan Thanos yang kuat sebelum ia berhasil menghancurkan separuh alam semesta.',
      director:'Anthony & Joe Russo',poster:'https://www.themoviedb.org/t/p/w1280/dW88Lx1nwaUQgXIvjg2kRrbIOH1.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/dW88Lx1nwaUQgXIvjg2kRrbIOH1.jpg'
    },
    'Spider-Man: No Way Home (2021)': {
      title:'SPIDER-MAN: NO WAY HOME',year:2021,genre:'Action, Adventure, Sci-Fi',duration:'2j 28m',rating:8.0,
      tagline:'"The multiverse unleashed."',
      synopsis:'Identitas Spider-Man terungkap. Peter meminta bantuan Doctor Strange, namun mantra yang salah membuka multiverse dan mendatangkan musuh-musuh dari dimensi lain.',
      director:'Jon Watts',poster:'https://image.tmdb.org/t/p/w300/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg',backdrop:'https://image.tmdb.org/t/p/w1280/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg'
    },
    'Captain Marvel (2019)': {
      title:'CAPTAIN MARVEL',year:2019,genre:'Action, Adventure, Sci-Fi',duration:'2j 4m',rating:6.8,
      tagline:'"Higher. Further. Faster."',
      synopsis:'Carol Danvers menjadi salah satu pahlawan paling kuat di alam semesta saat Bumi terjebak di tengah perang galaksi antara dua ras alien.',
      director:'Anna Boden & Ryan Fleck',poster:'https://www.themoviedb.org/t/p/w1280/2D4lUKyn64Srs8QvVk0vv6KjvMG.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/2D4lUKyn64Srs8QvVk0vv6KjvMG.jpg'
    },
    'Black Panther (2018)': {
      title:'BLACK PANTHER',year:2018,genre:'Action, Adventure, Sci-Fi',duration:'2j 14m',rating:7.3,
      tagline:'"Long live the king."',
      synopsis:"T'Challa kembali ke Wakanda untuk naik takhta, namun kemunculan musuh baru mengancam nasib Wakanda dan seluruh dunia.",
      director:'Ryan Coogler',poster:'https://themoviedb.org/t/p/w1280/udd8VinUWwLIiTYn3wdOEpCk9Fq.jpg',backdrop:'https://themoviedb.org/t/p/w1280/udd8VinUWwLIiTYn3wdOEpCk9Fq.jpg'
    },
    'Guardians of the Galaxy Vol. 3 (2023)': {
      title:'GUARDIANS OF THE GALAXY VOL. 3',year:2023,genre:'Action, Adventure, Komedi',duration:'2j 30m',rating:7.9,
      tagline:'"Once more with feeling."',
      synopsis:'Peter Quill dan para Guardian harus melindungi Rocket dari masa lalunya yang mengerikan sambil menghadapi ancaman baru, The High Evolutionary.',
      director:'James Gunn',poster:'https://www.themoviedb.org/t/p/w1280/dnyQnKSSqQ8aOEMiE5hYDNJO4dE.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/dnyQnKSSqQ8aOEMiE5hYDNJO4dE.jpg'
    },
    'The Avengers (2012)': {
      title:'THE AVENGERS',year:2012,genre:'Action, Adventure, Sci-Fi',duration:'2j 23m',rating:8.0,
      tagline:'"Some assembly required."',
      synopsis:'Para pahlawan super terkuat di Bumi harus bersatu untuk menghentikan Loki dan pasukan aliennya yang menginvasi Bumi.',
      director:'Joss Whedon',poster:'https://www.themoviedb.org/t/p/w1280/RYMX2wcKCBAr24UyPD7xwmjaTn.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/RYMX2wcKCBAr24UyPD7xwmjaTn.jpg'
    },
    'Thor: Ragnarok (2017)': {
      title:'THOR: RAGNAROK',year:2017,genre:'Action, Adventure, Komedi',duration:'2j 10m',rating:7.6,
      tagline:'"No hammer. No problem."',
      synopsis:'Thor dipenjara di planet Sakaar dan harus bertarung melawan rekan lamanya Hulk di arena gladiator, sambil berlomba waktu untuk mencegah Ragnarok.',
      director:'Taika Waititi',poster:'https://www.themoviedb.org/t/p/w1280/rzRwTcFvttcN1ZpX2xv4j3tSdJu.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/rzRwTcFvttcN1ZpX2xv4j3tSdJu.jpg'
    },
    'Captain America: Civil War (2016)': {
      title:'CAPTAIN AMERICA: CIVIL WAR',year:2016,genre:'Action, Adventure, Sci-Fi',duration:'2j 27m',rating:7.4,
      tagline:'"Divided we fall."',
      synopsis:'Para Avengers terpecah menjadi dua kubu yang dipimpin Captain America dan Iron Man karena perbedaan pandangan soal pengawasan pemerintah.',
      director:'Anthony & Joe Russo',poster:'https://www.themoviedb.org/t/p/w1280/td9wjb1v4sBE0T5UsZx50QnsZ3j.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/td9wjb1v4sBE0T5UsZx50QnsZ3j.jpg'
    },

    // Animasi
    'Spirited Away (2001)': {
      title:'SPIRITED AWAY',year:2001,genre:'Animasi, Fantasi, Adventure',duration:'2j 5m',rating:8.5,
      tagline:'"A journey beyond imagination."',
      synopsis:'Chihiro, gadis berusia 10 tahun, tersesat di dunia roh setelah orang tuanya berubah menjadi babi. Ia harus bekerja di pemandian milik penyihir Yubaba untuk membebaskan diri.',
      director:'Hayao Miyazaki',poster:'https://image.tmdb.org/t/p/w300/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg',backdrop:'https://image.tmdb.org/t/p/w1280/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg'
    },
    'The Wild Robot (2024)': {
      title:'THE WILD ROBOT',year:2024,genre:'Animasi, Sci-Fi, Drama',duration:'1j 42m',rating:8.4,
      tagline:'"Programmed to serve. Built to survive."',
      synopsis:'Robot ROZZUM unit 7134 terdampar di sebuah pulau terpencil dan harus belajar beradaptasi dengan alam liar, akhirnya menjadi ibu angkat seekor anak angsa.',
      director:'Chris Sanders',poster:'https://www.themoviedb.org/t/p/w1280/9w0Vh9eizfBXrcomiaFWTIPdboo.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/9w0Vh9eizfBXrcomiaFWTIPdboo.jpg'
    },
    'Spider-Man: Across the Spider-Verse (2023)': {
      title:'SPIDER-MAN: ACROSS THE SPIDER-VERSE',year:2023,genre:'Animasi, Action, Adventure',duration:'2j 20m',rating:8.3,
      tagline:'"It\'s how you wear the mask that matters."',
      synopsis:'Miles Morales kembali dan bertemu dengan Spider-People dari berbagai dimensi. Namun ketika para pahlawan berselisih tentang cara menangani ancaman baru, Miles harus mendefinisikan ulang arti menjadi pahlawan.',
      director:'Joaquim Dos Santos',poster:'https://www.themoviedb.org/t/p/w1280/8Vt6mWEReuy4Of61Lnj5Xj704m8.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/8Vt6mWEReuy4Of61Lnj5Xj704m8.jpg'
    },
    'Kimi no Na wa (2016)': {
      title:'KIMI NO NA WA (YOUR NAME)',year:2016,genre:'Animasi, Romantis, Drama',duration:'1j 46m',rating:8.6,
      tagline:'"Once in a while when I wake up, I find myself crying."',
      synopsis:'Dua remaja — Mitsuha dari desa dan Taki dari Tokyo — secara misterius bertukar tubuh. Mereka berusaha menemukan satu sama lain dalam sebuah perlombaan melawan waktu.',
      director:'Makoto Shinkai',poster:'https://www.themoviedb.org/t/p/w1280/gCYGhDtlsHr5hPjpe2Yh0MSrntG.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/gCYGhDtlsHr5hPjpe2Yh0MSrntG.jpg'
    },
    'Hoppers (2026)': {
      title:'HOPPERS',year:2026,genre:'Animasi, Adventure, Komedi',duration:'1j 38m',rating:7.8,
      tagline:'"Leap into the unknown."',
      synopsis:'Sebuah petualangan animasi yang membawa penonton ke dunia fantastis penuh warna dan karakter unik yang harus melompat melewati berbagai dimensi.',
      director:'Pierre Perifel',poster:'https://www.themoviedb.org/t/p/w1280/xjtWQ2CL1mpmMNwuU5HeS4Iuwuu.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/xjtWQ2CL1mpmMNwuU5HeS4Iuwuu.jpg'
    },
    'Toy Story 4 (2019)': {
      title:'TOY STORY 4',year:2019,genre:'Animasi, Adventure, Komedi',duration:'1j 40m',rating:7.5,
      tagline:'"To infinity... and beyond."',
      synopsis:'Woody dan Buzz Lightyear memulai petualangan baru bersama teman-teman lama dan baru saat Bonnie menambahkan mainan enggan bernama Forky ke koleksinya.',
      director:'Josh Cooley',poster:'https://www.themoviedb.org/t/p/w1280/w9kR8qbmQ01HwnvK4alvnQ2ca0L.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/w9kR8qbmQ01HwnvK4alvnQ2ca0L.jpg'
    },
    'The Little Prince (2015)': {
      title:'THE LITTLE PRINCE',year:2015,genre:'Animasi, Fantasi, Drama',duration:'1j 48m',rating:7.6,
      tagline:'"What is essential is invisible to the eye."',
      synopsis:'Seorang gadis kecil yang hidup dalam dunia orang dewasa menemukan tetangga eksentrik yang menceritakan kisah tentang Pangeran Kecil dari asteroid jauh.',
      director:'Mark Osborne',poster:'https://www.themoviedb.org/t/p/w1280/rQ4hyoqE9cnWHkONcoNuPW2NLcX.jpg',backdrop:'https://i.pinimg.com/1200x/91/b0/f5/91b0f566404be17fb37dafc4ab6e3b10.jpg'
    },
    'Weathering with You (2019)': {
      title:'WEATHERING WITH YOU',year:2019,genre:'Animasi, Romantis, Fantasi',duration:'1j 52m',rating:8.3,
      tagline:'"This is a story about the world\'s secret."',
      synopsis:'Hodaka, seorang remaja yang kabur ke Tokyo, bertemu Hina yang memiliki kemampuan mengendalikan cuaca. Hubungan mereka diuji saat Tokyo dilanda hujan tanpa henti.',
      director:'Makoto Shinkai',poster:'https://www.themoviedb.org/t/p/w1280/qgrk7r1fV4IjuoeiGS5HOhXNdLJ.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/qgrk7r1fV4IjuoeiGS5HOhXNdLJ.jpg'
    },
    'Suzume (2022)': {
      title:'SUZUME NO TOJIMARI',year:2022,genre:'Animasi, Adventure, Fantasi',duration:'2j 1m',rating:7.8,
      tagline:'"On the other side of the door, was time in its entirety."',
      synopsis:'Suzume, gadis 17 tahun dari Kyushu, menemukan sebuah pintu tua misterius dan memulai perjalanan menutup pintu-pintu yang menyebabkan bencana di seluruh Jepang.',
      director:'Makoto Shinkai',poster:'https://www.themoviedb.org/t/p/w1280/yStW1TXF5s7Tbtu9KjIZEaWl6HL.jpg',backdrop:'https://www.themoviedb.org/t/p/w1280/yStW1TXF5s7Tbtu9KjIZEaWl6HL.jpg'
    }
  };

  var categories = {
    'row-trending': [
      'Monster (2023)', 'Oppenheimer (2023)', 'Inside Out 2 (2024)', 'Deadpool & Wolverine (2024)',
      'My Neighbor Totoro (1988)', 'Avatar: Fire and Ash (2025)', 'Ponyo (2008)',
      'Grave of the Fireflies (1988)', 'Missing (2022)', 'Chainsaw Man - The Movie: Reze Arc (2025)'
    ],
    'row-marvel': [
      'Avengers: Endgame (2019)', 'Avengers: Infinity War (2018)', 'Spider-Man: No Way Home (2021)',
      'Captain Marvel (2019)', 'Black Panther (2018)', 'Deadpool & Wolverine (2024)', 'Guardians of the Galaxy Vol. 3 (2023)',
      'The Avengers (2012)', 'Thor: Ragnarok (2017)', 'Captain America: Civil War (2016)'
    ],
    'row-animasi': [
      'Spirited Away (2001)', 'Inside Out 2 (2024)', 'The Wild Robot (2024)', 'Spider-Man: Across the Spider-Verse (2023)',
      'Kimi no Na wa (2016)', 'Hoppers (2026)', 'Toy Story 4 (2019)', 'The Little Prince (2015)',
      'Weathering with You (2019)', 'Suzume (2022)'
    ]
  };

  // Elemen DOM
  var overlay    = document.getElementById('intro-overlay');
  var homepage   = document.getElementById('homepage');
  var detailEl   = document.getElementById('movie-detail');
  var backBtn    = document.getElementById('detail-back');

  // Buka halaman detail film
  function openDetail(key) {
    var m = movies[key];
    if (!m) return;

    document.getElementById('detail-poster').src = m.poster;
    document.getElementById('detail-backdrop').style.backgroundImage = 'url(' + m.backdrop + ')';
    document.getElementById('detail-title').textContent = m.title + ' (' + m.year + ')';
    document.getElementById('detail-meta').innerHTML =
      '<span class="meta-badge">SU</span>' + m.genre + ' &nbsp;·&nbsp; ' + m.duration;
    document.getElementById('detail-tagline').textContent = m.tagline;
    document.getElementById('detail-synopsis').textContent = m.synopsis;
    document.getElementById('detail-director').textContent = m.director;

    document.getElementById('score-text').textContent = m.rating + ' / 10';

    detailEl.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  // Tutup halaman detail
  function closeDetail() {
    detailEl.classList.remove('active');
    document.body.style.overflow = '';
  }

  // Inisialisasi setelah DOM siap
  window.addEventListener('DOMContentLoaded', function () {
    homepage.style.visibility = 'visible';

    setTimeout(function () {
      overlay.style.display = 'none';
    }, 4500);

    // Fungsi ganti konten hero
    function setHeroMovie(key) {
      var m = movies[key];
      if (!m) return;
      
      document.getElementById('hero-bg').src = m.backdrop;
      
      // Format judul khusus untuk hero
      var titleText = m.title;
      if (titleText === 'CHAINSAW MAN: REZE ARC') {
        document.getElementById('hero-title').innerHTML = 'CHAINSAW MAN:<br>REZE ARC';
      } else {
        document.getElementById('hero-title').textContent = titleText;
      }

      document.getElementById('hero-meta').innerHTML = 
        m.year + ' &nbsp;·&nbsp; ' + m.genre + ' &nbsp;·&nbsp; ' + m.duration + ' &nbsp;·&nbsp; ⭐ ' + m.rating;
      
      document.getElementById('hero-desc').textContent = m.synopsis;
      
      var heroInfoBtn = document.getElementById('hero-info-btn');
      if (heroInfoBtn) {
        // Reset listener tombol info
        var newBtn = heroInfoBtn.cloneNode(true);
        heroInfoBtn.parentNode.replaceChild(newBtn, heroInfoBtn);
        newBtn.addEventListener('click', function () {
          openDetail(key);
        });
      }
    }


    // Daftar film untuk slideshow hero
    var heroMoviesList = [
      'Chainsaw Man - The Movie: Reze Arc (2025)',
      'Ponyo (2008)',
      'Monster (2023)',
      'The Little Prince (2015)'
    ];
    var currentHeroIndex = 0;

    // Tampilkan film pertama
    setHeroMovie(heroMoviesList[currentHeroIndex]);

    // Ganti hero otomatis setiap 5 detik dengan efek fade
    setInterval(function() {
      var heroBg = document.getElementById('hero-bg');
      var heroContent = document.querySelector('.hero-content');

      heroBg.classList.add('hero-fade-out');
      heroContent.classList.add('hero-fade-out');

      setTimeout(function() {
        currentHeroIndex = (currentHeroIndex + 1) % heroMoviesList.length;
        setHeroMovie(heroMoviesList[currentHeroIndex]);
        heroBg.classList.remove('hero-fade-out');
        heroContent.classList.remove('hero-fade-out');
      }, 300);
    }, 5000);



    
    // Buat kartu film untuk setiap kategori
    for (var rowId in categories) {
      if (categories.hasOwnProperty(rowId)) {
        var rowEl = document.getElementById(rowId);
        if (rowEl) {
          var html = '';
          categories[rowId].forEach(function (movieKey, index) {
            var m = movies[movieKey];
            if (m) {
              var displayTitle = movieKey; 
              html += '<div class="movie-card-sm" data-key="' + movieKey + '">' +
                        '<div class="card-rank">' + (index + 1) + '</div>' +
                        '<div class="card-poster-wrap">' +
                          '<img src="' + m.poster + '" alt="' + m.title + '" />' +
                          '<div class="badge-sewa">SEWA 5K</div>' +
                          '<div class="badge-beli">BELI 15K</div>' +
                        '</div>' +
                        '<div class="card-info-sm">' +
                          '<span class="card-rating">⭐ ' + m.rating + '</span>' +
                          '<p class="card-title-sm">' + displayTitle + '</p>' +
                        '</div>' +
                      '</div>';
            }
          });
          rowEl.innerHTML = html;
        }
      }
    }

    // Klik kartu film
    var cards = document.querySelectorAll('.movie-card-sm');
    cards.forEach(function (card) {
      card.addEventListener('click', function () {
        var key = card.getAttribute('data-key');
        if (key) openDetail(key);
      });
    });

    // Navbar aktif saat scroll
    var navLinks = document.querySelectorAll('.nav-links a');
    var heroSection = document.getElementById('hero');
    if (navLinks.length >= 2 && heroSection) {
      window.addEventListener('scroll', function() {
        var scrollPos = window.scrollY || document.documentElement.scrollTop;
        var heroBottom = heroSection.offsetHeight - 150; 
        
        navLinks.forEach(function(link) {
          link.classList.remove('active');
        });
        
        if (scrollPos < heroBottom) {
          navLinks[0].classList.add('active');
        } else {
          navLinks[1].classList.add('active');
        }
      });
    }

    // Hamburger menu mobile
    var hamburger = document.getElementById('hamburger');
    var navCenter = document.querySelector('.nav-center');
    if (hamburger && navCenter) {
      hamburger.addEventListener('click', function() {
        navCenter.classList.toggle('open');
      });

      // Tutup menu saat klik link
      var mobileLinks = navCenter.querySelectorAll('.nav-links a');
      mobileLinks.forEach(function(link) {
        link.addEventListener('click', function() {
          navCenter.classList.remove('open');
        });
      });
    }

    // Tombol kembali
    backBtn.addEventListener('click', closeDetail);

    // Tutup dengan tombol ESC
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && detailEl.classList.contains('active')) closeDetail();
    });

    // Jam live di footer
    var clockEl = document.getElementById('clock');
    if (clockEl) {
      function updateTime() {
        var now = new Date();
        var timeStr = now.toLocaleTimeString('en-US', {
          hour12: false, hour: '2-digit', minute: '2-digit', timeZone: 'Asia/Jakarta'
        });
        clockEl.innerText = 'JAKARTA \u2014 ' + timeStr;
      }
      setInterval(updateTime, 1000);
      updateTime();
    }
  });
})();
