<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'controls']
        });
        google.charts.setOnLoadCallback(drawDashboard);

        function drawDashboard() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Area');
            data.addColumn('number', 'Total Production');

            var chart = new google.visualization.ChartWrapper({
                chartType: 'ColumnChart',
                containerId: 'chart_div',
                options: {
                    title: 'Total Production by Area',
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Total Production'
                    },
                    vAxis: {
                        title: 'Area'
                    },
                    colors: ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00', '#b82e2e', '#316395', '#994499', '#22aa99', '#aaaa11', '#6633cc', '#e67300', '#8b0707', '#651067', '#329262', '#5574a6', '#3b3eac']

                }
            });

            var control = document.getElementById('year_select');

            function fetchData(year) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var jsonData = JSON.parse(xhr.responseText);
                            drawChart(jsonData);
                        } else {
                            console.error('Error fetching data: ' + xhr.status);
                        }
                    }
                };
                xhr.open('GET', 'fetch_data.php?year=' + year, true);
                xhr.send();
            }

            control.addEventListener('change', function() {
                var selectedYear = this.value;
                fetchData(selectedYear);
            });

            fetchData('2016'); // Default to 2016 data
        }

        function drawChart(jsonData) {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Area');
            data.addColumn('number', 'Total Production');

            for (var i = 0; i < jsonData.length; i++) {
                data.addRow([jsonData[i].Area, parseInt(jsonData[i].TotalProduction)]);
            }

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, null);
        }
    </script>
</head>

<body>
    <div>
        <label for="year_select">Select Year:</label>
        <select id="year_select">
            <?php
            for ($year = 2016; $year >= 2000; $year--) {
                echo "<option value=\"$year\">$year</option>";
            }
            ?>
        </select>
    </div>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>

</html>