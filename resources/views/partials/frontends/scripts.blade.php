<script>
document.addEventListener("DOMContentLoaded", function(){

    const backToTop = document.getElementById("backToTop");

    // Muncul saat scroll
    window.addEventListener("scroll", function(){
        if(window.scrollY > 300){
            backToTop.classList.remove("opacity-0","pointer-events-none");
            backToTop.classList.add("opacity-100");
        } else {
            backToTop.classList.remove("opacity-100");
            backToTop.classList.add("opacity-0","pointer-events-none");
        }
    });

    // Smooth scroll
    backToTop.addEventListener("click", function(){
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const panels = document.querySelectorAll('.fade-panel');

    // kasih state awal animasi
    panels.forEach(panel => {
        panel.classList.add('animate');
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.remove('animate');
            } else {
                entry.target.classList.add('animate');
            }

        });
    }, {
        threshold: 0.15
    });

    panels.forEach(panel => observer.observe(panel));

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){

    const header = document.getElementById("mainHeader");
    const menuBtn = document.getElementById("menuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    // Scroll effect
    window.addEventListener("scroll", function(){
        if(window.scrollY > 50){
            header.classList.add("header-solid");
        } else {
            header.classList.remove("header-solid");
        }
    });

    // Mobile toggle
    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll('.filter-btn');
    const items   = document.querySelectorAll('.gallery-item');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {

            // Reset tombol
            buttons.forEach(b => {
                b.classList.remove('bg-blue-600','text-white');
                b.classList.add('bg-gray-200');
            });

            this.classList.remove('bg-gray-200');
            this.classList.add('bg-blue-600','text-white');

            const filter = this.dataset.filter.toLowerCase();

            items.forEach(item => {

                const category = item.dataset.category.toLowerCase();

                if (filter === 'all' || category === filter) {

                    item.style.display = 'block';

                    // sedikit delay biar animasi masuk smooth
                    setTimeout(() => {
                        item.classList.remove('opacity-0','scale-95');
                        item.classList.add('opacity-100','scale-100');
                    }, 10);

                } else {

                    item.classList.remove('opacity-100','scale-100');
                    item.classList.add('opacity-0','scale-95');

                    // tunggu animasi selesai baru hide
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 200);
                }

            });

        });
    });

});
</script>

<script>
    // Ambil semua elemen slide
    let index = 0;
    const slides = document.querySelectorAll('.slider-item');

    // Ganti slide tiap 5 detik
    setInterval(() => {

        // Sembunyikan slide aktif
        slides[index].classList.remove('opacity-100');
        slides[index].classList.add('opacity-0');

        // Pindah ke slide berikutnya
        index = (index + 1) % slides.length;

        // Tampilkan slide baru
        slides[index].classList.remove('opacity-0');
        slides[index].classList.add('opacity-100');

    }, 5000);
</script>

<script>
let newsIndex = 0;
const newsSlider = document.getElementById('newsSlider');
const totalNews = newsSlider.children.length;

function updateSlider() {
    newsSlider.style.transform = `translateX(-${newsIndex * 100}%)`;
}

// Auto slide
setInterval(() => {
    newsIndex = (newsIndex + 1) % totalNews;
    updateSlider();
}, 5000);

// Tombol next
document.getElementById('nextNews').onclick = () => {
    newsIndex = (newsIndex + 1) % totalNews;
    updateSlider();
};

// Tombol prev
document.getElementById('prevNews').onclick = () => {
    newsIndex = (newsIndex - 1 + totalNews) % totalNews;
    updateSlider();
};
</script>


<script>
const images = document.querySelectorAll('.gallery-img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');

images.forEach(img => {
    img.addEventListener('click', () => {
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightboxImg.src = img.src;
    });
});

// Tutup jika klik background
lightbox.addEventListener('click', () => {
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
});
</script>
