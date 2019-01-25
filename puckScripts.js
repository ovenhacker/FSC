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

//slot dropzone features for item
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
  //destroys puck on drop, copies data to slot
  ondrop: function (event) {
    var item = event.relatedTarget,
    slot = event.target;
    $(".popbox").show();
    $(".popbox").css({top: item.offsetTop + parseFloat(item.getAttribute('data-y')), left: item.offsetLeft + parseFloat(item.getAttribute('data-x'))});
    if(slot.innerHTML == ""){
      slot.textContent = item.textContent;
        $(slot).css("background-color", item.style.backgroundColor);
      item.remove();
    }
  },
  ondropdeactivate: function (event) {
  }
});

// trash dropzone features
interact('.trash').dropzone({
  accept: '.item',
  overlap: 0.10,
  ondrop: function (event) {
    var item = event.relatedTarget;
    item.remove();
    }
});

//upon click on a slot, an item is created and moved to mouse location, slot info is deleted
interact('.slot').on('tap', function (event) {
  var slot = event.target;
  var slotInfo = slot.innerHTML;
  var slotColor = slot.style.backgroundColor;
  if (slot.innerHTML != ""){
    //if slot is permenant, don't dont delete it
    if (!(slot.className.includes("permenant"))){
      slot.innerHTML = "";
      $(slot).css("background-color", "white");
    }
    document.getElementById("schedule").innerHTML += '<div class="item">New Puck</div>';
    var items = document.getElementsByClassName('item');
    newItem = items[items.length-1];
    newItem.innerHTML = slotInfo;
    $(newItem).css("background-color", slotColor);
    $(newItem).css( {top: event.pageY, left: event.pageX});
    // resize object to match slot's size
    newItem.style.width = document.getElementsByClassName('slot')[0].offsetWidth;
    newItem.style.height = document.getElementsByClassName('slot')[0].offsetHeight;
  }
});
//--------------------------END INTERACT.JS STUFF----------------------//

//keeps track of absolute item position
function dragItem (event) {
  var item = event.target;
  var x = (parseFloat(item.getAttribute('data-x')) || 0) + event.dx;
  var y = (parseFloat(item.getAttribute('data-y')) || 0) + event.dy;
  // translate the element
  item.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  // update the posiion attributes
  item.setAttribute('data-x', x);
  item.setAttribute('data-y', y);
  // resize object to match slot's size
  item.style.width = document.getElementsByClassName('slot')[0].offsetWidth;
  item.style.height = document.getElementsByClassName('slot')[0].offsetHeight;
}

//keeps track of palette position relative to start
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

function clearPopBox(){
  $(".popbox").hide();
}
