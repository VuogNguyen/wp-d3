module.exports = {
  init: function() {
    var self = this;
    self.loadChartData();
  },

  loadChartData: function () {
    var self = this;
    var data = {
      'action': 'get_avg_results'
    };

    $.ajax({
      type: 'POST',
      url: ajax_skill_post.ajaxurl,
      data: data,
      success: function( result ){
        if (result.length === 0) {
          console.log("Empty Posts");
        } else {
          var data = {results: result};
          if( $('.js-pie-chart').length ) {
            self.drawPieChart(data);
          }
        }
      },
      error: function( jqXHR, textStatus, errorThrown ) {
        console.log(jqXHR);
      }
    }); 
  },

  drawPieChart: function (data) {
    var data = data;
    var colors = ['#057BB8','#E5E6E7'];
    var width = 120;
    var height = 120;
    var radius = Math.min(width, height) / 2;
    var color = d3.scale.category20();
    var pie = d3.layout.pie().sort(null);
    var arc = d3.svg.arc()
        .innerRadius(radius - 20)
        .outerRadius(radius - 28);
    var svg = d3.select(".js-pie-chart")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" 
            + width / 2.090 + "," 
            + height / 2.38  + ")");
    var path = svg.selectAll("path")
        .data(pie(data.results))
        .enter().append("path")
        .attr("fill", function(d, i) { return colors[i]; })
        .attr("d", arc);

    svg.append("svg:text")
        .attr("dy", "-8px")
        .attr("text-anchor", "middle")
        .attr("font-size","12")
        .attr("class", "top-label")
        .attr("fill","#9A9A9A")
        .text("Total");
    svg.append("svg:text")
        .attr("dy", "15px")
        .attr("text-anchor", "middle")
        .attr("font-size","18")
        .attr("text-decoration","underline")
        .attr("class", "pie-label")
        .attr("fill",colors[0])
        .text(data.results[0] + "%");
  }
};