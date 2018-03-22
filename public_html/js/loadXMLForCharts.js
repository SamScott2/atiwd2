window.onload = function () {



    console.log("hello");

    var scatterBtn = document.getElementById("scatter");
    scatterBtn.addEventListener("click", function () {
        console.log("hello");
        var station = document.getElementById("ddmenu");
        loadScatterfromXML(station.options[station.selectedIndex].value);
    });
    var lineBtn = document.getElementById("line");
    lineBtn.addEventListener("click", function () {
        var station = document.getElementById("ddmenu");
        loadLinefromXML(station.options[station.selectedIndex].value);
    });


    function loadScatterfromXML(name) {

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "xml/" + name + "NO2.xml");
        xhttp.onload = function () {

            var date = document.getElementById("date");


            var year = date.value.substring(6, 10);
            var xml = xhttp.responseXML;

            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();

                data.addColumn('date', 'time');
                data.addColumn('number', 'no2 levels');



                var readings = xml.getElementsByTagName("reading");

                var time = document.getElementById("time");
                for (var i = 0; i < readings.length; i++) {
                    if (readings[i].getAttribute("time") === time.value && readings[i].getAttribute("date").substring(6, 10) === year) {
                        var time = readings[i].getAttribute("date");
                        var timetemp = time.split("/");
                        var newtime = [parseInt(timetemp[0]), parseInt(timetemp[1]), parseInt(timetemp[2])];
                        data.addRow([new Date(newtime[2],newtime[1],newtime[0]), parseInt(readings[i].getAttribute("val"))]);
                        console.log(new Date(newtime[2],newtime[1],newtime[0]), parseInt(readings[i].getAttribute("val")));
                    }
                }
                console.log(data);
                //var data = google.visualization.arrayToDataTable(scatterData);
                var options = {
                    //general options
                    title: "NO2 at " + time.value + " over the year(" + year + "}",
                    pointShape: 'diamond',
                    //table axis labels.
                    hAxis: {title: "Time"},
                    vAxis: {title: "NO2 Quantity"},
                    legend: 'none'
                };
                var chart = new google.visualization.ScatterChart(document.getElementById('scatterchart'));
                chart.draw(data, options);
            }
        };
        xhttp.send();

    }



    function loadLinefromXML(name) {

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "xml/" + name + "NO2.xml");
        xhttp.onload = function () {

            var time = document.getElementById("time");
            var date = document.getElementById("date");

            var year = date.value.substring(6, 10);
            var xml = xhttp.responseXML;

            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('timeofday', 'time');
                data.addColumn('number', 'no2 levels');

                var readings = xml.getElementsByTagName("reading");

                for (var i = 0; i < readings.length; i++) {
                    if (readings[i].getAttribute("date") === date.value) {

                        var time = readings[i].getAttribute("time");
                        var timetemp = time.split(":");
                        var newtime = [parseInt(timetemp[0]), parseInt(timetemp[1]), parseInt(timetemp[2])];

                        var val = readings[i].getAttribute("val");


                        data.addRow([newtime, parseInt(val)]);
                    }
                }
                data.sort({column: 0});

                //define options for the linegraph
                var options = {
                    //general table variables.
                    title: 'no2 of the day of ' + date.value,
                    curveType: 'function',

                    //define axis parameters.
                    hAxis: {title: "Time"},
                    vAxis: {title: "NO2 Levels"},

                };

                var chart = new google.visualization.LineChart(document.getElementById('linechart'));

                chart.draw(data, options);
            }

        };
        xhttp.send();

    }

}
