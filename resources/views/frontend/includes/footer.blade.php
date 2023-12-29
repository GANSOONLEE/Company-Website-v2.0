
<footer class="footer display-column" id="footer">

    <!-- footer header -->
    {{-- <div class="footer-header display-column">
        <p class="footer-header-title">Site Map</p>
        <p class="footer-header-subtitle"></p>
    </div> --}}

    <!-- footer body -->
    <div class="footer-body">

        <!-- footer links -->
        <div class="footer-link-container">

            <section class="footer-link-section">
                <p class="footer-link-section-title">Contact</p>
                <ul class="footer-link-section-list">
                    <a href="https://youtube.com/@frozenaircondsdnbhd8042"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-brands fa-youtube"></i>Youtube
                    </li></a>
                    <a href="https://www.facebook.com/FrozenForAlatGanti"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-brands fa-facebook"></i>Facebook
                    </li></a>
                    <a href="https://www.tiktok.com/@alatganti_aircond_ahseng"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-brands fa-tiktok"></i>Tiktok
                    </li></a>
                    <a href="https://www.wasap.my/60172430100"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-brands fa-whatsapp"></i>Whatapps
                    </li></a>
                </ul>
            </section>

            <section class="footer-link-section">
                <p class="footer-link-section-title">Site</p>
                <ul class="footer-link-section-list">
                    <a href="#"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-solid fa-house"></i>Home
                    </li></a>
                    <a href="#"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-solid fa-address-card"></i>About Us
                        </li></a>
                    <a href="#"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-solid fa-cube"></i>Product
                    </li></a>
                    <a href="#"><li class="flex justify-start gap-x-[.25rem] footer-link">
                        <i class="fa-solid fa-envelope"></i>Contact
                    </li></a>
                </ul>
            </section>

            <section class="footer-link-section">
                <p class="footer-link-section-title">Policy</p>
                <ul class="footer-link-section-list">
                    <a href="{{ route('policy.privacy-policy') }}" target="_blank"><li class="footer-link">
                        Privacy Policy
                    </li></a>
                    <a href="{{ route('policy.terms-of-use') }}" target="_blank"><li class="footer-link">
                        Terms of Use
                    </li></a>
                </ul>
            </section>

        </div>

        <!-- shop information -->
        <div class="company-information flex-column">

            <!-- company name -->
            <div class="company-name">
                <p class="company-name-text">Frozen Air Cond Sdn Bhd</p>
            </div>

            <!-- information area -->
            <div class="information-area">

                <!-- address & contact number -->
                <div>
                    <div class="contact-number">
                        <i class="fa-solid fa-phone"></i>
                        <p>017-243 0100</p>
                    </div>
                    <div class="address">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>No.5 ,Jalan Emas 5,<br>
                        Taman Emas, Hulu Yam, <br>
                        44300 Hulu Yam, Selangor.</p>
                    </div>
                </div>
                
                <!-- google map -->
                <div class="google-map">
                    <iframe title="Google Map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.5705456242517!2d101.63097927259881!3d3.45405444353573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc6d8d2f518695%3A0xc1c2470ad30300fe!2sFrozen%20air%20cond%20sdn%20bhd!5e0!3m2!1sen!2smy!4v1688700665979!5m2!1sen!2smy" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </div>

    <!-- copyright & author -->
    <div class="footer-footer">
        <p class="copy-right">
            TM © 2023
            <?php echo (date('Y') > 2023) ? date('- Y') : ''; ?>
            {{ env('APP_NAME') }} - All Rights Reserved
        </p>
        <p class="website-author">
            <a href="https://github.frankgan.com">Development by Frank Gan</a>
        </p>
    </div>

</footer>