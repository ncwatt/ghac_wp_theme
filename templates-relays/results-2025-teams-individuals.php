<?php 
/*
	Template Name: Summer Relays 2025 - Results (Individuals)
*/

$results = $wpdb->get_results( $wpdb->prepare( 
    "SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' " . 
    "ORDER BY LegTime ASC;" ) );
$overall_pos = 1;
$filter_pos = 1;
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
                    <a href="#" class="btn btn-secondary mb-1">Individuals</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-junior-races' ); ?>" class="btn btn-primary mb-1">Junior Races</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-leaderboards' ); ?>" class="btn btn-primary mb-1">Leaderboards</a>
				</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
      						    <th scope="col">Gender</th>
							    <th scope="col">Age Cat.</th>
                                <th scope="col">Leg Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($results as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->RunnerNumber; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->RunnerNumber; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->RunnerName; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->RunnerName; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td>
                                        <?php
                                            switch ( $row->Gender ) {
                                                case "Female":
                                                    echo "F";
                                                    break;
                                                case "Male":
                                                    echo "M";
                                                    break;
                                                case "Not Selected":
                                                    echo "U";
                                                    break;
                                                default:
                                                    "";
                                            }
                                        ?>
                                    </td>
                                    <td>
										<?php 
											switch ( $row->AgeCategory ) {
                                                case "Senior":
                                                    echo "S";
                                                    break;
                                                case "V35":
                                                    echo "V35";
                                                    break;
                                                case "V40":
                                                    echo "V40";
                                                    break;
                                                case "V45":
                                                    echo "V45";
                                                    break;
                                                case "V50":
                                                    echo "V50";
                                                    break;
                                                case "V55":
                                                    echo "V55";
                                                    break;
                                                case "V60":
                                                    echo "V60";
                                                    break;
                                                case "V65":
                                                    echo "V65";
                                                    break;
                                                case "V70":
                                                    echo "V70";
                                                    break;
                                                case "V75":
                                                    echo "V75";
                                                    break;
                                                case "V80":
                                                    echo "V80";
                                                    break;
                                                case "V85":
                                                    echo "V85";
                                                    break;
                                                case "Not Selected":
                                                    echo "U";
                                                    break;
                                                default:
                                                    echo "";
                                            }
										?>
                                    </td>
                                    <td><?php echo ( $row->LegTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>

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