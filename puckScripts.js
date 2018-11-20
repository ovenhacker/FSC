// target elements with the "item" class
interact('.item')
  .draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of the screen
    restrict: {
      restriction: {left:0, right: $(window).width(), top: 50, bottom:$(window).height()},
      endOnly: false,
      elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
    },
    // enable autoScroll
    autoScroll: true,
    // call this function on every dragmove event
    onmove: dragMoveListener,
    // call this function on every dragend event
    // onend:
  });
  // end of draggable

interact('.item')
  .snap({
    mode: 'anchor',
    anchors: [],
    range: Infinity,
    elementOrigin: { x: 0.5, y: 0.5 },
    endOnly: true
  });

interact('.slot')
  .on('dragenter', function (event) {
    var dropRect = interact.getElementRect(event.target),
        dropCenter = {
          x: dropRect.left + dropRect.width  / 2,
          y: dropRect.top  + dropRect.height / 2
        };

    event.draggable.snap({
      anchors: [ dropCenter ]
    });
  })
  .on('dragleave', function (event) {
    event.draggable.snap(false);
  });


  // target elements with the "sub-item" class
  interact('.sub-item')
    .draggable({
      // enable inertial throwing
      inertia: true,
      // keep the element within the area of it's parent
      restrict: {
        restriction: {left:0, right: $(window).width(), top: 50, bottom:$(window).height()},
        endOnly: false,
        elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
      },
      // enable autoScroll
      autoScroll: true,
      // call this function on every dragmove event
      onmove: dragMoveListener,
      // call this function on every dragend event
      // onend:
    });
    // end of "sub-item" class

    function dragMoveListener (event) {
      var target = event.target,
          // keep the dragged position in the data-x/data-y attributes
          x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
          y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

      // translate the element
      target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

      // update the posiion attributes
      target.setAttribute('data-x', x);
      target.setAttribute('data-y', y);
    }
