<?php 
/*
	Template Name: Summer Relays - Edit Team
*/
// Check that the user is logged in - if not redirect to login page
if ( ( ! is_user_logged_in() )  && ( ! isset( $_SESSION['relays_user_email'] ) ) ) { wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/summer-relays-login' ) ); }

// Determine if the user is an administrator or not
$user = wp_get_current_user();
if ( is_user_in_role( 'administrator' ) ) { $isAdmin = true; } else { $isAdmin = false; }
if ( is_user_in_role( 'subscriber' ) ) { $isSubscriber = true; } else { $isSubscriber = false; }

// Get the TeamID from the QueryString. If there isn't one then leave the page.
if ( isset( $_GET['teamid'] ) ) { 
	$teamID = $_GET['teamid'];
	if ( $isAdmin || $isSubscriber ) :
		$team = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teams WHERE TeamID = %d", $teamID ) );
	else:
		$team = $wpdb->get_row( $wpdb->prepare( 
			"SELECT * FROM {$wpdb->prefix}ghac_sr25_teams " . 
					"INNER JOIN {$wpdb->prefix}ghac_sr25_teamemails ON {$wpdb->prefix}ghac_sr25_teams.TeamID = {$wpdb->prefix}ghac_sr25_teamemails.TeamID " .
					"INNER JOIN {$wpdb->prefix}ghac_sr25_emails ON {$wpdb->prefix}ghac_sr25_teamemails.EmailID = {$wpdb->prefix}ghac_sr25_emails.EmailID " .
				"WHERE {$wpdb->prefix}ghac_sr25_teams.TeamID = %d AND {$wpdb->prefix}ghac_sr25_emails.EmailAddress = %s", array( $teamID, $_SESSION['relays_user_email'] )
			) 
		);
	endif;
	
	// Check that the TeamID is valid
	if ( ! isset( $team ) ) { wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) ); }
} else {
	wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) );
}

