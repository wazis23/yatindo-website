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


<script>
document.addEventListener("DOMContentLoaded", function () {

    const panels = document.querySelectorAll('.fade-panel');

    // set state awal animasi
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

    const slider = document.getElementById("guruSlider");
    const nextBtn = document.getElementById("guruNext");
    const prevBtn = document.getElementById("guruPrev");
    const dotsContainer = document.getElementById("guruDots");

    if(!slider) return;

    const cards = slider.children;
    const cardWidth = 240;
    let index = 0;
    let autoSlide;

    // =========================
    // DOTS
    // =========================

    const totalDots = cards.length;

    for(let i=0;i<totalDots;i++){

        const dot = document.createElement("div");
        dot.className = "w-3 h-3 bg-gray-300 rounded-full cursor-pointer";

        dot.addEventListener("click",()=>{
            index = i;
            updateSlider();
            resetAuto();
        });

        dotsContainer.appendChild(dot);

    }

    function updateDots(){

        [...dotsContainer.children].forEach((dot,i)=>{

            dot.classList.remove("bg-yellow-400");
            dot.classList.add("bg-gray-300");

            if(i === index){
                dot.classList.remove("bg-gray-300");
                dot.classList.add("bg-yellow-400");
            }

        });

    }

    // =========================
    // UPDATE SLIDER
    // =========================

    function updateSlider(){

        slider.style.transform =
        `translateX(-${index * cardWidth}px)`;

        updateDots();

    }

    // =========================
    // BUTTON CONTROL
    // =========================

    nextBtn.addEventListener("click",()=>{

        index++;

        if(index >= cards.length){
            index = 0;
        }

        updateSlider();
        resetAuto();

    });

    prevBtn.addEventListener("click",()=>{

        index--;

        if(index < 0){
            index = cards.length - 1;
        }

        updateSlider();
        resetAuto();

    });

    // =========================
    // DRAG DESKTOP
    // =========================

    let isDragging = false;
    let startX;

    slider.addEventListener("mousedown",(e)=>{
        isDragging = true;
        startX = e.pageX;
    });

    slider.addEventListener("mouseup",()=>{
        isDragging = false;
    });

    slider.addEventListener("mouseleave",()=>{
        isDragging = false;
    });

    slider.addEventListener("mousemove",(e)=>{

        if(!isDragging) return;

        const move = e.pageX - startX;

        if(move > 60){
            prevBtn.click();
            isDragging = false;
        }

        if(move < -60){
            nextBtn.click();
            isDragging = false;
        }

    });

    // =========================
    // TOUCH MOBILE
    // =========================

    let touchStart = 0;

    slider.addEventListener("touchstart",(e)=>{
        touchStart = e.touches[0].clientX;
    });

    slider.addEventListener("touchmove",(e)=>{

        const touchMove = e.touches[0].clientX - touchStart;

        if(touchMove > 60){
            prevBtn.click();
            touchStart = e.touches[0].clientX;
        }

        if(touchMove < -60){
            nextBtn.click();
            touchStart = e.touches[0].clientX;
        }

    });

    // =========================
    // AUTO SLIDE
    // =========================

    function startAuto(){

        autoSlide = setInterval(()=>{

            index++;

            if(index >= cards.length){
                index = 0;
            }

            updateSlider();

        },4000);

    }

    function resetAuto(){

        clearInterval(autoSlide);
        startAuto();

    }

    slider.addEventListener("mouseenter",()=>{
        clearInterval(autoSlide);
    });

    slider.addEventListener("mouseleave",()=>{
        startAuto();
    });

    updateSlider();
    startAuto();

});

</script>


<script>

document.addEventListener("DOMContentLoaded", function(){

    const grid = document.querySelector(".fasilitas-grid");

    if(!grid) return;

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{

            if(entry.isIntersecting){

                grid.classList.add("show");

            } else {

                grid.classList.remove("show");

            }

        });

    }, {
        threshold: 0.25
    });

    observer.observe(grid);

});

</script>


<script>

document.addEventListener("DOMContentLoaded", function(){

    const grid = document.querySelector(".ekskul-grid");

    if(!grid) return;

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{

            if(entry.isIntersecting){

                grid.classList.add("show");

            } else {

                grid.classList.remove("show");

            }

        });

    },{threshold:0.25});

    observer.observe(grid);

});

</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const buttons = document.querySelectorAll(".guru-filter");
    const cards = document.querySelectorAll(".guru-card");

    buttons.forEach(btn => {

        btn.addEventListener("click", function(){

            const filter = this.dataset.filter;

            buttons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            cards.forEach(card => {

                const category = card.dataset.category;

                if(filter === "all" || category === filter){

                    card.style.display = "block";

                } else {

                    card.style.display = "none";

                }

            });

        });

    });

});
</script>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const slides = document.querySelectorAll(".hero-slide");
    let index = 0;

    setInterval(() => {

        slides[index].classList.remove("active");

        index = (index + 1) % slides.length;

        slides[index].classList.add("active");

    }, 6000);

});

</script>