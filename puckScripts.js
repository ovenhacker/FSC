// target elements with the "item" class
interact('.item').draggable({
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
  onmove: dragItem,
  // call this function on every dragend event
  // onend:
  });


// target elements with the "sub-item" class
interact('.sub-item').draggable({
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
  onmove: dragItem,
  // call this function on every dragend event
  // onend:
});

interact('.slot').dropzone({
  accept: '.item',
  overlap: 0.60,
  ondropactivate: function (event) {
  },
  ondragenter: function (event) {
    var draggableElement = event.relatedTarget,
        dropzoneElement = event.target;
  },
  ondragleave: function (event) {
    //event.relatedTarget.textContent = 'Dragged out';
  },
  ondrop: snapToSlot,
  ondropdeactivate: function (event) {
  }
});


function dragItem (event) {
  var item = event.target;
  var x = (parseFloat(item.getAttribute('data-x')) || 0) + event.dx;
  var y = (parseFloat(item.getAttribute('data-y')) || 0) + event.dy;

  // translate the element
  item.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

  // update the posiion attributes
  item.setAttribute('data-x', x);
  item.setAttribute('data-y', y);

  item.textContent = item.getAttribute('data-x') + '  ' + item.getAttribute('data-y');
}


function snapToSlot (event) {

  var slot = event.target;
  var item = event.relatedTarget;
  var slotPos = $(event.target).position();
  var itemPos = $(event.relatedTarget).position();
  x = slot.getBoundingClientRect().left;
  y = slot.getBoundingClientRect().top;

  slot.textContent = x;

  item.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
}
