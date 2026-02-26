{{-- ===============================
    PREMIUM BLUE FOOTER
================================= --}}
<footer class="relative mt-10">

    {{-- ===== WAVE TOP (BIRU) ===== --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none rotate-180">
        <svg class="relative block w-full h-10"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 1200 120"
             preserveAspectRatio="none">
            <path d="M321.39,56.44C191.41,89.64,0,54.13,0,54.13V0H1200V27.35c-86.16,14.4-172.28,29.16-258.44,27.63C771.19,52.06,651.37,8.18,521.29,23.49,421.74,35.37,371.51,43.88,321.39,56.44Z"
                  class="fill-blue-900"></path>
        </svg>
    </div>

    {{-- ===== GLASS BLUE PANEL ===== --}}
    <div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950
                backdrop-blur-xl text-white pt-28 pb-10 px-6">

        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-12">

            {{-- ===== KONTAK ===== --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-yellow-400">
                    Kontak Kami
                </h3>

                <p class="text-sm text-blue-100 mb-2">
                    📍 Jl. Kp. Ciketing Asem Jaya No.01, RT.004/RW.005, Mustikajaya, Kec. Mustika Jaya, Kota Bks, Jawa Barat 17158
                </p>

                <p class="text-sm text-blue-100 mb-2">
                    📞 02182610808
                </p>

                <p class="text-sm text-blue-100 mb-4">
                    ✉ info@smk-smptintaemas.sch.id
                </p>

                {{-- SOCIAL MEDIA --}}
                <div class="flex gap-4 mt-4">

                    <a href="https://facebook.com" target="_blank" class="social-icon-blue">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="https://youtube.com" target="_blank" class="social-icon-blue">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="https://instagram.com" target="_blank" class="social-icon-blue">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://tiktok.com" target="_blank" class="social-icon-blue">
                        <i class="fab fa-tiktok"></i>
                    </a>

                </div>
            </div>


            {{-- ===== MENU CEPAT ===== --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-yellow-400">
                    Menu Cepat
                </h3>

                <ul class="space-y-2 text-sm text-blue-100">
                    <li><a href="/" class="footer-link-blue">Beranda</a></li>
                    <li><a href="#" class="footer-link-blue">Profil</a></li>
                    <li><a href="{{ route('frontend.posts.index') }}" class="footer-link-blue">Berita</a></li>
                    <li><a href="#" class="footer-link-blue">Kontak</a></li>
                </ul>
            </div>


            {{-- ===== GOOGLE MAPS ===== --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-yellow-400">
                    Lokasi Kami
                </h3>

                <div class="rounded-xl overflow-hidden shadow-xl border border-blue-700/30">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7393845431966!2d107.0237294!3d-6.297937900000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699198f3bc4929%3A0x8f8b6c3cc53dc7cf!2sSMP-SMK%20Tinta%20Emas%20Indonesia%20(Yatindo)!5e0!3m2!1sen!2sid!4v1770870069164!5m2!1sen!2sid"
                        width="100%" 
                        height="180"
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>

        {{-- COPYRIGHT --}}
        <div class="text-center text-xs text-blue-200 mt-10 border-t border-blue-700/40 pt-6">
            © {{ date('Y') }} SMK & SMP Tinta Emas Indonesia. All Rights Reserved.
        </div>

    </div>

</footer>

