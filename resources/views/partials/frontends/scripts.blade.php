<script>
document.addEventListener("DOMContentLoaded", function(){

/* =========================================================
   ELEMENT SELECTOR
========================================================= */

const backToTop = document.getElementById("backToTop");
const header = document.getElementById("mainHeader");
const menuBtn = document.getElementById("menuBtn");
const mobileMenu = document.getElementById("mobileMenu");


/* =========================================================
   SCROLL EVENT (Header + Back To Top)
========================================================= */

window.addEventListener("scroll", function(){

    const scrollY = window.scrollY;

    // Back to top button
    if(backToTop){
        if(scrollY > 300){
            backToTop.classList.remove("opacity-0","pointer-events-none");
            backToTop.classList.add("opacity-100");
        }else{
            backToTop.classList.remove("opacity-100");
            backToTop.classList.add("opacity-0","pointer-events-none");
        }
    }

    // Header color change
    if(header){
        if(scrollY > 50){
            header.classList.add("header-solid");
        }else{
            header.classList.remove("header-solid");
        }
    }

});


/* =========================================================
   BACK TO TOP CLICK
========================================================= */

if(backToTop){
    backToTop.addEventListener("click", function(){
        window.scrollTo({
            top:0,
            behavior:"smooth"
        });
    });
}


/* =========================================================
   MOBILE MENU
========================================================= */

if(menuBtn && mobileMenu){
    menuBtn.addEventListener("click", function(){
        mobileMenu.classList.toggle("hidden");
    });
}


/* =========================================================
   SCROLL ANIMATION (fade-panel)
========================================================= */

const panels = document.querySelectorAll(".fade-panel");

if(panels.length){

    panels.forEach(panel => panel.classList.add("animate"));

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{

            if(entry.isIntersecting){
                entry.target.classList.remove("animate");
            }else{
                entry.target.classList.add("animate");
            }

        });

    },{threshold:0.15});

    panels.forEach(panel => observer.observe(panel));

}


/* =========================================================
   GALLERY FILTER
========================================================= */

const filterButtons = document.querySelectorAll(".filter-btn");
const galleryItems = document.querySelectorAll(".gallery-item");

if(filterButtons.length){

    filterButtons.forEach(btn=>{

        btn.addEventListener("click", function(){

            const filter = this.dataset.filter.toLowerCase();

            filterButtons.forEach(b=>{
                b.classList.remove("bg-blue-600","text-white");
                b.classList.add("bg-gray-200");
            });

            this.classList.remove("bg-gray-200");
            this.classList.add("bg-blue-600","text-white");

            galleryItems.forEach(item=>{

                const category = item.dataset.category.toLowerCase();

                if(filter === "all" || category === filter){

                    item.style.display="block";

                    requestAnimationFrame(()=>{
                        item.classList.remove("opacity-0","scale-95");
                        item.classList.add("opacity-100","scale-100");
                    });

                }else{

                    item.classList.remove("opacity-100","scale-100");
                    item.classList.add("opacity-0","scale-95");

                    setTimeout(()=>{
                        item.style.display="none";
                    },200);

                }

            });

        });

    });

}


/* =========================================================
   HERO SLIDER
========================================================= */


const slides = document.querySelectorAll(".slider-item");

if(slides.length){
    let index = 0;

    function showSlide(i){
        slides.forEach((slide, idx)=>{
            slide.classList.remove("opacity-100","z-10");
            slide.classList.add("opacity-0","z-0");

            if(idx === i){
                slide.classList.remove("opacity-0","z-0");
                slide.classList.add("opacity-100","z-10");
            }
        });
    }

    setInterval(()=>{
        index = (index + 1) % slides.length;
        showSlide(index);
    },4000);
}


/* =========================================================
   NEWS SLIDER
========================================================= */

const newsSlider = document.getElementById("newsSlider");

if(newsSlider){

    let newsIndex = 0;
    const totalNews = newsSlider.children.length;

    const updateSlider = ()=>{
        newsSlider.style.transform = `translateX(-${newsIndex * 100}%)`;
    };

    setInterval(()=>{
        newsIndex = (newsIndex + 1) % totalNews;
        updateSlider();
    },5000);

    const next = document.getElementById("nextNews");
    const prev = document.getElementById("prevNews");

    if(next){
        next.addEventListener("click", ()=>{
            newsIndex = (newsIndex + 1) % totalNews;
            updateSlider();
        });
    }

    if(prev){
        prev.addEventListener("click", ()=>{
            newsIndex = (newsIndex - 1 + totalNews) % totalNews;
            updateSlider();
        });
    }

}


/* =========================================================
   LIGHTBOX GALLERY
========================================================= */

const images = document.querySelectorAll(".gallery-img");
const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightboxImg");

if(images.length && lightbox && lightboxImg){

    images.forEach(img=>{
        img.addEventListener("click", ()=>{
            lightbox.classList.remove("hidden");
            lightbox.classList.add("flex");
            lightboxImg.src = img.src;
        });
    });

    lightbox.addEventListener("click", ()=>{
        lightbox.classList.add("hidden");
        lightbox.classList.remove("flex");
    });

}


/* =========================================================
   GURU FILTER
========================================================= */

const guruButtons = document.querySelectorAll(".guru-filter");
const guruCards = document.querySelectorAll(".guru-card");

if(guruButtons.length){

    guruButtons.forEach(btn=>{

        btn.addEventListener("click", function(){

            const filter = this.dataset.filter;

            guruButtons.forEach(b=>b.classList.remove("active"));
            this.classList.add("active");

            guruCards.forEach(card=>{

                const category = card.dataset.category;

                if(filter === "all" || category === filter){
                    card.style.display="block";
                }else{
                    card.style.display="none";
                }

            });

        });

    });

}


/* =========================================================
   GRID ANIMATION (Fasilitas & Ekskul)
========================================================= */

function observeGrid(selector){

    const grid = document.querySelector(selector);
    if(!grid) return;

    const observer = new IntersectionObserver((entries)=>{

        entries.forEach(entry=>{
            if(entry.isIntersecting){
                grid.classList.add("show");
            }else{
                grid.classList.remove("show");
            }
        });

    },{threshold:0.25});

    observer.observe(grid);
}

observeGrid(".fasilitas-grid");
observeGrid(".ekskul-grid");

});

/* =========================================================
   MOBILE DROPDOWN MENU
========================================================= */

const toggles = document.querySelectorAll(".mobile-toggle");

toggles.forEach(btn => {

    btn.addEventListener("click", function(){

        const submenu = this.nextElementSibling;

        submenu.classList.toggle("hidden");

    });

});


/* =========================================================
   Video Autoplay on Click
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const playBtn = document.getElementById("playVideo");

    if (playBtn) {

        playBtn.addEventListener("click", function () {

            const container = document.getElementById("videoContainer");
            const iframe = container.querySelector("iframe");

            iframe.src = iframe.dataset.src;

            container.classList.remove("hidden");

            document.getElementById("videoThumbnail").style.display = "none";
            playBtn.style.display = "none";

        });

    }

});

</script>

