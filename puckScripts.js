var item;
var slot;
var newItem;
//-----------------------------PALETTE PROPERTIES----------------------------------//
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
//---------------------------END PALETTE PROPERTIES--------------------------------//

//-------------------------------PALETTE EXPAND------------------------------------//
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
//------------------------------END PALETTE EXPAND---------------------------------//

//-------------------------------ITEM PROPERTIES------------------------------------//
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
    item = event.target;
  },
  // call this function on every dragmove event
  onmove: dragItem
  // call this function on every dragend event
  // onend:
  });
//------------------------------END ITEM PROPERTIES--------------------------------//

//-------------------------------SOURCE PROPERTIES------------------------------------//
// target elements with the "source" class
interact('.source')
.draggable({
  onmove: dragItem
})
.on('move',function(event){
  var interaction = event.interaction;
    // if the pointer was moved while being held down and an interaction hasn't started yet
    if (interaction.pointerIsDown && !interaction.interacting()) {
      // create an item clone of the element
      item = cloneSource(event);
      // start a drag interaction targeting the clone
      interaction.start({ name: 'drag' }, event.interactable, item);
    }
  });
//------------------------------END SOURCE PROPERTIES--------------------------------//

//-------------------------------SOURCE CLICK-------------------------------------//
//upon click on a source, an item is created and moved to mouse location
interact('.source').on('tap', function (event) {
  cloneSource(event);
});
//-----------------------------END SOURCE CLICK-------------------------------------//

//---------------------------------ITEM DROP---------------------------------------//
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
    item = event.relatedTarget,
    slot = event.target;
    //only allow drop if the slot is empty
    if(slot.innerHTML == ""){
      //get name and syllabus values
      var puckName = item.getElementsByClassName("puck-name")[0].innerHTML;
      var puckSyllabus = item.getElementsByClassName("puck-syllabus")[0].innerHTML;
      //show the popbox to choose inputs
      $(".popbox").show();
      //make it appear where item was dropped
      $(".popbox").css({top: item.offsetTop + parseFloat(item.getAttribute('data-y')), left: item.offsetLeft + parseFloat(item.getAttribute('data-x'))});
      //creates and adds divs for the info
      var nameDiv = document.createElement('div');
      nameDiv.innerHTML = puckName;
      nameDiv.className = 'puck-name';
      slot.appendChild(nameDiv);
      var syllabusDiv = document.createElement('div');
      syllabusDiv.innerHTML = puckSyllabus;
      syllabusDiv.className = 'puck-syllabus';
      slot.appendChild(syllabusDiv);
      $(slot).css("background-color", item.style.backgroundColor);
      item.remove();
    }
  },
  ondropdeactivate: function (event) {
  }
});
//-------------------------------END ITEM DROP-------------------------------------//

//--------------------------------SLOT CLICK--------------------------------------//
//upon click on a slot, an item is created and moved to mouse location, slot info is deleted
interact('.slot').on('tap', function (event) {
  slot = event.target;
  if (slot.innerHTML != ""){
    var puckName = slot.getElementsByClassName("puck-name")[0].innerHTML;
    var puckSyllabus = item.getElementsByClassName("puck-syllabus")[0].innerHTML;
    var slotColor = slot.style.backgroundColor;
  }
  //if slot is not blank
  if (slot.innerHTML != ""){
    $(".popbox").hide();
    //empty out the slot
    slot.innerHTML = "";
    $(slot).css("background-color", "white");
    //create new puck item
    var newItem = document.createElement('div');
    newItem.className = 'item';
    document.getElementById('schedule').appendChild(newItem);
    //creates and adds divs for the info
    var nameDiv = document.createElement('div');
    nameDiv.innerHTML = puckName;
    nameDiv.className = 'puck-name';
    newItem.appendChild(nameDiv);
    var syllabusDiv = document.createElement('div');
    syllabusDiv.innerHTML = puckSyllabus;
    syllabusDiv.className = 'puck-syllabus';
    newItem.appendChild(syllabusDiv);
    $(newItem).css("background-color", slotColor);
    //match the mouse click's position
    $(newItem).css( {top: event.pageY, left: event.pageX});
    // resize object to match slot's size
    newItem.style.width = document.getElementsByClassName('source')[0].offsetWidth;
    newItem.style.height = document.getElementsByClassName('source')[0].offsetHeight;
  }
});
//-------------------------------END SLOT CLICK------------------------------------//

//----------------------------------TRASH CAN--------------------------------------//
// trash dropzone features
interact('.trash').dropzone({
  accept: '.item',
  overlap: 0.10,
  ondrop: function (event) {
    item = event.relatedTarget;
    item.remove();
    }
});
//--------------------------------END TRASH CAN------------------------------------//

//--------------------------------HELPER FUNCTIONS--------------------------------//
//keeps track of absolute item position
function dragItem (event) {
  var x = (parseFloat(item.getAttribute('data-x')) || 0) + event.dx;
  var y = (parseFloat(item.getAttribute('data-y')) || 0) + event.dy;
  // translate the element
  item.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
  // update the posiion attributes
  item.setAttribute('data-x', x);
  item.setAttribute('data-y', y);
  // resize object to match slot's size
  item.style.width = document.getElementsByClassName('source')[0].offsetWidth;
  item.style.height = document.getElementsByClassName('source')[0].offsetHeight;
}

//keeps track of palette and its content's absolute position
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

//clones the source puck into an item puck
function cloneSource(event){
  slot = event.target;
  //get info from source puck
  var puckName = slot.getElementsByClassName("puck-name")[0].innerHTML;
  var puckSyllabus = slot.getElementsByClassName("puck-syllabus")[0].innerHTML;
  var slotColor = slot.style.backgroundColor;
  //create new puck item
  newItem = document.createElement('div');
  newItem.className = 'item';
  document.getElementById('schedule').appendChild(newItem);
  //creates and adds divs for the info
  var nameDiv = document.createElement('div');
  nameDiv.innerHTML = puckName;
  nameDiv.className = 'puck-name';
  newItem.appendChild(nameDiv);
  var syllabusDiv = document.createElement('div');
  syllabusDiv.innerHTML = puckSyllabus;
  syllabusDiv.className = 'puck-syllabus';
  newItem.appendChild(syllabusDiv);
  $(newItem).css("background-color", slotColor);
  //match the mouse click's position
  var itemWidth = document.getElementsByClassName('source')[0].offsetWidth;
  var itemHeight = document.getElementsByClassName('source')[0].offsetHeight;
  $(newItem).css( {top: event.pageY - itemHeight/3, left: event.pageX - itemWidth/3});
  // resize object to match slot's size
  newItem.style.width = itemWidth;
  newItem.style.height = itemHeight;
  return newItem;
}

function clearPopBox() {
  //var mission = document.getElementById("Mission").value,
  //config = document.getElementById("Config").value,
  //airspace = document.getElementById("Airspace").value;
  //slot.innerHTML += '  [' + mission + '], [' + cofig + '], [' + airspace + ']';
  //document.getElementById("Mission").value = "";
  //document.getElementById("Config").value = "";
  //document.getElementById("Airspace").value = "";
  $(".popbox").hide();
}
