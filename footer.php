    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 order-1">
                    <h5>Gosforth Harriers &amp; Athletics Club</h5>
                    <p>Great Park Community Centre</p>
                    <p>Roseden Way</p>
                    <p>Newcastle upon Tyne</p>
                    <p>NE13 9BD</p>
                    <ul class="follow-icons">
                        <li><a href="https://www.facebook.com/profile.php?id=61570961411901" target="_blank"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="https://twitter.com/Gosforth_HandAC" target="_blank"><i class="bi bi-twitter-x"></i></a></li>
                        <li><a href="https://www.instagram.com/gosforthharriers" target="_blank"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="https://www.threads.com/@gosforthharriers" target="_blank"><i class="bi bi-threads"></i></a></li>
                        <li><a href="https://www.strava.com/clubs/47387" target="_blank"><i class="bi bi-strava"></i></a></li>
                        <li><a href="https://www.youtube.com/@GosforthHarriers" target="_blank"><i class="bi bi-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 order-3 order-md-2 pt-3 pt-md-0">
                    <div class="affiliates">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsor-jra-logo.png" class="jra" alt="JRA Consultancy" data-bs-toggle="modal" data-bs-target="#modalJRAConsultancy" />
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sponsor-malone-logo.jpg" class="malone" alt="Malone Mechanical Services Engineers" data-bs-toggle="modal" data-bs-target="#modalMaloneMSE" />
                    </div>
                </div>
                <div class="col-6 col-md-4 order-2 order-md-3">
                    <div class="useful-links">
                        <h5>Useful Links</h5>
                        <?php 
					        wp_nav_menu (
						        array ( 
							        'theme_location'	=> 'useful-links',
							        'container'			=> 'li',
							        'container_class'	=> '',
							        'menu_class'		=> 'useful-links-ul',
							        'add_li_class'		=> ''
						        )
					        ); 
				        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="copyright">
                        <p>&copy; Copyright <?php echo date("Y"); ?> | All rights reserved | Privacy Policy</p>
                        <p>Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a> | Theme by <a href="https://gtctek.co.uk/" target="_blank">Gtctek</a> | Admin <a href="/wp-admin">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- JRA Consultancy -->
    <div class="modal fade" id="modalJRAConsultancy" tabindex="-1" aria-labelledby="modalJRAConsultancyHeading" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalJRAConsultancyHeading">JRA Consultancy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        When managing large end user computing estate, it's not always easy to see where you can add more value, protect your people and technology, and drive
                        a return on sizeable investment.
                    </p>
                    <p>
                        JRA allows customers to gain a simple and user-friendly visibility of their hardward and software assets, which is making a tangible difference
                        on a global scale.
                    </p>           
                    <p>
                        Driven by a shared sense of purpose to make a real difference by providing deep understanding through actionable insignts and data, JRA helps
                        businesses to work more effectively.
                    </p>
                    <p>
                        <i class="bi bi-browser-edge"></i>: <a href="https://www.jra-consultancy.co.uk" target="_blank">jra-consultancy.co.uk</a><br />
                        <i class="bi bi-envelope-at"></i>: <a href="mailto:info@jra-consultancy.co.uk">info@jra-consultancy.co.uk</a><br />
                        <i class="bi bi-telephone"></i>: <a href="tel: +441914909307">+44 (0) 191 490 9307</a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Malone -->
    <div class="modal fade" id="modalMaloneMSE" tabindex="-1" aria-labelledby="modalMaloneMSEHeading" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalMaloneMSEHeading">Malone Mechanical Services Engineers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Malone has extensive experience in providing M&E installations for a diverse range of projects up to the value of £9m, from small works and
                        maintenance to full building restorations and new build schools, colleges, academies, leisure centres, office blocks, public buildings and
                        government buildings.
                    </p>
                    <p>
                        They have a strong management team adept at planning, developing, costing and delivering the most challenging of projects. With a directly
                        employed workforce, backed by an award winning training and deveopment programme, Malone is capable of dealing with any task with confidence and
                        enthusiasm.
                    </p>           
                    <p>
                        <i class="bi bi-browser-edge"></i>: <a href="https://www.hmalone.co.uk/" target="_blank">www.hmalone.co.uk</a><br />
                        <i class="bi bi-envelope-at"></i>: <a href="mailto:enquiries@hmalone.co.uk">enquiries@hmalone.co.uk</a><br />
                        <i class="bi bi-telephone"></i>: <a href="tel: +441912851176">+44 (0) 191 285 1176</a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>