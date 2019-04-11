var item;
var slot;
var newItem;
//Interact.js documentation at http://interactjs.io/docs/

//-------------------------------PALETTE DRAG------------------------------------//
// target elements with the "palette" class
interact('.palette').draggable({
  // enable inertial throwing
  inertia: true,
  // keep the element within the area of it's parent

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


//-------------------------------PALETTE TAP------------------------------------//
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
  $(content).css({top: palette.offsetTop + palette.offsetHeight, left: palette.offsetLeft});
});


//-------------------------------SOURCE DRAG------------------------------------//
// target elements with the "source" class
interact('.source').draggable({
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


//-------------------------------SOURCE CLICK-------------------------------------//
//upon click on a source, an item is created and moved to mouse location
interact('.source').on('tap', function (event) {
  cloneSource(event);
});


//-------------------------------ITEM DRAG------------------------------------//
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

//------------------------------ITEM TAP-----------------------------------------//
interact('.item').on('tap', function (event) {
  item = event.target;
  //if infobox doesn't exist
  if($(item).find('.item-info').length == 0 && item.className == 'item'){
    var info = document.createElement('div');
    info.className = 'item-info';
    info.innerHTML += "Some info about this puck that can be read once the puck is clicked";
    item.appendChild(info);
    $(info).css({top:item.offsetHeight-1, width: item.offsetWidth});
    var deleter = document.createElement('button');
    deleter.setAttribute('onClick','$(this).parent().remove();');
    deleter.className = 'item-delete';
    deleter.innerHTML += '<img src="trash-icon.png" />';
    item.appendChild(deleter);
    $(deleter).css({left: item.offsetWidth-1, top: 0});
  } else {
    $(item).find('.item-info').remove();
    $(item).find('.item-delete').remove();
  }
});

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
      //show the popbox to choose inputs
      $(".popbox").show();
      //make it appear where item was dropped
      $(".popbox").css({top: item.offsetTop + parseFloat(item.getAttribute('data-y')), left: item.offsetLeft + parseFloat(item.getAttribute('data-x'))});
      //creates and adds divs for the info
      populateSlot();
    }
    else{
      var puckName = item.getElementsByClassName("puck-name")[0].innerHTML;
      var puckSyllabus = item.getElementsByClassName("puck-syllabus")[0].innerHTML;
      var puckColor = item.style.backgroundColor;
      var slotPilots = slot.getElementsByClassName("slot-pilots")[0];
      //create and adds pilot info
      var pilot2 = document.createElement('div');
      pilot2.className = 'slot-pilot';
      pilot2.innerHTML = puckName;
      slotPilots.appendChild(pilot2);
      $(pilot2).css("background-color", puckColor);
      item.remove();
    }
  },
  ondropdeactivate: function (event) {
  }
});


//--------------------------------SLOT TAP--------------------------------------//
//upon click on a slot, an item is created and moved to mouse location, slot info is deleted
interact('.slot').on('tap', function (event) {
  slot = event.target;
  if (slot.innerHTML != ""){
    var puckName = slot.getElementsByClassName("slot-pilot")[0].innerHTML;
    var puckSyllabus = slot.getElementsByClassName("slot-mission")[0].innerHTML;
    var puckColor = slot.getElementsByClassName("slot-pilot")[0].style.backgroundColor;
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
    $(newItem).css("background-color", puckColor);
    //match the mouse click's position
    $(newItem).css( {top: event.pageY, left: event.pageX});
    // resize object to match source's size
    newItem.style.width = document.getElementsByClassName('source')[0].offsetWidth;
    newItem.style.height = document.getElementsByClassName('source')[0].offsetHeight;
  }
});


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
  var missionChoice = $("input[name='mission']:checked").val();
  var configChoice = $("input[name='config']:checked").val();
  var airspaceChoice = $("input[name='airspace']:checked").val();
  if(missionChoice){slot.innerHTML += missionChoice;}
  if(configChoice){slot.innerHTML += configChoice;}
  if(airspaceChoice){slot.innerHTML += airspaceChoice;}
  $(".popbox").hide();
}

//transfers info from item and popbox into the slot
function populateSlot(){
  //get info from source puck
  var puckName = item.getElementsByClassName("puck-name")[0].innerHTML;
  var puckSyllabus = item.getElementsByClassName("puck-syllabus")[0].innerHTML;
  var puckColor = item.style.backgroundColor;
  var slotPilots = slot.getElementsByClassName("slot-pilots")[0];
  //create and adds pilot info
  var pilot1 = document.createElement('div');
  pilot1.className = 'slot-pilot';
  pilot1.innerHTML = puckName;
  slotPilots.appendChild(pilot1);
  $(pilot1).css("background-color", puckColor);
  var syllabusDiv = document.createElement('div');
  syllabusDiv.innerHTML = puckSyllabus;
  syllabusDiv.className = 'slot-syllabus';
  slot.appendChild(syllabusDiv);
  item.remove();

}
