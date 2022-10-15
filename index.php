<?php

include( 'config.php' );

$num_per_page = 4;

if( isset( $_GET["page"] ) ) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start = ( $page-1 ) * $num_per_page;

$query = "SELECT * FROM users limit $start, $num_per_page";
$res = mysqli_query( $conn, $query );

?>

<table border="1" align="center">
    <thead>
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
    
        if( mysqli_num_rows( $res ) ) {
            while( $row = mysqli_fetch_array( $res ) ) {
                ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                    </tr> 
                <?php
            }
        }
    ?>
    </tbody>
</table>

<?php
$pagi_sql = "SELECT * FROM users";
$pagi_res = mysqli_query( $conn, $pagi_sql );
$pagi_total = mysqli_num_rows( $pagi_res );
// echo $pagi_total;
$total_pages = ceil( $pagi_total / $num_per_page );
// echo $total_pages;

for( $i = 1; $i < $total_pages; $i++ ) {
    echo "<a href='index.php?page=".$i."'>".$i."<a>" . " ";
}