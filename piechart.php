<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        //creating function
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Property categories', 'Number'],
                <?php
                //enter credentials from another php file 
                require_once("config.php");
                //connect to database
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("cant connect to database");
                //store query
                $query = "SELECT count(agent_id) AS total_prop, agent_id
                          FROM workingwizards.properties
                          GROUP BY agent_id;";

                //execute query
                $result = mysqli_query($conn, $query) or die("cant execute query");
                //output data row by row
                while ($row = mysqli_fetch_array($result)) {

                    $agent_id = $row['agent_id'];
                    $query = "SELECT firstName, lastName
                                FROM users
                                where agent_id = '$agent_id'";
                    $userData = mysqli_query($conn, $query) or die("cant execute query");

                    $fname = $lname = "";
                    while ($user = mysqli_fetch_array($userData)) {
                        $fname = $user['firstName'];
                        $lname = $user['lastName'];
                    }
                    //execute query
                    $details = $fname." ".$lname." ";
                    echo "['$details', {$row['total_prop']}],";
                }
                //disconnect from database
                mysqli_close($conn);
                ?>
            ]);

            var options = {
                
                title: 'Properties per agent ',
                titleTextStyle:{
                    fontSize: 30,
                    bold:true,
                    alignment: 'center'
                },
                pieHole: 0.4, // Add this to create a donut chart (optional)
            };

            var chart = new google.visualization.PieChart(document.getElementById("pie_chart"));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="pie_chart" style="width: 900px; height: 900px; "></div>
</body>

<style>
    #pie_chart {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>


</html