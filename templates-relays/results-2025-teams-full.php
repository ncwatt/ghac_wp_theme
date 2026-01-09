<?php 
/*
	Template Name: Summer Relays 2025 - Results (Teams) - Full
*/

$teams = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teams WHERE TeamStatus > 1 ORDER BY TeamStatus DESC, TeamTime ASC" ) );
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
					<a href="#" class="btn btn-secondary mb-1">Teams (Full View)</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-individuals' ); ?>" class="btn btn-primary mb-1">Individuals</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-junior-races' ); ?>" class="btn btn-primary mb-1">Junior Races</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-relay-teams-leaderboards' ); ?>" class="btn btn-primary mb-1">Leaderboards</a>
				</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club Name</th>
      						    <th scope="col">Cat.</th>
                                <th scope="col">Status</th>
                                <th scope="col">Runner A</th>
                                <th scope="col">Time</th>
                                <th scope="col">Runner B</th>
                                <th scope="col">Time</th>
                                <th scope="col">Runner C</th>
                                <th scope="col">Time</th>
							    <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($teams as $row) : ?>
                                <tr class="<?php echo ( $overall_pos % 2 == 0 ) ? 'table-secondary' : '' ?>">
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $overall_pos : ''; ?></td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamNumber; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->TeamNumber; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamName; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->TeamName; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td>
                                        <?php 
                                            switch ( $row->Category ) {
                                                case 'Senior Ladies':
                                                    echo 'SL';
                                                    break;
                                                case 'Senior Men':
                                                    echo 'SM';
                                                    break;
                                                case 'Veteran Ladies':
                                                    echo 'VL';
                                                    break;
                                                case 'Veteran Men':
                                                    echo 'VM';
                                                    break;
                                                case 'Uncategorised':
                                                    echo 'U';
                                                    break;
                                                default:
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            switch ( $row->TeamStatus ) {
                                                case 1:
                                                    echo 'Reg';
                                                    break;
                                                case 2:
                                                    echo 'Pre';
                                                    break;
                                                case 3:
                                                    echo 'DNS';
                                                    break;
                                                case 4:
                                                    echo 'DNF';
                                                    break;
                                                case 5:
                                                    echo 'Invalid';
                                                    break;
                                                case 6:
                                                    echo 'Leg 1';
                                                    break;
                                                case 7:
                                                    echo 'Leg 2';
                                                    break;
                                                case 8:
                                                    echo 'Finished';
                                                    break;
                                                default:
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
											if ( ( ( !isset( $row->RunnerAFirstName ) ) || ( $row->RunnerAFirstName == "" ) ) && ( ( !isset( $row->RunnerALastName ) ) || ( $row->RunnerALastName == "" ) ) ) {
												echo "Name Required";
											} else {
												echo $row->RunnerAFirstName . " " . $row->RunnerALastName;
											}
										?>
                                        <sup>
											<?php 
												switch ( $row->RunnerAGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
														break;
													case "Not Selected":
														echo " (U";
														break;
													default:
														"";
												}	
												switch ( $row->RunnerAAge ) {
													case "Senior":
														echo "S)";
														break;
													case "V35":
														echo "V35)";
														break;
													case "V40":
														echo "V40)";
														break;
													case "V45":
														echo "V45)";
														break;
													case "V50":
														echo "V50)";
														break;
													case "V55":
														echo "V55)";
														break;
													case "V60":
														echo "V60)";
														break;
													case "V65":
														echo "V65)";
														break;
													case "V70":
														echo "V70)";
														break;
													case "V75":
														echo "V75)";
														break;
													case "V80":
														echo "V80)";
														break;
													case "V85":
														echo "V85)";
														break;
													case "Not Selected":
														echo "U)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerALegTime ); ?></td>
                                    <td>
                                        <?php 
											if ( ( ( !isset( $row->RunnerBFirstName ) ) || ( $row->RunnerBFirstName == "" ) ) && ( ( !isset( $row->RunnerBLastName ) ) || ( $row->RunnerBLastName == "" ) ) ) {
												echo "Name Required";
											} else {
												echo $row->RunnerBFirstName . " " . $row->RunnerBLastName;
											}
										?>
                                        <sup>
											<?php 
												switch ( $row->RunnerBGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
														break;
													case "Not Selected":
														echo " (U";
														break;
													default:
														"";
												}
												switch ( $row->RunnerBAge ) {
													case "Senior":
														echo "S)";
														break;
													case "V35":
														echo "V35)";
														break;
													case "V40":
														echo "V40)";
														break;
													case "V45":
														echo "V45)";
														break;
													case "V50":
														echo "V50)";
														break;
													case "V55":
														echo "V55)";
														break;
													case "V60":
														echo "V60)";
														break;
													case "V65":
														echo "V65)";
														break;
													case "V70":
														echo "V70)";
														break;
													case "V75":
														echo "V75)";
														break;
													case "V80":
														echo "V80)";
														break;
													case "V85":
														echo "V85)";
														break;
													case "Not Selected":
														echo "U)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerBLegTime ); ?></td>
                                    <td>
                                        <?php 
											if ( ( ( !isset( $row->RunnerCFirstName ) ) || ( $row->RunnerCFirstName == "" ) ) && ( ( !isset( $row->RunnerCLastName ) ) || ( $row->RunnerCLastName == "" ) ) ) {
												echo "Name Required";
											} else {
												echo $row->RunnerCFirstName . " " . $row->RunnerCLastName;
											}
										?>  
                                        <sup>
											<?php 
												switch ( $row->RunnerCGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
														break;
													case "Not Selected":
														echo " (U";
														break;
													default:
														"";
												}
												switch ( $row->RunnerCAge ) {
													case "Senior":
														echo "S)";
														break;
													case "V35":
														echo "V35)";
														break;
													case "V40":
														echo "V40)";
														break;
													case "V45":
														echo "V45)";
														break;
													case "V50":
														echo "V50)";
														break;
													case "V55":
														echo "V55)";
														break;
													case "V60":
														echo "V60)";
														break;
													case "V65":
														echo "V65)";
														break;
													case "V70":
														echo "V70)";
														break;
													case "V75":
														echo "V75)";
														break;
													case "V80":
														echo "V80)";
														break;
													case "V85":
														echo "V85)";
														break;
													case "Not Selected":
														echo "U)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerCLegTime ); ?></td>
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $row->TeamTime : ''; ?></td>
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