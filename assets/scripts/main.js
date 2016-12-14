var home = require('./pages/home');
var barChart = require('./libs/bar-chart');

home.init();


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
      if( $('#Diagram .js-bar-chart').length ) {
        barChart.init(result);
      }      
    }
  },
  error: function( jqXHR, textStatus, errorThrown ) {
    console.log(jqXHR);
  }
});