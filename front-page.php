<?php get_header(); ?>
  <section id="Diagram">
    <div class="col col--result">
      <div class="heading">
        <h3 class="text-uppercase">Result</h3>
      </div>
      <div class="content">
        <div class="part">
          <?php echo do_shortcode('[piechart]'); ?>
        </div>
        <div class="part">
          <table>
            <tr>
              <td><h4 class="text-uppercase">Status:</h4></td>
              <td><p class="js-status status text-uppercase"></p></td>
              <td><a class="js-active-modal">Change</a></td>
            </tr>
            <tr>
              <td><h4 class="text-uppercase">Time:</h4></td>
              <td colspan="2" class="timestamp-col">
                <p class="timestamp">2h 2min</p>
                <p>(of max 1h 50min)</p>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col col--breakdown">
      <div class="heading">
        <h3 class="text-uppercase">Breakdown</h3>
      </div>
      <div class="content">
        <?php echo do_shortcode('[barchart]'); ?>
      </div>
    </div>

    <div class="col col--history">
      <div class="heading">
        <h3 class="text-uppercase">History</h3>
      </div>
      <div class="content">
        <ul>
          <li><p class="text"><span class="text--with-border-bottom">Invitation email</span> on Aug 15</p></li>
          <li><p class="text">Candidate started the test on Aug 15</p></li>
          <li><p class="text">Candidate completed the test on Aug 15</p></li>
        </ul>
      </div>
    </div>    
  </section>

  <div class="modal-dialog">
      <div class="modal-content">
          <a title="Close" class="close"></a>
          <form class="skill-form" action="">
          </form>
          <a class="js-skill-form-submit">Submit</a>
      </div>
  </div>

<?php get_footer(); ?>
