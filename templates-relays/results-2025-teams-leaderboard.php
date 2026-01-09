<?php 
/*
	Template Name: Summer Relays 2025 - Results (Leaderboard)
*/

$seniorMenTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_sr25_teams WHERE Category = 'Senior Men' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$seniorLadiesTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_sr25_teams WHERE Category = 'Senior Ladies' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$veteranMenTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_sr25_teams WHERE Category = 'Veteran Men' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$veteranLadiesTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_sr25_teams WHERE Category = 'Veteran Ladies' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$seniorLadies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Female' AND RunnerAAge = 'Senior' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Female' AND RunnerBAge = 'Senior' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Female' AND RunnerCAge = 'Senior' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$seniorMens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Male' AND RunnerAAge = 'Senior' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Male' AND RunnerBAge = 'Senior' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Male' AND RunnerCAge = 'Senior' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$veteranLadies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Female' AND LEFT(RunnerAAge, 1) = 'V' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Female' AND LEFT(RunnerBAge, 1) = 'V' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Female' AND LEFT(RunnerCAge, 1) = 'V' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$veteranMens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Male' AND LEFT(RunnerAAge, 1) = 'V' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Male' AND LEFT(RunnerBAge, 1) = 'V' " .
     "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Male' AND LEFT(RunnerCAge, 1) = 'V' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o50Ladies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Female' AND RunnerAAgeValue >= 50 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Female' AND RunnerBAgeValue >= 50 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Female' AND RunnerCAgeValue >= 50 " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o50Mens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Male' AND RunnerAAgeValue >= 50 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Male' AND RunnerBAgeValue >= 50 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Male' AND RunnerCAgeValue >= 50 " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o60Ladies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Female' AND RunnerAAgeValue >=60  " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Female' AND RunnerBAgeValue >=60 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Female' AND RunnerCAgeValue >=60 " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o60Mens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, CONCAT(RunnerAFirstName, ' ', RunnerALastName) AS RunnerName, ClubName, RunnerAGender AS Gender, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAGender = 'Male' AND RunnerAAgeValue >= 60 " .
        "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, CONCAT(RunnerBFirstName, ' ', RunnerBLastName) AS RunnerName, ClubName, RunnerBGender AS Gender, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBGender = 'Male' AND RunnerBAgeValue >= 60 " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, CONCAT(RunnerCFirstName, ' ', RunnerCLastName) AS RunnerName, ClubName, RunnerCGender AS Gender, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_sr25_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCGender = 'Male' AND RunnerCAgeValue >= 60 " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
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
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-2025-junior-races' ); ?>" class="btn btn-primary mb-1">Junior Races</a>&nbsp;&nbsp;
                    <a href="#" class="btn btn-secondary mb-1">Leaderboards</a>
				</p>
                <h2>Senior Ladies (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorLadiesTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Senior Men (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorMenTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Veteran Ladies (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranLadiesTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Veteran Men (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranMenTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Senior Ladies (Individuals)</h2>
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
                            <?php foreach($seniorLadies as $row) : ?>
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
                <h2 class="pt-5">Senior Men (Individuals)</h2>
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
                            <?php foreach($seniorMens as $row) : ?>
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
                <h2 class="pt-5">Veteran Ladies (Individuals)</h2>
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
                            <?php foreach($veteranLadies as $row) : ?>
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
                <h2 class="pt-5">Veteran Men (Individuals)</h2>
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
                            <?php foreach($veteranMens as $row) : ?>
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
                <h2 class="pt-5">Over 50 Ladies (Individuals)</h2>
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
                            <?php foreach($o50Ladies as $row) : ?>
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
                <h2 class="pt-5">Over 50 Men (Individuals)</h2>
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
                            <?php foreach($o50Mens as $row) : ?>
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
                <h2 class="pt-5">Over 60 Ladies (Individuals)</h2>
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
                            <?php foreach($o60Ladies as $row) : ?>
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
                <h2 class="pt-5">Over 60 Men (Individuals)</h2>
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
                            <?php foreach($o60Mens as $row) : ?>
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