if ( $_SERVER["REQUEST_METHOD"] == "GET" ) {
	$teamNum = $team->TeamNumber;
	$teamName = $team->TeamName;
	$teamStatus = $team->TeamStatus;
	$clubName = $team->ClubName;
	$category = $team->Category;
	$runnerAFirstName = $team->RunnerAFirstName;
	$runnerALastName = $team->RunnerALastName;
	$runnerAGender = $team->RunnerAGender;
	$runnerAAge = $team->RunnerAAge;
	$runnerATime = $team->RunnerATime;
	$runnerALegTime = $team->RunnerALegTime;
	$runnerBFirstName = $team->RunnerBFirstName;
	$runnerBLastName = $team->RunnerBLastName;
	$runnerBGender = $team->RunnerBGender;
	$runnerBAge = $team->RunnerBAge;
	$runnerBTime = $team->RunnerBTime;
	$runnerBLegTime = $team->RunnerBLegTime;
	$runnerCFirstName = $team->RunnerCFirstName;
	$runnerCLastName = $team->RunnerCLastName;
	$runnerCGender = $team->RunnerCGender;
	$runnerCAge = $team->RunnerCAge;
	$runnerCTime = $team->RunnerCTime;
	$runnerCLegTime = $team->RunnerCLegTime;
	$teamTime = $team->TeamTime;
}

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if ( isset( $_POST['editTeamForm'] ) ) {
		// Get the values from the form
		$teamNum = $isAdmin ? form_input_checks( $_POST['teamNumber'] ) : form_input_checks( $_POST['teamNumberH'] );
		$teamName = form_input_checks( $_POST['teamName'] );
		$teamStatus = $isAdmin ? form_input_checks( $_POST['teamStatus'] ) : form_input_checks( $_POST['teamStatusH'] );
		$category = form_input_checks( $_POST["categoryH"] );
		$clubName = form_input_checks( $_POST['clubName'] );
		$runnerAFirstName = form_input_checks( $_POST['runnerAFirstName'] );
		$runnerALastName = form_input_checks( $_POST['runnerALastName'] );
		$runnerAGender = form_input_checks( $_POST['runnerAGender'] );
		$runnerAAge = form_input_checks( $_POST['runnerAAge'] );
		$runnerATime = $isAdmin ? form_input_checks( $_POST['runnerATime'] ) : form_input_checks( $_POST['runnerATimeH'] );
		$runnerALegTime = form_input_checks( $_POST['runnerALegTime'] );
		$runnerBFirstName = form_input_checks( $_POST['runnerBFirstName'] );
		$runnerBLastName = form_input_checks( $_POST['runnerBLastName'] );
		$runnerBGender = form_input_checks( $_POST['runnerBGender'] );
		$runnerBAge = form_input_checks( $_POST['runnerBAge'] );
		$runnerBTime = $isAdmin ? form_input_checks( $_POST['runnerBTime'] ) : form_input_checks( $_POST['runnerBTimeH'] );
		$runnerBLegTime = form_input_checks( $_POST['runnerBLegTime'] );
		$runnerCFirstName = form_input_checks( $_POST['runnerCFirstName'] );
		$runnerCLastName = form_input_checks( $_POST['runnerCLastName'] );
		$runnerCGender = form_input_checks( $_POST['runnerCGender'] );
		$runnerCAge = form_input_checks( $_POST['runnerCAge'] );
		$runnerCTime = $isAdmin ? form_input_checks( $_POST['runnerCTime'] ) : form_input_checks( $_POST['runnerCTimeH'] );
		$runnerCLegTime = form_input_checks( $_POST['runnerCLegTime'] );
		$teamTime = form_input_checks( $_POST['teamTime'] );
		$firstName = form_input_checks( $_POST["firstName"] );
		$lastName = form_input_checks( $_POST["lastName"] );
		$email = form_input_checks( $_POST["emailAddress"] );

		// Loop through all posted items from the form to see if any refer to deleting an email address
		foreach ( $_POST as $postItemName => $postItemValue ) {
			if ( substr( $postItemName, 0, 8 ) == 'delEmail' ) {
				$delEmailArray = explode( ';', $postItemValue );
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}ghac_sr25_teamemails WHERE TeamID = %d AND EmailID = %d;", array( $teamID, $delEmailArray[0] ) ) );
				if ( empty( $wpdb->last_error ) ) {
					$delEmailToast = $delEmailArray[1] . ' has been deleted from the team.';	
				} else {
					$delEmailToast = 'There was an error deleting the email address from the team.';
				}
			}
		}

		// Only process this if the add contact button has been clicked
		if ( isset( $_POST['submitContact'] ) ) {
			// Set contactSuccess to true - this will get set to false during validation if a value fails
			$contactSuccess = true;
			$errors = array();

			// Validate the first name
			$firstNameErr = false;
			if ( ! ( strlen( $firstName ) > 0 && strlen( $firstName ) <= 35 ) ) {
				$firstNameErr = true;
				$errors[] = 'You have not entered the first name of the new club contact';
				$contactSuccess = false;
			}

			// Validate the last name
			$lastNameErr = false;
			if ( ! ( strlen( $lastName ) > 0 && strlen( $lastName ) <= 35 ) ) {
				$lastNameErr = true;
				$errors[] = 'You have not entered the last name of the new lub contact';
				$contactSuccess = false;
			}

			// Validate email address
			$emailErr = false;
        	if ( ! ( strlen( $email ) > 0 ) ) {
				$emailErr = true;
				$errors[] = 'You have not entered the email address of the new club contact';
				$contactSuccess = false;
			} elseif ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) { 
            	$emailErr = true;
				$errors[] = 'The email address entered is not valid';
            	$contactSuccess = false;
        	}

			if ( $contactSuccess ) {
				// Check if the email address is already in the table
				$emailID = $wpdb->get_var( $wpdb->prepare( "SELECT EmailID FROM {$wpdb->prefix}ghac_sr25_emails WHERE EmailAddress = %s", $email ) );
				if ( ! isset( $emailID ) ) {
					// Insert the email into the table
					$wpdb->insert( "{$wpdb->prefix}ghac_sr25_emails", array(
						'EmailAddress' => $email,
						'FirstName' => $firstName,
						'LastName' => $lastName
					) );
					// Get the emailID for the newly inserted record
					$emailID = $wpdb->insert_id;
				} else {
					// Update the name and last name for the email address supplied
					$wpdb->update( 
						"{$wpdb->prefix}ghac_sr25_emails", 
						array(
							'FirstName' => $firstName,
							'LastName' => $lastName
						),
						array(
							'EmailID' => $emailID
						)
					);
				}
	
				// Insert link the team and the email address
				$wpdb->insert( "{$wpdb->prefix}ghac_sr25_teamemails", 
					array(
						'TeamID' => $teamID,
						'EmailID' => $emailID
					) 
				);

				// Let's send the person an email to tell them.
				$emailSubject = 'Gosforth Harriers Summer Relays - Club Contact: ' . $teamName;
            	$emailBody = 'Hi ' . $firstName;
            	$emailBody = $emailBody . '<br /><br />You have been added as a club contact for team ' . $teamName . ' which is running for ' . $clubName . ' in the Gosforth Summer Relays.';
            	$emailBody = $emailBody . '<br /><br />We have introduced a registration process which puts you in control up until when you pick up your race numbers on Sunday 3rd August 2025. At this stage the teams will be locked and you will need to speak to one of our amazing administration team to make any changes. ';
				$emailBody = $emailBody . '<br /><br />To enable this we have built our very own team manager which will allow you to select the catgory for your team, update your runners, add additional admins and have some fun coming up with team names (let\'s keep them clean!).';
            	$emailBody = $emailBody . '<br /><br />To access the team manager click on the following link:';
            	$emailBody = $emailBody . '<br /><br /><a href="' . get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) . '">Go to the Gosforth Summer Relays Team Manager</a>';
				$emailBody = $emailBody . '<br /><br />You may receive more emails similar to this depending on how many teams you are added to. We would never spam you, this is perfectly normal. It\'s just how our system works to get you registered with all of your teams. All you need is the link above to access the team manager which will allow you to administer all of your teams easily and conveniently.';
				$emailBody = $emailBody . '<br /><br />If you experience any issues with the team manager, don\'t worry we won\'t run off and leave you behind (we\'ll keep that for the event). All you need to do is reply to this email and our webmaster will answer your query.';
            	$emailBody = $emailBody . '<br /><br />For now, keep the training going! We look forward to seeing your teams on Sunday 3rd August 2025.';
				$emailBody = $emailBody . '<br /><br />Gosforth Harriers & AC';
				$headers[] = 'Content-Type: text/html; charset=UTF-8';
            	$headers[] = 'Reply-To: Gosforth Harriers <webmaster@gosforth-harriers.org>';

            	if (wp_mail($email, $emailSubject, $emailBody, $headers) == false) {
                	$sendErr = true;
                	$postSuccess = false;
            	}

				// Reset the add contact values
				$firstName = "";
				$firstNameErr = null;
				$lastName = "";
				$lastNameErr = null;
				$email = "";
				$emailErr = null;
				$contactSuccess = null;
			}
		}

		// Only process this if the submit (save changes) button has been clicked
		if ( isset( $_POST['submit'] ) ) {
			// Set postSuccess to true - this will get set to false during validation if a value fails
			$postSuccess = true;
			$errors = array();
	
			// Validate team number
			$teamNumErr = false;
			$team_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teams WHERE TeamNumber = %d AND TeamID <> %d", array( $teamNum, $teamID ) );
			$team_results = $wpdb->get_results( $team_query );
			if ( ! empty( $team_results ) ) {
				$teamNumErr = true;
				$errors[] = 'The team number you entered is already in use';
				$postSuccess = false;
			} elseif ( ( $teamNum == 0 ) || ( strlen( $teamNum ) == 0 ) ) {
				$teamNumErr = true;
				$errors[] = 'You must enter a team number';
				$postSuccess = false;
			}
			
			// Validate team name
			$teamNameErr = false;
			$team_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teams WHERE TeamName = %s AND TeamID <> %d", array( $teamName, $teamID ) );
			$team_results = $wpdb->get_results( $team_query );
			if ( !empty( $team_results ) ) {
				$teamNameErr = true;
				$errors[] = 'The team name you entered already exists';
				$postSuccess = false;
			}

			if ( ! ( strlen( $teamName ) > 0 && strlen( $teamName ) <= 50) ) {
				// A team name hasn't been entered
				$teamNameErr = true;
				$errors[] = 'You have not entered a team name or have used more than the allowed 50 characters';
				$postSuccess = false;
			}
	
			// Validate the club name
			$clubNameErr = false;
			if ( ! ( strlen( $clubName ) > 0 && strlen( $clubName ) <= 75) ) {
				$clubNameErr = true;
				$errors[] = 'You have not entered the running club name that this team is associated with or have used more than the allowed 75 characters';
				$postSuccess = false;
			}
			
			// Validate Runner B time
			$runnerBTimeErr = false;
			if ( ( $runnerBTime != '00:00:00' ) &&  ( strtotime( $runnerBTime ) <= strtotime( $runnerATime ) ) ) {
				$runnerBTimeErr = true;
				$errors[] = 'Runner B\'s time is less than or equal to Runner A\'s.';
				$postSuccess = false;
			}

			// Validate Runner C time
			$runnerCTimeErr = false;
			if ( ( $runnerCTime != '00:00:00' ) &&  ( strtotime( $runnerCTime ) <= strtotime( $runnerBTime ) ) ) {
				$runnerCTimeErr = true;
				$errors[] = 'Runner C\'s time is less than or equal to Runner B\'s.';
				$postSuccess = false;
			}

			// Update the leg times
			$runnerALegTime = $runnerATime;
			$teamTime = $runnerATime;
			if ( ( $runnerBTime != '00:00:00' ) && ( $runnerBTimeErr == false ) ) {
				$runnerBLegTime = gmdate( "H:i:s", strtotime( $runnerBTime ) - strtotime( $runnerATime ) );
				$teamTime = gmdate( "H:i:s", strtotime( $runnerBTime ) );
			} elseif ( $runnerBTime == '00:00:00' ) {
				$runnerBLegTime = gmdate( "H:i:s", strtotime( '00:00:00' ) );
			}
			if ( ( $runnerCTime != '00:00:00' ) && ( $runnerCTimeErr == false ) ) {
				$runnerCLegTime = gmdate( "H:i:s", strtotime( $runnerCTime ) - strtotime( $runnerBTime ) );
				$teamTime = gmdate( "H:i:s", strtotime( $runnerCTime ) );
			} elseif ( $runnerCTime == '00:00:00' ) {
				$runnerCLegTime = gmdate( "H:i:s", strtotime( '00:00:00' ) );
			}

			// Update the team category
			if ( ( $runnerAGender == "Not Selected" ) || ( $runnerBGender == "Not Selected") || ( $runnerCGender == "Not Selected" ) ) {
				$category = "Uncategorised";
			} elseif ( ( $runnerAAge == "Not Selected" ) || ( $runnerBAge == "Not Selected" ) || ( $runnerCAge == "Not Selected" ) ) {
				$category = "Uncategorised";
			} else {
				if ( ( $runnerAAge == "Senior" ) || ( $runnerBAge == "Senior") || ( $runnerCAge == "Senior" ) ) { $category = "Senior"; } else { $category = "Veteran"; }
				if ( ( $runnerAGender == "Male" ) || ( $runnerBGender == "Male") || ( $runnerCGender == "Male" ) ) { $category .= " Men"; } else { $category .= " Ladies"; }
			}
			
			if ( $postSuccess ) {
				if ( $isAdmin ) :
					// Update the values
					$wpdb->update( 
						"{$wpdb->prefix}ghac_sr25_teams", 
						array(
							'TeamNumber' => $teamNum,
							'TeamName' => $teamName,
							'TeamStatus' => $teamStatus,
							'ClubName' => $clubName,
							'Category' => $category,
							'RunnerAFirstName' => $runnerAFirstName,
							'RunnerALastName' => $runnerALastName,
							'RunnerAGender' => $runnerAGender,
							'RunnerAAge' => $runnerAAge,
							'RunnerATime' => $runnerATime,
							'RunnerALegTime' => $runnerALegTime,
							'RunnerBFirstName' => $runnerBFirstName,
							'RunnerBLastName' => $runnerBLastName,
							'RunnerBGender' => $runnerBGender,
							'RunnerBAge' => $runnerBAge,
							'RunnerBTime' => $runnerBTime,
							'RunnerBLegTime' => $runnerBLegTime,
							'RunnerCFirstName' => $runnerCFirstName,
							'RunnerCLastName' => $runnerCLastName,
							'RunnerCGender' => $runnerCGender,
							'RunnerCAge' => $runnerCAge,
							'RunnerCTime' => $runnerCTime,
							'RunnerCLegTime' => $runnerCLegTime,
							'TeamTime' => $teamTime
						),
						array(
							'TeamID' => $teamID
						)
					);
					echo $wpdb->last_error;
				else:
					// Update the values
					$wpdb->update( 
						"{$wpdb->prefix}ghac_sr25_teams", 
						array(
							'TeamNumber' => $teamNum,
							'TeamName' => $teamName,
							'ClubName' => $clubName,
							'Category' => $category,
							'RunnerAFirstName' => $runnerAFirstName,
							'RunnerALastName' => $runnerALastName,
							'RunnerAGender' => $runnerAGender,
							'RunnerAAge' => $runnerAAge,
							'RunnerBFirstName' => $runnerBFirstName,
							'RunnerBLastName' => $runnerBLastName,
							'RunnerBGender' => $runnerBGender,
							'RunnerBAge' => $runnerBAge,
							'RunnerCFirstName' => $runnerCFirstName,
							'RunnerCLastName' => $runnerCLastName,
							'RunnerCGender' => $runnerCGender,
							'RunnerCAge' => $runnerCAge
						),
						array(
							'TeamID' => $teamID
						)
					);
				endif;

				// Redirect back to the teams manager page
				//wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) );
			}
		}
	}
}
?>

