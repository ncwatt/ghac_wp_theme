<?php 
/*
	Template Name: Summer Relays - Teams List
*/
// Check that the user is logged in or has a valid team editor session
if ( ( ! is_user_logged_in() )  && ( ! isset( $_SESSION['relays_user_email'] ) ) ) { wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/summer-relays-login' ) ); }

// Determine if the user is an administrator or not
$user = wp_get_current_user();
if ( is_user_in_role( 'administrator' ) ) { $isAdmin = true; } else { $isAdmin = false; }
if ( is_user_in_role( 'subscriber' ) ) { $isSubscriber = true; } else { $isSubscriber = false; }
?>
<?php get_header(); ?>
<div class="page-padding content-1">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1><?php the_title(); ?></h1>
				<?php if ( is_user_in_role( 'administrator' ) ) : ?>
					<p>
						<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/add-team' ) ?>" class="btn btn-primary">Add Team</a>&nbsp;&nbsp;
						<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/add-time' ) ?>" class="btn btn-primary">Add Times</a>
					</p>
				<?php endif; ?>
				<div class="table-responsive">
					<table class="table">
						<thead>
    						<tr>
      							<th scope="col">#</th>
      							<th scope="col">Team Name</th>
      							<th scope="col">Club Name</th>
      							<th scope="col">Category</th>
								<?php if ( $isAdmin == true ) : ?>
									<th scope="col">Status</th>
									<th scope="col">Gun Time</th>
								<?php endif; ?>
								<th scope="col">Runner A</td>
								<th scope="col">Runner B</td>
								<th scope="col">Runner C</td>
    						</tr>
  						</thead>
						<tbody>
							<?php
								// If user is an admin get all of the teams, otherwise just the ones relevant to the particular session
								if ( $isAdmin == true  || $isSubscriber == true ) :
									$teams = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teams" ) );
								else :
									$teams = $wpdb->get_results( $wpdb->prepare( 
										"SELECT {$wpdb->prefix}ghac_sr25_teams.TeamID, {$wpdb->prefix}ghac_sr25_teams.TeamNumber, " .
												"{$wpdb->prefix}ghac_sr25_teams.TeamName, {$wpdb->prefix}ghac_sr25_teams.ClubName, {$wpdb->prefix}ghac_sr25_teams.Category, " . 
												"{$wpdb->prefix}ghac_sr25_teams.RunnerAFirstName, {$wpdb->prefix}ghac_sr25_teams.RunnerALastName, {$wpdb->prefix}ghac_sr25_teams.RunnerATime, {$wpdb->prefix}ghac_sr25_teams.RunnerALegTime, {$wpdb->prefix}ghac_sr25_teams.RunnerAGender, {$wpdb->prefix}ghac_sr25_teams.RunnerAAge, " . 
												"{$wpdb->prefix}ghac_sr25_teams.RunnerBFirstName, {$wpdb->prefix}ghac_sr25_teams.RunnerBLastName, {$wpdb->prefix}ghac_sr25_teams.RunnerBTime, {$wpdb->prefix}ghac_sr25_teams.RunnerBLegTime, {$wpdb->prefix}ghac_sr25_teams.RunnerBGender, {$wpdb->prefix}ghac_sr25_teams.RunnerBAge, " .
												"{$wpdb->prefix}ghac_sr25_teams.RunnerCFirstName, {$wpdb->prefix}ghac_sr25_teams.RunnerCLastName, {$wpdb->prefix}ghac_sr25_teams.RunnerCTime, {$wpdb->prefix}ghac_sr25_teams.RunnerCLegTime, {$wpdb->prefix}ghac_sr25_teams.RunnerCGender, {$wpdb->prefix}ghac_sr25_teams.RunnerCAge, " .
												"{$wpdb->prefix}ghac_sr25_teams.TeamTime " .
											"FROM {$wpdb->prefix}ghac_sr25_teams " .
												"INNER JOIN {$wpdb->prefix}ghac_sr25_teamemails ON {$wpdb->prefix}ghac_sr25_teams.TeamID = {$wpdb->prefix}ghac_sr25_teamemails.TeamID " .
												"INNER JOIN {$wpdb->prefix}ghac_sr25_emails ON {$wpdb->prefix}ghac_sr25_teamemails.EmailID = {$wpdb->prefix}ghac_sr25_emails.EmailID " .
											"WHERE {$wpdb->prefix}ghac_sr25_emails.EmailAddress = %s", $_SESSION['relays_user_email'] 
										)
									);
								endif;
							
								foreach($teams as $row) {
							?>
								<tr>
									<th scope="row"><a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamNumber; ?></a></th>
									<td><a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamName ?></a></td>
									<td><?php echo $row->ClubName; ?></td>
									<td><?php echo $row->Category; ?></td>
									<?php if ( $isAdmin == true ) : ?>
										<td>
											<?php 
                                            	switch ( $row->TeamStatus ) {
                                                	case 1:
                                                    	echo 'Registration';
                                                    	break;
                                                	case 2:
                                                    	echo 'Pre-Race';
                                                    	break;
                                                	case 3:
                                                    	echo 'Did Not Start';
                                                    	break;
                                                	case 4:
                                                    	echo 'Did Not Finish';
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
										<td><?php echo $row->TeamTime; ?></td>
									<?php endif; ?>
									<td>
										<?php echo $row->RunnerAFirstName . " " . $row->RunnerALastName; ?>
										<sup>
											<?php 
												switch ( $row->RunnerAGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
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
													default:
														echo "";
												}
											?>
										</sup>
									</td>
									<td>
										<?php echo $row->RunnerBFirstName . " " . $row->RunnerBLastName; ?>
										<sup>
											<?php 
												switch ( $row->RunnerBGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
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
													default:
														echo "";
												}
											?>
										</sup>
									</td>
									<td>
										<?php echo $row->RunnerCFirstName . " " . $row->RunnerCLastName; ?>
										<sup>
											<?php 
												switch ( $row->RunnerCGender ) {
													case "Female":
														echo " (F";
														break;
													case "Male":
														echo " (M";
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
													default:
														echo "";
												}
											?>
										</sup>
									</td>
								</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>