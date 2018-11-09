$(function() {
  $(".item").draggable();
  $(".slot").droppable({
    drop: function(event, ui) {
      var $this = $(this);
      $this.append(ui.draggable);
      var width = $this.width();
      var height = $this.height();
      var cntrLeft = (width / 2) - (ui.draggable.width() / 2);
      var cntrTop = (height / 2) - (ui.draggable.height() / 2);
      ui.draggable.css({
        left: cntrLeft + "px",
        top: cntrTop + "px"
      });
    }
  });
});

$(function() {
  $(".sub-item").draggable();
  $(".item").droppable({
    drop: function(event, ui) {
      var $this = $(this);
      $this.append(ui.draggable);
      var width = $this.width();
      var height = $this.height();
      var cntrLeft = (width / 2) - (ui.draggable.width() / 2);
      var cntrTop = (height / 2) - (ui.draggable.height() / 2);
      ui.draggable.css({
        left: cntrLeft + "px",
        top: cntrTop + "px"
      });
    }
  });
});