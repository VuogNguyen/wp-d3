var home = require('./pages/home');
var barChart = require('./libs/bar-chart');

home.init();

if( $('#Diagram .js-bar-chart').length ) {
  barChart.init();
}