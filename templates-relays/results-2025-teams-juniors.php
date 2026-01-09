<?php 
/*
	Template Name: Summer Relays 2025 - Results (Junior)
*/

$u11Girls = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Female' AND Category = 'U11' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
$u11Boys = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Male' AND Category = 'U11' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
$u13Girls = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Female' AND Category = 'U13' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
$u13Boys = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Male' AND Category = 'U13' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
$u16Girls = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Female' AND Category = 'U16' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
$u16Boys = $wpdb->get_results( $wpdb->prepare( "SELECT *, CONCAT(FirstName, ' ', LastName) AS RunnerName from {$wpdb->prefix}ghac_sr25_juniors WHERE Gender = 'Male' AND Category = 'U16' AND GunTime <> '00:00:00' ORDER BY GunTime ASC, TimeOrder ASC;" ) );
?>
<?php get_header(); ?>
<div class="page-padding content-1">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1><?php the_title(); ?></h1>
                <div class="alert alert-danger">
                    <p style="text-align: center;">Results are provisional and amendments may be made whilst this message is displayed.</p>
                </div>
                <div class="alert alert-info">
                    <p>Click one of the buttons below to access alternative results views.</p>
                </div>
                <p>
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-condensed' ); ?>" class="btn btn-primary mb-1">Teams (Condensed View)</a>&nbsp;&nbsp;
					<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-full' ); ?>" class="btn btn-primary mb-1">Teams (Full View)</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-individuals' ); ?>" class="btn btn-primary mb-1">Individuals</a>&nbsp;&nbsp;
                    <a href="#" class="btn btn-secondary mb-1">Junior Races</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-leaderboards' ); ?>" class="btn btn-primary mb-1">Leaderboards</a>
				</p>
                <h2>U11 Girls</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u11Girls as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">U11 Boys</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u11Boys as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">U13 Girls</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u13Girls as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">U13 Boys</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u13Boys as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">U16 Girls</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u16Girls as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">U16 Boys</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($u16Boys as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td><?php echo $row->RunnerNumber; ?></td>
                                    <td><?php echo $row->RunnerName; ?></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo ( $row->GunTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="advert-before">Advert</div>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3066787831298040" crossorigin="anonymous"></script>
                <!-- GHAC Responsive Ad -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-3066787831298040"
                    data-ad-slot="8378213731"
                    data-ad-format="auto"
                    data-full-width-responsive="true">
                </ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <div class="advert-after"></div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>