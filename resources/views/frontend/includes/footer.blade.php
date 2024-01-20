<footer class="relative footer display-column !bg-[#414141] z-9999" id="footer">

    <img src="https://w0.peakpx.com/wallpaper/466/1011/HD-wallpaper-blue-snowflake-in-black-background-snowflake-thumbnail.jpg"
        class="z-1 absolute top-0 left-0 w-full h-full object-cover opacity-[0.20]" alt="">
    <!-- footer header -->
    {{-- <div class="footer-header display-column">
        <p class="footer-header-title">Site Map</p>
        <p class="footer-header-subtitle"></p>
    </div> --}}

    <!-- footer body -->
    <div class="footer-body z-9 relative top-0 left-0">

        <!-- footer links -->
        <div class="footer-link-container pr-6">

            <!-- Follow Us -->
            <section class="footer-link-section">
                <p class="footer-link-section-title !text-footer-cyan whitespace-nowrap">Follow Us</p>
                <ul class="footer-link-section-list">
                    <a href="https://youtube.com/@frozenaircondsdnbhd8042">
                        <li class="flex justify-start gap-x-[.25rem] footer-link !text-white hover:!text-blue-500">
                            <i class="fa-brands fa-youtube !text-[red]"></i>Youtube
                        </li>
                    </a>
                    <a href="https://www.facebook.com/FrozenForAlatGanti">
                        <li class="flex justify-start gap-x-[.25rem] footer-link !text-white hover:!text-blue-500">
                            <i class="fa-brands fa-facebook !text-[#4267B2]"></i>Facebook
                        </li>
                    </a>
                    <a href="https://www.tiktok.com/@alatganti_aircond_ahseng">
                        <li class="flex justify-start gap-x-[.25rem] footer-link !text-white hover:!text-blue-500">
                            <i class="fa-brands fa-tiktok !text-white"></i>Tiktok
                        </li>
                    </a>

                </ul>
            </section>

            <!-- Contact Us -->
            <section class="footer-link-section">
                <p class="footer-link-section-title flex gap-x-[1rem] !text-footer-gold whitespace-nowrap">
                    Contact Us
                    <i class="fa-solid fa-phone"></i>
                </p>
                <ul class="footer-link-section-list !text-white">
                    <a href="https://www.wasap.my/60172430100">
                        <li class="flex justify-center md:justify-start gap-x-[.25rem] footer-link !text-white hover:!text-blue-500 whitespace-nowrap">
                            <i class="fa-brands fa-whatsapp !text-[green]"></i>017-243 0100
                        </li>
                    </a>
                </ul>
            </section>

            <!-- T&C -->
            <section class="footer-link-section">
                <p class="footer-link-section-title text-center md:!text-start !text-footer-thinker whitespace-nowrap">Policy</p>
                <ul class="footer-link-section-list !text-white">
                    <a href="{{ route('policy.privacy-policy') }}" target="_blank">
                        <li class="footer-link whitespace-nowrap hover:!text-blue-500">
                            Privacy Policy
                        </li>
                    </a>
                    <a href="{{ route('policy.terms-of-use') }}" target="_blank">
                        <li class="footer-link whitespace-nowrap hover:!text-blue-500">
                            Terms of Use
                        </li>
                    </a>
                </ul>
            </section>

            <!-- Address -->
            <section class="footer-link-section">
                <p class="footer-link-section-title text-center md:!text-start !text-footer-green whitespace-nowrap">Address</p>
                <div class="footer-link-section-list !text-white w-max font-sans">
                    No.1 & 5 ,Jalan Emas 5,<br>
                    Taman Emas, Hulu Yam, <br>
                    44300 Hulu Yam, Selangor.
                </div>
            </section>

            <!-- Google Map -->
            <section class="footer-link-section">
                <p class="footer-link-section-title !text-footer-blue whitespace-nowrap">Frozen Air Cond Sdn Bhd</p>
                <iframe title="Google Map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.5705456242517!2d101.63097927259881!3d3.45405444353573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc6d8d2f518695%3A0xc1c2470ad30300fe!2sFrozen%20air%20cond%20sdn%20bhd!5e0!3m2!1sen!2smy!4v1688700665979!5m2!1sen!2smy"
                    width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>

        </div>

    </div>

    <!-- copyright & author -->
    <div class="relative footer-footer z-9 text-white">
        <p class="copy-right">
            TM © 2023
            <?php echo date('Y') > 2023 ? date('- Y') : ''; ?>
            {{ env('APP_NAME') }} - All Rights Reserved
        </p>
        <p class="website-author">
            <a href="https://github.frankgan.com">Development by Frank Gan</a>
        </p>
    </div>

</footer>