<?php get_header(); ?>
<div class="page-padding content-1">
	<div class="container">
		<?php echo $isSubscriber; ?>
		<div class="row">
			<div class="col-12">
				<h1><?php the_title(); ?></h1>
				<p>
					<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) ?>" class="btn btn-primary">Back to Team Manager</a>
				</p>
				<?php if ( ( ( isset( $postSuccess ) ) && ( $postSuccess == false ) ) || ( ( isset( $contactSuccess ) ) && ( $contactSuccess == false ) ) ) : ?>
                    <div class="alert alert-danger" role="alert">
                        <p>There are errors on the form. Please correct the following and re-submit:</p>
						<ul>
							<?php foreach ( $errors as $error ) { ?>
								<li><?php echo $error; ?></li>
							<?php } ?>
						</ul>
                    </div>
                <?php endif; ?>
				<?php if ( ( $isAdmin == false ) && ( $teamStatus > 1 ) ) : ?>
					<div class="alert alert-info" role="alert">
						<p>Registration has now closed. You will not be able to make any more changes to your team.</p>
						<p>If you do need to make a change you will need to contact an administrator from the Gosforth Harriers &amp; AC.</p>
					</div>
				<?php endif; ?>
                <form id="teamForm" name="teamForm" method="post" action="" novalidate class="mb-4 mb-lg-0">
                    <input type="hidden" name="editTeamForm" value="1" />
					<div class="row">
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									Team Details
								</div>
								<div class="card-body">
									<div class="mb-3">
                        				<label for="teamNumber" class="form-label">Team Number</label>
										<input type="number" id="teamNumber" name="teamNumber" aria-describedby="teamNumberHelp" <?php echo ( !$isAdmin ) ? 'disabled' : ''; ?> value="<?php echo( isset( $teamNum ) ) ? $teamNum : ''; ?>" class="form-control <?php if ( isset( $teamNumErr ) ) { echo( $teamNumErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<input type="hidden" name="teamNumberH" value="<?php echo( isset( $teamNum ) ) ? $teamNum : ''; ?>">
										<div id="teamNumberHelp" class="form-text">Enter the team number which will appear on the runners' bibs.</div>
                    				</div>
									<div class="mb-3">
										<label for="teamName" class="form-label">Team Name</label>
                        				<input type="text" id="teamName" name="teamName" aria-describedby="teamNameHelp" maxlength="50" value="<?php echo( isset( $teamName ) ) ? $teamName : ''; ?>" class="form-control <?php if ( isset( $teamNameErr ) ) { echo( $teamNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="teamNameHelp" class="form-text">Enter a unique name for the team which will appear on the results page. This is a bit of fun. Use any name you want. But keep them clean &#128521;</div>
                    				</div>
									<div class="mb-3">
										<label for="clubName" class="form-label">Club Name</label>
                        				<input type="text" id="clubName" name="clubName" aria-describedby="clubNameHelp" maxlength="75" value="<?php echo( isset( $clubName ) ) ? $clubName : ''; ?>" class="form-control <?php if ( isset( $clubNameErr ) ) { echo( $clubNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" >
                        				<div id="clubNameHelp" class="form-text">Enter the name of the running club to associate this team with.</div>
									</div>
									<div class="mb-3">
										<label for="category" class="form-label">Category</label>
                        				<select class="form-select" id="category" name="category" disabled aria-describedby="categoryHelp">
  											<option value="Uncategorised" <?php if ( ! isset( $category ) || $category == 'Uncategorised' ) echo( 'selected' );  ?>>Select a category</option>
  											<option value="Senior Ladies" <?php if ( isset( $category ) && $category == 'Senior Ladies' ) echo( 'selected' );  ?>>Senior Ladies</option>
  											<option value="Senior Mens" <?php if ( isset( $category ) && $category == 'Senior Men' ) echo( 'selected' );  ?>>Senior Men</option>
  											<option value="Veteran Ladies" <?php if ( isset( $category ) && $category == 'Veteran Ladies' ) echo( 'selected' );  ?>>Veteran Ladies</option>
											<option value="Veteran Mens" <?php if ( isset( $category ) && $category == 'Veteran Men' ) echo( 'selected' );  ?>>Veteran Men</option>
										</select>
										<input type="hidden" name="categoryH" value="<?php echo( isset( $category ) ) ? $category : ''; ?>">
                        				<div id="categoryHelp" class="form-text">
											Category is determined from the gender and age categories selected for the runners. Please ensure all values are selected correctly.
										</div>
                    				</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									Team Status
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label for="teamStatus" class="form-label">Status</label>
                        				<select class="form-select" id="teamStatus" name="teamStatus" <?php echo ( !$isAdmin ) ? 'disabled' : ''; ?> aria-describedby="teamStatusHelp">
  											<option value="1" <?php if ( isset( $teamStatus ) && $teamStatus == 1 ) echo( 'selected' );  ?>>Registration</option>
  											<option value="2" <?php if ( isset( $teamStatus ) && $teamStatus == 2 ) echo( 'selected' );  ?>>Pre-Race</option>
  											<option value="3" <?php if ( isset( $teamStatus ) && $teamStatus == 3 ) echo( 'selected' );  ?>>Did Not Start</option>
  											<option value="4" <?php if ( isset( $teamStatus ) && $teamStatus == 4 ) echo( 'selected' );  ?>>Did Not Finish</option>
											<option value="5" <?php if ( isset( $teamStatus ) && $teamStatus == 5 ) echo( 'selected' );  ?>>Invalid</option>
											<option value="6" <?php if ( isset( $teamStatus ) && $teamStatus == 6 ) echo( 'selected' );  ?>>Leg 1 Completed</option>
											<option value="7" <?php if ( isset( $teamStatus ) && $teamStatus == 7 ) echo( 'selected' );  ?>>Leg 2 Completed</option>
											<option value="8" <?php if ( isset( $teamStatus ) && $teamStatus == 8 ) echo( 'selected' );  ?>>Finished</option>
										</select>
										<input type="hidden" name="teamStatusH" value="<?php echo( isset( $teamStatus ) ) ? $teamStatus : ''; ?>">
                        				<div id="teamStatusHelp" class="form-text">Select the status for the team.</div>
									</div>
									<div class="md-3">
										<h2>Gun Time: <?php echo $teamTime; ?></h2>
										<input type="hidden" name="teamTime" value="<?php echo( isset( $teamTime ) ) ? $teamTime : ''; ?>">
									</div>
								</div>
							</div>
							<div class="card mb-3">
								<div class="card-header">
									Club Contacts
								</div>
								<div class="card-body">
									<div class="mb-3 alert alert-info">
										<p>Adding club contacts will allow them to access the team manager and make changes to the teams they are attached to.</p>
										<p>Before making changes to contacts, please ensure you have saved any changes to the runner information as it may be lost.</p>
									</div>
									<div class="mb-3">
										<table class="table">
											<thead>
    											<tr>
													<th scope="col">First Name</th>
													<th scope="col">Last Name</th>
      												<th scope="col">Email Address</th>
													<th scope="col"></th>
    											</tr>
  											</thead>
											<tbody>
												<?php
													$emailAddresses = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_sr25_teamemails te INNER JOIN {$wpdb->prefix}ghac_sr25_emails em ON te.EmailID = em.EmailID WHERE te.TeamID = %d", $teamID ) );
													foreach($emailAddresses as $emailRow) {
												?>
													<tr>
														<td><?php echo $emailRow->FirstName; ?></td>
														<td><?php echo $emailRow->LastName; ?></td>
														<td><?php echo $emailRow->EmailAddress; ?></td>
														<td>
															<span class="float-end"><button type="button" class="btn btn-link bi bi-trash3 icon-button <?php echo ($isSubscriber) ? 'd-none' : ''; ?>" data-bs-toggle="modal" data-bs-target="#modalDelEmail<?php echo $emailRow->EmailID; ?>"></button></span>
															<!-- Confirmation Modal -->
															<div class="modal fade" id="modalDelEmail<?php echo $emailRow->EmailID; ?>" tabindex="-1" aria-labelledby="modalDelEmailLabel<?php echo $emailRow->EmailID; ?>" aria-hidden="true">
  																<div class="modal-dialog">
    																<div class="modal-content">
      																	<div class="modal-header">
        																	<h1 class="modal-title fs-5" id="modalDelEmailLabel<?php echo $emailRow->EmailID; ?>">Delete Email Address</h1>
        																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      																	</div>
      																	<div class="modal-body">
																			<p>Are you sure you want delete the following email address from this team:</p>
																			<p class="text-center"><strong><?php echo $emailRow->EmailAddress; ?></strong></p>
																			<p>Deleting the email address from this team does not affect any other teams that it is associated with.</p>
      																	</div>
      																	<div class="modal-footer">
        																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																			<button type="submit" class="btn btn-primary" name="delEmail<?php echo $emailRow->EmailID; ?>" value="<?php echo $emailRow->EmailID . ';' . $emailRow->EmailAddress; ?>">Confirm Deletion</button>
      																	</div>
    																</div>
  																</div>
															</div>
														</td>
													</tr>
												<?php
													}
												?>
											</tbody>
										</table>
										<div class="mb-3">
											<button class="btn btn-primary <?php echo ($isSubscriber) ? 'd-none' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#addContact" aria-expanded="false" aria-controls="addContact">
    											Add Contact
  											</button>
										</div>
										<div class="<?php echo( isset( $contactSuccess ) ) ? 'collapse show' : 'collapse'; ?>" id="addContact">
											<div class="card mb-3">
												<div class="card-body">
													<div class="mb-3">
														<div class="row">
															<div class="col-md-6 mb-3">
																<label for="firstName" class="form-label">First Name</label>
                        										<input type="text" id="firstName" name="firstName" aria-describedby="firstNameHelp" maxlength="35" value="<?php echo( isset( $firstName ) ) ? $firstName : ''; ?>" class="form-control <?php if ( isset( $firstNameErr ) ) { echo( $firstNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" >
                        										<div id="firstNameHelp" class="form-text">Enter the club contact's first name.</div>
															</div>
															<div class="col-md-6 mb-3">
																<label for="lastName" class="form-label">Last Name</label>
                        										<input type="text" id="lastName" name="lastName" aria-describedby="lastNameHelp" maxlength="35" value="<?php echo( isset( $lastName ) ) ? $lastName : ''; ?>" class="form-control <?php if ( isset( $lastNameErr ) ) { echo( $lastNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" >
                        										<div id="lastNameHelp" class="form-text">Enter the club contact's last name.</div>
															</div>
														</div>
														<div class="row">
															<div class="mb-3">
																<label for="emailAddress" class="form-label">Email address</label>
                        										<input type="email" id="emailAddress" name="emailAddress" aria-describedby="emailAddressHelp" maxlength="254" value="<?php echo( isset( $email ) ) ? $email : ''; ?>" class="form-control <?php if ( isset( $emailErr ) ) { echo( $emailErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" >
                        										<div id="emailAddressHelp" class="form-text">Enter the email address of the club contact.</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<button type="submit" name="submitContact" value="submitContact" class="btn btn-primary">Submit</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									Runner A
								</div>
								<div class="card-body">
									
									<div class="mb-3">
										<label for="runnerAFirstName" class="form-label">First Name</label>
                        				<input type="text" id="runnerAFirstName" name="runnerAFirstName" aria-describedby="runnerAFirstNameHelp" maxlength="30" value="<?php echo( isset( $runnerAFirstName ) ) ? $runnerAFirstName : ''; ?>" class="form-control <?php if ( isset( $runnerAFirstNameErr ) ) { echo( $runnerAFirstNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerAFirstNameHelp" class="form-text">Enter the first name of the runner for the first leg.</div>
									</div>
									<div class="mb-3">
										<label for="runnerALastName" class="form-label">Last Name</label>
                        				<input type="text" id="runnerALastName" name="runnerALastName" aria-describedby="runnerALastNameHelp" maxlength="30" value="<?php echo( isset( $runnerALastName ) ) ? $runnerALastName : ''; ?>" class="form-control <?php if ( isset( $runnerALastNameErr ) ) { echo( $runnerALastNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerAFirstNameHelp" class="form-text">Enter the last name of the runner for the first leg.</div>
									</div>
									<div class="row mb-3">
										<div class="col">
											<label for="runnerAGender" class="form-label">Gender</label>
                        					<select class="form-select" id="runnerAGender" name="runnerAGender" aria-describedby="runnerAGenderHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerAGender ) || $runnerAGender == 'Not Selected' ) echo( 'selected' );  ?>>Select a gender</option>
  												<option value="Female" <?php if ( isset( $runnerAGender ) && $runnerAGender == 'Female' ) echo( 'selected' );  ?>>Female</option>
  												<option value="Male" <?php if ( isset( $runnerAGender ) && $runnerAGender == 'Male' ) echo( 'selected' );  ?>>Male</option>
											</select>
                        					<div id="runnerACategoryHelp" class="form-text">Select the gender for the runner</div>
										</div>
										<div class="col">
											<label for="runnerAAge" class="form-label">Age Category</label>
                        					<select class="form-select" id="runnerAAge" name="runnerAAge" aria-describedby="runnerAAgeHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerAAge ) || $runnerAAge == 'Not Selected' ) echo( 'selected' );  ?>>Select an age category</option>
  												<option value="Senior" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'Senior' ) echo( 'selected' );  ?>>Senior</option>
  												<option value="V35" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V35' ) echo( 'selected' );  ?>>V35</option>
												<option value="V40" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V40' ) echo( 'selected' );  ?>>V40</option>
												<option value="V45" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V45' ) echo( 'selected' );  ?>>V45</option>
												<option value="V50" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V50' ) echo( 'selected' );  ?>>V50</option>
												<option value="V55" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V55' ) echo( 'selected' );  ?>>V55</option>
												<option value="V60" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V60' ) echo( 'selected' );  ?>>V60</option>
												<option value="V65" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V65' ) echo( 'selected' );  ?>>V65</option>
												<option value="V70" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V70' ) echo( 'selected' );  ?>>V70</option>
												<option value="V75" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V75' ) echo( 'selected' );  ?>>V75</option>
												<option value="V80" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V80' ) echo( 'selected' );  ?>>V80</option>
												<option value="V85" <?php if ( isset( $runnerAAge ) && $runnerAAge == 'V85' ) echo( 'selected' );  ?>>V85</option>
											</select>
                        					<div id="runnerAAgeHelp" class="form-text">Select the age band for the runner</div>
										</div>
									</div>
									<div class="mb-3">
										<label for="runnerATime" class="form-label">Gun Time</label>
                        				<input type="time" id="runnerATime" name="runnerATime" aria-describedby="runnerATimeHelp" step="1" <?php echo ( !$isAdmin ) ? 'disabled' : ''; ?> value="<?php echo( isset( $runnerATime ) ) ? $runnerATime : ''; ?>" class="form-control <?php if ( isset( $runnerATimeErr ) ) { echo( $runnerATimeErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<input type="hidden" name="runnerATimeH" value="<?php echo( isset( $runnerATime ) ) ? $runnerATime : ''; ?>">
										<div id="runnerATimeHelp" class="form-text">Enter the gun time for the runner of the first leg.</div>
									</div>
									<div class="mb-3">
										<input type="hidden" name="runnerALegTime" value="<?php echo( isset( $runnerALegTime ) ) ? $runnerALegTime : ''; ?>">
										<p>Leg Time: <?php echo $runnerALegTime; ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									Runner B
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label for="runnerBFirstName" class="form-label">First Name</label>
                        				<input type="text" id="runnerBFirstName" name="runnerBFirstName" aria-describedby="runnerBFirstNameHelp" maxlength="30" value="<?php echo( isset( $runnerBFirstName ) ) ? $runnerBFirstName : ''; ?>" class="form-control <?php if ( isset( $runnerBFirstNameErr ) ) { echo( $runnerBFirstNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerBFirstNameHelp" class="form-text">Enter the first name of the runner for the second leg.</div>
									</div>
									<div class="mb-3">
										<label for="runnerBLastName" class="form-label">Last Name</label>
                        				<input type="text" id="runnerBLastName" name="runnerBLastName" aria-describedby="runnerBLastNameHelp" maxlength="30" value="<?php echo( isset( $runnerBLastName ) ) ? $runnerBLastName : ''; ?>" class="form-control <?php if ( isset( $runnerBLastNameErr ) ) { echo( $runnerBLastNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerBLastNameHelp" class="form-text">Enter the last name of the runner for the second leg.</div>
									</div>
									<div class="row mb-3">
										<div class="col">
											<label for="runnerBGender" class="form-label">Category</label>
                        					<select class="form-select" id="runnerBGender" name="runnerBGender" aria-describedby="runnerBGenderHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerBGender ) || $runnerBGender == 'Not Selected' ) echo( 'selected' );  ?>>Select a gender</option>
  												<option value="Female" <?php if ( isset( $runnerBGender ) && $runnerBGender == 'Female' ) echo( 'selected' );  ?>>Female</option>
  												<option value="Male" <?php if ( isset( $runnerBGender ) && $runnerBGender == 'Male' ) echo( 'selected' );  ?>>Male</option>
											</select>
                        					<div id="runnerBGenderHelp" class="form-text">Select the gender for the runner</div>
										</div>
										<div class="col">
											<label for="runnerBAge" class="form-label">Age Band</label>
                        					<select class="form-select" id="runnerBAge" name="runnerBAge" aria-describedby="runnerBAgeHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerBAge ) || $runnerBAge == 'Not Selected' ) echo( 'selected' );  ?>>Select an age category</option>
  												<option value="Senior" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'Senior' ) echo( 'selected' );  ?>>Senior</option>
  												<option value="V35" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V35' ) echo( 'selected' );  ?>>V35</option>
  												<option value="V40" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V40' ) echo( 'selected' );  ?>>V40</option>
												<option value="V45" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V45' ) echo( 'selected' );  ?>>V45</option>
												<option value="V50" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V50' ) echo( 'selected' );  ?>>V50</option>
												<option value="V55" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V55' ) echo( 'selected' );  ?>>V55</option>
												<option value="V60" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V60' ) echo( 'selected' );  ?>>V60</option>
												<option value="V65" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V65' ) echo( 'selected' );  ?>>V65</option>
												<option value="V70" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V70' ) echo( 'selected' );  ?>>V70</option>
												<option value="V75" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V75' ) echo( 'selected' );  ?>>V75</option>
												<option value="V80" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V80' ) echo( 'selected' );  ?>>V80</option>
												<option value="V85" <?php if ( isset( $runnerBAge ) && $runnerBAge == 'V85' ) echo( 'selected' );  ?>>V85</option>
											</select>
                        					<div id="runnerBAgeHelp" class="form-text">Select the age band for the runner</div>
										</div>
									</div>
									<div class="mb-3">
										<label for="runnerBTime" class="form-label">Gun Time</label>
                        				<input type="time" id="runnerBTime" name="runnerBTime" aria-describedby="runnerBTimeHelp" step="1" <?php echo ( !$isAdmin ) ? 'disabled' : ''; ?> value="<?php echo( isset( $runnerBTime ) ) ? $runnerBTime : ''; ?>" class="form-control <?php if ( isset( $runnerBTimeErr ) ) { echo( $runnerBTimeErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<input type="hidden" name="runnerBTimeH" value="<?php echo( isset( $runnerBTime ) ) ? $runnerBTime : ''; ?>">
										<div id="runnerBTimeHelp" class="form-text">Enter the gun time for the runner of the second leg.</div>
									</div>
									<div class="mb-3">
										<input type="hidden" name="runnerBLegTime" value="<?php echo( isset( $runnerBLegTime ) ) ? $runnerBLegTime : ''; ?>">
										<p>Leg Time: <?php echo $runnerBLegTime; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									Runner C
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label for="runnerCFirstName" class="form-label">First Name</label>
                        				<input type="text" id="runnerCFirstName" name="runnerCFirstName" aria-describedby="runnerCFirstNameHelp" maxlength="30" value="<?php echo( isset( $runnerCFirstName ) ) ? $runnerCFirstName : ''; ?>" class="form-control <?php if ( isset( $runnerCFirstNameErr ) ) { echo( $runnerCFirstNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerCFirstNameHelp" class="form-text">Enter the first name of the runner for the last leg.</div>
									</div>
									<div class="mb-3">
										<label for="runnerCLastName" class="form-label">Last Name</label>
                        				<input type="text" id="runnerCLastName" name="runnerCLastName" aria-describedby="runnerCLastNameHelp" maxlength="30" value="<?php echo( isset( $runnerCLastName ) ) ? $runnerCLastName : ''; ?>" class="form-control <?php if ( isset( $runnerCLastNameErr ) ) { echo( $runnerCLastNameErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
                        				<div id="runnerCLastNameHelp" class="form-text">Enter the last name of the runner for the last leg.</div>
									</div>
									<div class="row mb-3">
										<div class="col">
											<label for="runnerCGender" class="form-label">Gender</label>
                        					<select class="form-select" id="runnerCGender" name="runnerCGender" aria-describedby="runnerCGenderHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerCGender ) || $runnerCGender == 'Not Selected' ) echo( 'selected' );  ?>>Select a gender</option>
  												<option value="Female" <?php if ( isset( $runnerCGender ) && $runnerCGender == 'Female' ) echo( 'selected' );  ?>>Female</option>
  												<option value="Male" <?php if ( isset( $runnerCGender ) && $runnerCGender == 'Male' ) echo( 'selected' );  ?>>Male</option>
											</select>
                        					<div id="runnerCGenderHelp" class="form-text">Select the gender for the runner</div>
										</div>
										<div class="col">
											<label for="runnerCAge" class="form-label">Age Band</label>
                        					<select class="form-select" id="runnerCAge" name="runnerCAge" aria-describedby="runnerCAgeHelp">
  												<option value="Not Selected" <?php if ( ! isset( $runnerCAge ) || $runnerCAge == 'Not Selected' ) echo( 'selected' );  ?>>Select an age cateory</option>
  												<option value="Senior" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'Senior' ) echo( 'selected' );  ?>>Senior</option>
  												<option value="V35" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V35' ) echo( 'selected' );  ?>>V35</option>
  												<option value="V40" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V40' ) echo( 'selected' );  ?>>V40</option>
												<option value="V45" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V45' ) echo( 'selected' );  ?>>V45</option>
												<option value="V50" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V50' ) echo( 'selected' );  ?>>V50</option>
												<option value="V55" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V55' ) echo( 'selected' );  ?>>V55</option>
												<option value="V60" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V60' ) echo( 'selected' );  ?>>V60</option>
												<option value="V65" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V65' ) echo( 'selected' );  ?>>V65</option>
												<option value="V70" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V70' ) echo( 'selected' );  ?>>V70</option>
												<option value="V75" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V75' ) echo( 'selected' );  ?>>V75</option>
												<option value="V80" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V80' ) echo( 'selected' );  ?>>V80</option>
												<option value="V85" <?php if ( isset( $runnerCAge ) && $runnerCAge == 'V85' ) echo( 'selected' );  ?>>V85</option>
											</select>
                        					<div id="runnerCAgeHelp" class="form-text">Select the age band for the runner</div>
										</div>
									</div>
									<div class="mb-3">
										<label for="runnerCTime" class="form-label">Gun Time</label>
                        				<input type="time" id="runnerCTime" name="runnerCTime" aria-describedby="runnerCTimeHelp" step="1" <?php echo ( !$isAdmin ) ? 'disabled' : ''; ?> value="<?php echo( isset( $runnerCTime ) ) ? $runnerCTime : ''; ?>" class="form-control <?php if ( isset( $runnerCTimeErr ) ) { echo( $runnerCTimeErr == true ) ? 'is-invalid' : 'is-valid'; } ?>">
										<input type="hidden" name="runnerCTimeH" value="<?php echo( isset( $runnerCTime ) ) ? $runnerCTime : ''; ?>">
										<div id="runnerCTimeHelp" class="form-text">Enter the gun time for the runner of the third leg.</div>
									</div>
									<div class="mb-3">
										<input type="hidden" name="runnerCLegTime" value="<?php echo( isset( $runnerCLegTime ) ) ? $runnerCLegTime : ''; ?>">
										<p>Leg Time: <?php echo $runnerCLegTime; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<?php if ( ( ( $isAdmin == false ) && ( $teamStatus > 1 ) ) || ( $isSubscriber == true ) ) : ?>
								<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ); ?>" class="btn btn-primary">Go Team Manager</a>
							<?php else : ?>
								<button type="submit" name="submit" value="submit" class="btn btn-primary">Save Changes</button>&nbsp;&nbsp;
								<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ); ?>" class="btn btn-secondary">Cancel</a>
							<?php endif; ?>
						</div>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>
<script>
	var form_clean;
	// Serialize the clean form
	//window.addEventListener('DOMContentLoaded', function () {
    //	form_clean = document.forms['teamForm'].elements;
	//});

	// Compare clean and dirty form before leaving
	//window.onbeforeunload = function (e) {
    //	var form_dirty = document.forms['teamForm'].elements;
    //	for (var i = 0; i < form_clean.length; i++) {
    //    	if (form_clean[i].value !== form_dirty[i].value) {
    //        	return 'There is unsaved form data.';
    //    	}
    //	}
	//};
</script>
<?php if ( isset( $delEmailToast ) ) : ?>
	<div class="toast-container position-fixed bottom-0 end-0 p-3">
		<div id="toastDelEmail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<i class="bi bi-envelope-x"></i>&nbsp;
				<strong class="me-auto">Delete Email</strong>
				<small>Just now</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
				<?php echo $delEmailToast; ?>
			</div>
		</div>
	</div>
	<script>
		window.onload = function () {
			const toastBootstrap = bootstrap.Toast.getOrCreateInstance(document.getElementById("toastDelEmail"));
			toastBootstrap.show();
		}
	</script>
<?php endif; ?>	
<?php get_footer(); ?>