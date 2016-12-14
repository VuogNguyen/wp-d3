module.exports = {
  init: function() {
    var self = this;
    self.loadChartData();
  },

  loadChartData: function () {
    var self = this;
    var data = {
      'action': 'get_skills'
    };

    $.ajax({
      type: 'POST',
      url: ajax_skill_post.ajaxurl,
      data: data,
      success: function( result ){
        if (result.length === 0) {
          console.log("Empty Posts");
        } else {
          if( $('.js-bar-chart').length ) {
            self.drawBarChart(result);
          }
        }
      },
      error: function( jqXHR, textStatus, errorThrown ) {
        console.log(jqXHR);
      }
    }); 
  },

  drawBarChart: function (data) {
    var self = this;
    //Local data
    var data = data;

    var margin = {top: 0, right: 50, left: 150};
    var maxVal = 100;
    var widther = d3.select(".js-bar-chart").node().clientWidth;
    var width = widther - margin.left - margin.right,
        height = 150 - margin.top;

    // Collect data skills
    var dataSkills = [];
    for ( var i=0, l=data.length; i<l; i++ )
      dataSkills.push( data[i].skill );

    //Appends the svg to the chart-container div
    var svg = d3.select(".js-bar-chart").append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top)
      .append("g")
      .attr("transform", "translate(" + margin.left + ", 0)");

    //Creates the yScale - label on the left
    var yLabels = d3.scale.ordinal()
      .rangeBands([height, 0], 0)
      .domain(dataSkills);

    //Creates the xScale - chart on the right
    var xScale = d3.scale.linear()
      .range([0, width]);

    //Defines the y axis styles
    var yAxis = d3.svg.axis()
      .scale(yLabels)
      .orient("left");

    //Defines the y axis styles
    var xAxis = d3.svg.axis()
      .scale(xScale)
      .tickFormat(function(d) {return d + "%"; })
      .tickSize(height);

    // Parsing Data
    self.parsingBarChartData (data, maxVal, xScale, svg, yAxis, xAxis, yLabels, width);
  },

  parsingBarChartData: function (data, maxVal, xScale, svg, yAxis, xAxis, yLabels, width) {
    var barHeight = 15;

    //Sets the max value for the xScale - num2
    var maxX = d3.max(data, function(d) { return maxVal; });

    //Gets the min for bar labeling - num
    var valX = d3.min(data, function(d) { return d.result; });

    //Defines the xScale max
    xScale.domain([0, maxX ]);

    //Appends the y axis
    var yAxisGroup = svg.append("g")
      .attr("class", "y axis")
      .call(yAxis);

    //Appends the x axis    
    var xAxisGroup = svg.append("g")
      .attr("class", "x axis")
      .call(xAxis);

    //Binds the data to the bars      
    var skillGroup = svg.selectAll(".g-skill-group")
      .data(data)
      .enter()
      .append("g")
      .attr("class", "g-skill-group")
      .attr("transform", function(d) {
        return "translate(0," + yLabels(d.skill) + ")";
      });

    //Appends background bar   
    var bgBar = skillGroup.append("rect")
      .attr("width", function(d) { return xScale(maxVal); })
      .attr("height", barHeight )
      .attr("class", "bg-bar")
      .attr("rx", "4")
      .attr("ry", "4")
      .attr("transform", "translate(0,4)");   

    //Appends main bar   
    var mainBar = skillGroup.append("rect")
      .attr("width", function(d) { return xScale(d.result); })
      .attr("height", barHeight )
      .attr("class", "main-bar")
      .attr("rx", "4")
      .attr("ry", "4")
      .attr("transform", "translate(0,4)"); 
    
    //Binds data to labels
    var labelGroup = svg.selectAll("main-bar")
      .data(data)
      .enter()
      .append("g")
      .attr("class", "g-label-group")
      .attr("transform", function(d) {
        return "translate(0," + yLabels(d.skill) + ")";
      });

    //Appends main bar labels   
    var barLabels = labelGroup.append("text") 
      .text(function(d) {return  d.result + "%";})
      .attr("x", width + 15)
      .attr("y", yLabels.rangeBand()/1.6 )
      .attr("class", "bar-label");


    if ($(window).width() > 768 && $(window).width() < 940) {
      resizedBarChart();
    }

    d3.select(window).on("resize", function () {
      if ($(window).width() < 940) {
        resizedBarChart();
      }
    });

    function resizedBarChart() {
      // New margin
      var margin = {top: 0, right: 50, left: 150};
      // Get the width of the window
      var width = d3.select(".js-bar-chart").node().clientWidth;
      // Change the width of the svg
      d3.select(".js-bar-chart svg").attr("width", width);
      // Change the xScale
      xScale.range([0, width - margin.right - margin.left]);
      // Update the bars
      mainBar.attr("width", function(d) { return xScale(d.result); });
      // Update the second bars
      bgBar.attr("width", function(d) { return xScale(maxVal); });  
      // Updates bar labels
      barLabels
        .attr("x", width - 190)
        .attr("y", yLabels.rangeBand()/1.6 )
      // Updates xAxis
      xAxisGroup
        .call(xAxis);
       // Updates ticks
      xAxis
        .scale(xScale);
    };
  },

  removeBarChart: function () {
    $(".js-bar-chart svg").remove();
  }
};