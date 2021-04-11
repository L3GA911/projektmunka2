      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Időtartam');
        data.addColumn('number', 'Napok');
        data.addRows([
          ['Munkában töltött idő', 3],
          ['Szabadság', 1],
          ['Betegszabadság', 1],
          ['Fizetetlen szabadság', 1],
        ]);

        // Set chart options
        var options = {'width':800,
                       'height':700};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
