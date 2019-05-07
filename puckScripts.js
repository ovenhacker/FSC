var item;
var slot;
var newItem;
var nameBank = [];
//Interact.js documentation at http://interactjs.io/docs/

window.onload = function(){
  populateNameBank();
  checkForNames();
};
//-------------------------------SOURCE DRAG X------------------------------------//
//source drag fuctionality in the x-direction (taking a puck)
interact('.source').draggable({
  startAxis: 'x',
  onstart: function(event){
    var interaction = event.interaction;
      // create an item clone of the element
      item = cloneSource(event);
      // start a drag interaction targeting the clone
      interaction.start({ name: 'drag' }, event.interactable, item);
    },
  onmove: dragItem
});

//-------------------------------PALETTE DRAG Y------------------------------------//
//source drag fuctionality in the y-direction (scrolling)
interact('#palette').draggable({
  startAxis: 'y',
  onmove: function(event){
    var palette = document.getElementById('palette');
    $(palette).scrollTop($(palette).scrollTop() - event.dy);
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
  inertia: false,
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
//----------------------------------ITEM DROP-----------------------------------//
interact('.slot-pilot').dropzone({
  accept: '.item',
  overlap: 0.50,
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
      var pilotName = item.getElementsByClassName("puck-name")[0].innerHTML;
      var pilotColor = item.style.backgroundColor;
      slot.innerHTML = pilotName;
      $(slot).css("background-color", pilotColor);
      slot.className = 'slot-pilot';
      item.remove();
      addToNameBank(pilotName);
      checkForNames();
    }
  },
  ondropdeactivate: function (event) {
  }
});

//------------------------------SLOT PILOT TAP-----------------------------------//
interact('.slot-pilot').on('tap', function (event) {
  var pilot = event.target;
  //if a pilot exists in the slot
  if (pilot.innerHTML != ""){
    var pilotName = pilot.innerHTML;
    var pilotColor = pilot.style.backgroundColor;
    $(".popbox").hide();
    //empty out the slot
    pilot.innerHTML = "";
    $(pilot).css("background-color", "silver");
    //create new puck item
    var newItem = document.createElement('div');
    newItem.className = 'item';
    document.getElementById('schedule').appendChild(newItem);
    //creates and adds divs for the info
    var nameDiv = document.createElement('div');
    nameDiv.innerHTML = pilotName;
    nameDiv.className = 'puck-name';
    newItem.appendChild(nameDiv);
    $(newItem).css("background-color", pilotColor);
    //match the mouse click's position
    $(newItem).css( {top: event.pageY, left: event.pageX});
    // resize object to match source's size
    newItem.style.width = document.getElementsByClassName('source')[0].offsetWidth;
    newItem.style.height = document.getElementsByClassName('source')[0].offsetHeight;
    removeFromNameBank(pilotName);
    checkForNames();
  }
});

//-----------------------------------SLOT SPECIFICS TAP-----------------------------//
interact('.slot-specifics').on('tap', function (event) {
  slot = event.target;
  //show the popbox to choose inputs
  $(".popbox").show();
  //make it appear where item was dropped
  $(".popbox").css({top: slot.offsetTop, left: slot.offsetLeft});
});

//-----------------------------BUSINESS RULES FUNCTIONS----------------------------//
function populateNameBank(){
  //name bank initial population
  var pilotSlots = document.getElementsByClassName('slot-pilot');
  var i;
  for(i = 0; i < pilotSlots.length; i++){
    nameBank.push(pilotSlots[i].innerHTML);
  }
}
function checkForNames(){
  //check source puck name against word bank, add/remove warning
  var sources = document.getElementsByClassName('source');
  var i;
  for(i = 0; i < sources.length; i++){
    //if name bank has the name, remove warning
    if(nameBank.includes(sources[i].getElementsByClassName('puck-name')[0].innerHTML)){
      sources[i].getElementsByClassName('puck-warning')[0].innerHTML = " ";
        $(sources[i]).find('.tooltip').remove();
      //if it doesnt, add warning
    } else {
      sources[i].getElementsByClassName('puck-warning')[0].innerHTML = "!";
      var tooltip = document.createElement('div');
      tooltip.className = 'tooltip';
      tooltip.innerHTML = 'Pilot has not been scheduled this week.';
      sources[i].appendChild(tooltip);
    }
  }
}

function removeFromNameBank(name){
  var index = nameBank.indexOf(name);
  if (index > -1) {
    nameBank.splice(index, 1);
  }
}

function addToNameBank(name){
  nameBank.push(name);
}

//--------------------------------HELPER FUNCTIONS--------------------------------//
//keeps track of items absolute position
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

function flushPopbox() {
  var mission = $("input[id='Mission']").val();
  var missionSize = $("input[id='Mission-Size']").val();
  var takeoff = $("input[id='Takeoff']").val();
  var land = $("input[id='Land']").val();
  var notes = $("input[id='Notes']").val();

  //jquery for finding specifics slots and inputting info
  if(mission){$(slot).find('div.slot-mission').html(mission);}
  if(missionSize){$(slot).find("div.slot-ship").html(missionSize);}
  if(takeoff){$(slot).find("div.slot-times").html("T: " + takeoff);}
  if(land){$(slot).find("div.slot-times").append("<br>L: " + land);}
  if(notes){$(slot).find("div.notes").html(notes);}
  $(".popbox").hide();

  //clear all values for next use
  $("input[id='Mission']").val("");
  $("input[id='Mission-Size']").val("");
  $("input[id='Takeoff']").val("");
  $("input[id='Land']").val("");
  $("input[id='Notes']").val("");
}
