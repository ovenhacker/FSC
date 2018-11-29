// target elements with the "item" class
interact('.item').draggable({
  // enable inertial throwing
  inertia: true,
  // keep the element within the area of it's parent
  restrict: {
    restriction: '#schedule',
    endOnly: false,
    elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
  },
  // enable autoScroll
  autoScroll: true,
  // call this function on every dragstart event
  onstart: function (event) {

  },
  // call this function on every dragmove event
  onmove: dragItem
  // call this function on every dragend event
  // onend:
  });


//dropzone features
interact('.slot').dropzone({
  accept: '.item',
  overlap: 0.60,
  ondropactivate: function (event) {

  },
  ondragenter: function (event) {
  },
  ondragleave: function (event) {
    //event.relatedTarget.textContent = 'Dragged out';
  },
  ondrop: function (event) {
    var item = event.relatedTarget,
        slot = event.target;
    slot.textContent = item.textContent;
    item.remove();
    $(slot).css("background-color", "lightblue");
  },
  ondropdeactivate: function (event) {

  }
});

//clickable features
interact('.slot').on('tap', function (event) {
  var slot = event.target;
  var new = document.createElement("new");
  document.body.appendChild(new);
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
}
