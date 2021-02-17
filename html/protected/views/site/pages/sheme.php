<?php
$this->layout = 'clear';
?>

<!-- 1. Подключите библиотеку (jQuery не требуется) -->
<script src='/js/arrows.1.0.0.js' type='text/javascript'></script>


</script>


<div style="position: relative;" id="ex3-common-parent"><canvas height="345" width="985" style="position: absolute; left: 0px; top: 0px; z-index: -10;"></canvas>
  <div class="row space-30"></div>

  <div class="row">
    <div class="col-xs-3 ui-draggable"></div>

    <div class="col-xs-3 ui-draggable">
      <div class="btn btn-primary btn-block ex3-ceo">CEO<br><small>Vladimir Evstegneev</small></div>
    </div>

    <div style="left: 51px; top: -1px;" class="col-xs-3 ui-draggable">
      <div class="btn btn-primary btn-block ex3-coo">COO<br><small>Ruslan Dobrolubov</small></div>
    </div>
  </div>

  <div class="space-40"></div>

  <div class="row">
    <div class="col-xs-3 ui-draggable">
      <div class="btn btn-default btn-block ex3-dep">Sales</div>
      <div class="btn btn-warning btn-block">Stepan Fedotov</div>
      <div class="btn btn-info btn-block">Konstantin Shishkin</div>
  	</div>

    <div style="left: 1px; top: 50px;" class="col-xs-3 ui-draggable">
      <div class="btn btn-default btn-block ex3-dep">Finances</div>
      <div class="btn btn-warning btn-block">Mariya Nikolaeva</div>
      <div class="btn btn-info btn-block">Elena Abashina</div>
      <div class="btn btn-info btn-block">Munira Abdinazarova</div>
    </div>

    <div style="left: -13px; top: 37px;" class="col-xs-3 ui-draggable">
      <div class="btn btn-default btn-block ex3-dep">IT</div>
      <div class="btn btn-warning btn-block">Mikhail Soloviev</div>
      <div class="btn btn-info btn-block">Tasya Hlebnikova</div>
    </div>

    <div class="col-xs-3 ui-draggable">
      <div class="btn btn-default btn-block ex3-dep-emp">Logistic</div>
      <div class="btn btn-info btn-block">Leonid Voroncov</div>
    </div>
  </div>

  <div class="row space-50"></div>
</div>




<script>
// Example 3: Initialize
  var arrowsDrawer3 = $cArrows('#ex3-common-parent', { render:{lineWidth: 3, strokeStyle: '#992E2E'}});

  // Example 3: Draw arrows
  arrowsDrawer3.arrow('.ex3-ceo','.ex3-coo', {arrow: {arrowType:'double-headed'}, render: {strokeStyle:'#617783'}})
  .arrow('.ex3-ceo','.ex3-dep')
  .arrow('.ex3-coo','.ex3-dep-emp', {
      arrow: {
        connectionType: 'side',
        sideFrom: 'right',
        sideTo: 'top'
      }});

  // Example 3: Перерисовка при перемещении с jQuery Ui
  $(function() {
    $( "#ex3-common-parent .col-xs-3" ).draggable({
      containment: "#ex3-common-parent",
      scroll: false,
      handle: ".btn",
      drag: function( event, ui ) {
        arrowsDrawer3.redraw();
      }
    });
  });
