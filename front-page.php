<?php get_header(); ?>
  <section id="Diagram">
    <div class="col">
      <div class="heading">
        <h3 class="text-uppercase">Result</h3>
      </div>
      <div class="content">
        <div class="js-pie-chart chart chart--pie"></div>
      </div>
    </div>

    <div class="col">
      <div class="heading">
        <h3 class="text-uppercase">Breakdown</h3>
      </div>
      <div class="content">
        <div class="js-bar-chart chart chart--bar"></div>
      </div>
    </div>

    <div class="col">
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
<?php get_footer(); ?>
