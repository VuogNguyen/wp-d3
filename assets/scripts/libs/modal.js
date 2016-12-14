module.exports = {
  init: function(data) {
    var self = this;
    self.$modalPress = $(".modal-dialog");

    self.activePopup();
    self.closePopup();
    self.submitPopupForm();
  },

  activePopup: function () {
    var self = this;
    var data = {'action': 'get_skills'};
    $('.js-active-modal').on("click", function (e) {
    $.ajax({
      type: 'POST',
      url: ajax_skill_post.ajaxurl,
      data: data,
      success: function( result ){
        if (result.length === 0) {
          console.log("Empty Posts");
        } else {
          $html = self.renderPopupForm(result);
          var $targetForm = $('.skill-form');
          $targetForm.empty();
          $targetForm.append($html);
        }
      },
      error: function( jqXHR, textStatus, errorThrown ) {
        console.log(jqXHR);
      }
    });
    self.$modalPress.addClass("modal-dialog-active");
   }); 
  },

  closePopup: function () {
    var self = this;
    $(".modal-dialog, .modal-dialog .close").on("click", function (e) {
        if(e.target != this) return;
        self.$modalPress.removeClass("modal-dialog-active");
    });
  },

  renderPopupForm: function(skillSet) {
    var self = this;
    var $html = "";
    for (var idx = 0; idx < skillSet.length; idx++) {
      $html += '<h3>' + skillSet[idx].skill + '</h3>';
      $html += '<input data-id="'+ skillSet[idx].id +'"" data-name="'+ skillSet[idx].skill +'" value="'+ skillSet[idx].result +'"/>';
    }
    return $html;
  },

  submitPopupForm: function () {
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
        },
        error: function( jqXHR, textStatus, errorThrown ) {
          console.log(jqXHR);
        }
      });
      e.preventDefault();
    });
  }
};