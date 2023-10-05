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
                //enter crendentials from another php file 
                require_once("config.php");
                //connect to database
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("cant connect to database");
                //store query
                $query = "SELECT property_category, count(property_category)
                          FROM properties
                          GROUP BY property_category
                          ORDER BY count(property_category) DESC";


                //execute query
                $result = mysqli_query($conn, $query) or die("cant execute query");
                //output data row by row
                while ($row = mysqli_fetch_array($result)) {
                    echo "['{$row['property_category']}', {$row['count(property_category)']}],";
                }
                //disconnect from database
                mysqli_close($conn);
                ?>
            ]);

            var options = {
                title: 'Property category popularity',
                titleTextStyle:{
                    fontSize: 30,
                    bold:true,
                    alignment: 'center'
                },
                vAxis: {
                    title: 'Number of tenants'
                },
                hAxis: {
                    title: 'Property category'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("column_chart"));
            chart.draw(data, options); 
        }
    </script>
</head>
<body>
    <div id="column_chart" style="width: 900px; height: 900px;"></div>
</body>
<style>
#column_chart {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

</style>

</html>
