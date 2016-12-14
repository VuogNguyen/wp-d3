var barChart = require('../libs/bar-chart');
var pieChart = require('../libs/pie-chart');
var modal = require('../libs/modal');

module.exports = {
  init: function() {
    $('.js-skill-form-submit').on("click", function (e) {
      var skillSet = [];
      $('.skill-form input').each(function (idx) {
        var id = $(this).attr('data-id');
        var skill = $(this).attr('data-name');
        var val = $(this).val();
        skillSet.push({"skill": skill, "result": val, "id": id});
      });

      var data = {
        'action': 'update_skills',
        'skillSet': skillSet
      };

      $.ajax({
        type: 'POST',
        url: ajax_skill_post.ajaxurl,
        data: data,
        success: function( result ){
          console.log(result);
          modal.closePopup();
          barChart.removeBarChart();
          barChart.init();
          pieChart.removePieChart();
          pieChart.init();
        },
        error: function( jqXHR, textStatus, errorThrown ) {
          console.log(jqXHR);
          modal.closePopup();
        }
      });
      e.preventDefault();
    });
  }
};