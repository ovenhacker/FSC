//-----------------------------INTERACT.JS STUFF----------------------------------//
// target elements with the "palette" class
interact('.palette').draggable({
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
  onmove: dragPalette
  // call this function on every dragend event
  // onend:
});

//palette expand functionality
interact('.palette').on('tap', function (event) {
  var palette = event.target;
  document.getElementsByClassName("palette")[0].classList.toggle("expand");
  var content = palette.nextElementSibling;
  if (content.style.maxHeight){
    content.style.maxHeight = null;
    content.style.overflow = "hidden";
  } else {
    content.style.maxHeight = content.scrollHeight + "px";
    content.style.overflow = "visible";
  }
});


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
    item.style.display = "none";
    $(slot).css("background-color", "lightblue");
  },
  ondropdeactivate: function (event) {

  }
});

//clickable features
interact('.slot').on('tap', function (event) {
  var item = event.relatedTarget,
      slot = event.target;
      var paletteContent = document.getElementsByClassName('palette-content');
      paletteContent[0].innerHTML += '<div class="item">Flight 1</div>';
      //slot.textContent = "TAPPED";
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

function dragPalette (event) {
  var palette = event.target;
  var content = event.target.nextElementSibling;
  var x = (parseFloat(palette.getAttribute('data-x')) || 0) + event.dx;
  var y = (parseFloat(palette.getAttribute('data-y')) || 0) + event.dy;
  // translate the element
  palette.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  content.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  // update the posiion attributes
  palette.setAttribute('data-x', x);
  palette.setAttribute('data-y', y);
  content.setAttribute('data-x', x);
  content.setAttribute('data-y', y);
}
//--------------------------END INTERACT.JS STUFF----------------------//
