<?php
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);
        mysql_query("SET NAMES greek");
	//return $link;
  
    $quer ="select * from tasks ";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[2].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"","description":"'.$line[11].'","progress":'.$line[12].'}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[2].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":'.$line[12].'}';
   }
//$asd.=',{"id":-2,"name":"coding","code":"asdasdasd","level":1,"status":"STATUS_ACTIVE","start":1346623200000,"duration":10,"end":1347659999999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"description":"","progress":0}';
//$asd.=',{"id":-3,"name":"gant part","code":"","level":2,"status":"STATUS_ACTIVE","start":1346623200000,"duration":2,"end":1346795999999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":""}';
//$asd.=',{"id":-4,"name":"editor part","code":"","level":2,"status":"STATUS_SUSPENDED","start":1346796000000,"duration":4,"end":1347314399999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":"3"}';
//$asd.=',{"id":-5,"name":"testing","code":"","level":1,"status":"STATUS_SUSPENDED","start":1347832800000,"duration":6,"end":1348523999999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":"2:5","description":"","progress":0}';
//$asd.=',{"id":-6,"name":"test on safari","code":"","level":2,"status":"STATUS_SUSPENDED","start":1347832800000,"duration":2,"end":1348005599999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":""}';
//$asd.=',{"id":-7,"name":"test on ie","code":"","level":2,"status":"STATUS_SUSPENDED","start":1348005600000,"duration":3,"end":1348264799999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":"6"}';
//$asd.=',{"id":-8,"name":"test on chrome","code":"","level":2,"status":"STATUS_SUSPENDED","start":1348005600000,"duration":2,"end":1348178399999,"startIsMilestone":false,"endIsMilestone":false,"assigs":[],"depends":"6"}';


$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":true,"canWriteOnParent":true }';
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Teamwork</title>

  <link rel=stylesheet href="platform.css" type="text/css">
  <link rel=stylesheet href="libs/dateField/jquery.dateField.css" type="text/css">
  <link rel=stylesheet href="gantt.css" type="text/css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

  <script src="libs/jquery.livequery.min.js"></script>
  <script src="libs/jquery.timers.js"></script>
  <script src="libs/platform.js"></script>
  <script src="libs/date.js"></script>
  <script src="libs/i18nJs.js"></script>
  <script src="libs/dateField/jquery.dateField.js"></script>
  <script src="libs/JST/jquery.JST.js"></script>

  <script src="ganttUtilities.js"></script>
  <script src="ganttTask.js"></script>
  <script src="ganttDrawer.js"></script>
  <script src="ganttGridEditor.js"></script>
  <script src="ganttMaster.js"></script>
 <script src="myajax.js"></script>

</head>
<body style="background-color: #fff;">

<div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px"></div>
 <button id="showr">Περισσότερες Πληροφορίες</button>
  <button id="hidr">Απόκρυψη</button>
  
<script>
    $("#showr").click(function () {
     // $(".splitBox1").hide("fast", function () {
        // use callee so don't have to name the function
        //$(this).prev().hide("fast", arguments.callee);
             $(".splitBox1").animate({width:"878.0909094810486px"}, 700 ); 
      	$(".splitBox2").animate({width: "826.9090905189514px", left: "883.0909094810486px"}, 700 );
            $(".vSplitBar").animate({left: "883.0909094810486px"}, 700 );   
     // });
    });
    $("#hidr").click(function () {
    	$(".splitBox1").animate({width:"308.8888883590698px"}, 500 );
          	$(".splitBox2").animate({width: "1778.1111116409302px", left: "308.8888883590698px"}, 500 );
            $(".vSplitBar").animate({left: "308.8888883590698px"}, 500 ); 

    });  
</script>

<div id="taZone" style="display:none;">
  <textarea rows="8" cols="150" id="ta">
    <? print $asd;?>
  </textarea>
  <button onclick="loadGanttFromServer();">load</button>
</div>

<style>
  .resEdit {
    padding: 15px;
  }

  .resLine {
    width: 31%;     /* allagi gia na mikrinoyn ta kelia kai na emfanizontai ol ta stoixeia twn texnikwn */
    padding: 3px;
    margin: 5px;
    border: 1px solid #d0d0d0;
  }

   
</style>

<style>
  .resEdit {
    padding: 15px;
  }

  .resLine {
    width: 23%;     /* allagi gia na mikrinoyn ta kelia kai na emfanizontai ol ta stoixeia twn texnikwn */
    padding: 3px;
    margin: 5px;
    border: 1px solid #d0d0d0;
  }

   
</style>
 <!-- To esvisa gia na to kanw me allo tropo -->
 <!-- <form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input type="hidden" name="prj" id="gimBaPrj"></form>    -->

<script type="text/javascript">

var ge;  //this is the hugly but very friendly global var for the gantt editor
$(function() {

  //load templates
  $("#ganttemplates").loadTemplates();

  // here starts gantt initialization
  ge = new GanttMaster();
  var workSpace = $("#workSpace");
  workSpace.css({width:$(window).width() - 20,height:$(window).height() - 100});
  ge.init(workSpace);

  //inject some buttons (for this demo only)
  $(".ganttButtonBar div").append("<button onclick='clearGantt();' class='button'>Καθαρισμός</button>")
          .append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
          .append("<button onclick='openResourceEditor();' class='button'>edit resources</button>")
          .append("<button onclick='getFile();' class='button'>Εξαγωγή αποτελεσμάτων</button>")
          .append("<button onclick='staffmanage();' class='button'>Διαχείρηση Χρηστών</button>")
          .append("<button onclick='savenewdata();' class='button' id='sava' >Εισαγωγή νέων</button>");
  $(".ganttButtonBar h1").html("<img src='twGanttSmall.png'>");
  $(".ganttButtonBar div").addClass('buttons');
  //overwrite with localized ones
  loadI18n();

  //simulate a data load from a server.
  loadGanttFromServer();


  //fill default Teamwork roles if any
  if (!ge.roles || ge.roles.length == 0) {
    setRoles();
  }

  //fill default Resources roles if any
  if (!ge.resources || ge.resources.length == 0) {
    setResource();
  }


  //debug time scale
  $(".splitBox2").mousemove(function(e){
    var x=e.clientX-$(this).offset().left;
    var mill=Math.round(x/(ge.gantt.fx) + ge.gantt.startMillis)
    $("#ndo").html(x+" "+new Date(mill))
  });

});


function loadGanttFromServer(taskId, callback) {

  //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
  loadFromLocalStorage();

  //this is the real implementation
  /*//var taskId = $("#taskSelector").val();
   var prof = new Profiler("loadServerSide");
   prof.reset();

   $.getJSON("ganttAjaxController.jsp", {CM:"LOADPROJECT",taskId:taskId}, function(response) {
   //console.debug(response);
   if (response.ok) {
   prof.stop();
   ge.loadProject(response.project);
   ge.checkpoint(); //empty the undo stack
   if (typeof(callback)=="function")
   callback(response);
   }else {
   jsonErrorHandling(response);
   }
   });*/
}


function saveGanttOnServer() {

  //this is a simulation: save data to the local storage or to the textarea
  saveInLocalStorage();


  var prj = ge.saveProject();
   delete prj.resources;
   delete prj.roles;
   var prof = new Profiler("saveServerSide");
   prof.reset();

   if (ge.deletedTaskIds.length>0){
   if (!confirm("TASK_THAT_WILL_BE_REMOVED\n"+ge.deletedTaskIds.length))
   return;
   }

   $.ajax("ganttAjaxController.jsp", {
   dataType:"json",
   data: {CM:"SVPROJECT",prj:JSON.stringify(prj)},
   type:"POST",

   success: function(response) {
   if (response.ok) {
   prof.stop();
   if (response.project){
   ge.loadProject(response.project); //must reload as "tmp_" ids are now the good ones
   } else {
   ge.reset();
   }
   } else {
   var errMsg="Errors saving project\n";
   if (response.message)
   errMsg=errMsg+response.message+"\n";

   for (var i=0;i<response.errorMessages.length;i++){
   errMsg=errMsg+response.errorMessages[i]+"\n";
   }
   alert(errMsg);
   }
   }

   });
}


//-------------------------------------------  Create some demo data ------------------------------------------------------

// Αυτα πρέπει να τα διαβάζει από την βάση
function setRoles() {
  ge.roles = [
    {
      id:"tmp_1",
      name:"Υπεύθυνος Έργου"
    },
    {
      id:"tmp_2",
      name:"Αρμόδιος εργασίας"
    },
    {
      id:"tmp_3",
      name:"Υπάλληλος"
    }
  ];
}

function setResource() {
  var res = [];
  var res1 = [];
  for (var i = 1; i <= 100; i++) {
    res.push({id:"tmp_" + i,name:"Εργαζόμενος " + i});    
  }  
   res1.push({id:"tmp_" + i,name:"Εργαζόμενος " + i});  
  ge.resources = res;
   ge.staff = res1;
}



function clearGantt() {
  ge.reset();
}

function loadI18n() {
  GanttMaster.messages = {
    "CHANGE_OUT_OF_SCOPE":"NO_RIGHTS_FOR_UPDATE_PARENTS_OUT_OF_EDITOR_SCOPE",
    "START_IS_MILESTONE":"START_IS_MILESTONE",
    "END_IS_MILESTONE":"END_IS_MILESTONE",
    "TASK_HAS_CONSTRAINTS":"TASK_HAS_CONSTRAINTS",
    "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"GANTT_ERROR_DEPENDS_ON_OPEN_TASK",
    "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK",
    "TASK_HAS_EXTERNAL_DEPS":"TASK_HAS_EXTERNAL_DEPS",
    "GANNT_ERROR_LOADING_DATA_TASK_REMOVED":"GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
    "ERROR_SETTING_DATES":"ERROR_SETTING_DATES",
    "CIRCULAR_REFERENCE":"CIRCULAR_REFERENCE",
    "CANNOT_DEPENDS_ON_ANCESTORS":"CANNOT_DEPENDS_ON_ANCESTORS",
    "CANNOT_DEPENDS_ON_DESCENDANTS":"CANNOT_DEPENDS_ON_DESCENDANTS",
    "INVALID_DATE_FORMAT":"INVALID_DATE_FORMAT",
    "TASK_MOVE_INCONSISTENT_LEVEL":"TASK_MOVE_INCONSISTENT_LEVEL",

    "GANT_QUARTER_SHORT":"trim.",
    "GANT_SEMESTER_SHORT":"sem."
  };
}


//-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------
function openResourceEditor() {
  var editor = $("<div>");
  editor.append("<h2>Resource editor</h2>");
  editor.addClass("resEdit");

  for (var i in ge.resources) {
    var res = ge.resources[i];
    var inp = $("<input type='text'>").attr("pos", i).addClass("resLine").val(res.name);
    editor.append(inp).append("<br>");
  }

  var sv = $("<div>save</div>").css("float", "right").addClass("button").click(function() {
    $(this).closest(".resEdit").find("input").each(function() {
      var el = $(this);
      var pos = el.attr("pos");
      ge.resources[pos].name = el.val();
    });
    ge.editor.redraw();
    closeBlackPopup();
  });
  editor.append(sv);

  var ndo = createBlackPage(800, 500).append(editor);
}

//-------------------------------------------  Διαχείρηση Χρηστών ------------------------------------------------------
function staffmanage() {
  var editor = $("<div>");
  editor.append("<h2>Διαχείρηση Χρηστών</h2>");
  editor.addClass("resEdit");

  var i = 1;
  <?php  $quer ="select * from staff ";
    $result = mysql_query($quer);
     while ($line = mysql_fetch_row($result)){ ?>
   
   var m1 = '<?print $line[0];?>'
   var m2 = '<?print $line[1];?>'
   var m3 = '<?print $line[2];?>'

  var inp = $("<input type='text'>").addClass("resLine").val(m1);
  var inp1 = $("<input type='text'>").addClass("resLine").val(m2);
  var inp2 = $("<input type='text'>").addClass("resLine").val(m3);
  editor.append(inp);
  editor.append(inp1);
  editor.append(inp2);
  <? } ?>
 

  var sv = $("<div>save</div>").css("float", "right").addClass("button").click(function() {
    $(this).closest(".resEdit").find("input").each(function() {
      var el = $(this);
      var pos = el.attr("pos");
      ge.staff[pos].name = el.val();
    });
    ge.editor.redraw();
    closeBlackPopup();
  });
  editor.append(sv);

  var ndo = createBlackPage(800, 500).append(editor);
}



//-------------------------------------------  datashow ------------------------------------------------------
function datashow() {
  var editor = $("<div>");
  editor.append("<h2>Εμφάνιση δεδομένων</h2>");
  editor.addClass("resEdit1");

  var i = 1;
  <?php  $quer ="select * from tasks ";
    $result = mysql_query($quer);
     while ($line = mysql_fetch_row($result)){ ?>
   
   var m1 = '<?print $line[0];?>'
   var m2 = '<?print $line[1];?>'
   var m3 = '<?print $line[2];?>'
   var m4 = '<?print $line[4];?>'

  var inp = $("<input type='text'>").addClass("resLine1").css({readonly: "readonly"}).val(m1);
  var inp1 = $("<input type='text'>").addClass("resLine1").val(m2);
  var inp2 = $("<input type='text'>").addClass("resLine1").val(m3);
  var inp3 = $("<input type='text'>").addClass("resLine1").val(m4);
  editor.append(inp);
  editor.append(inp1);
  editor.append(inp2);
  editor.append(inp3);
  <? } ?>
 


  var ndo = createBlackPage(900, 500).append(editor);
}
//-------------------------------------------  Get project file as JSON (used for migrate project from gantt to Teamwork) ------------------------------------------------------
function getFile() {
  $("#gimBaPrj").val(JSON.stringify(ge.saveProject()));
  $("#gimmeBack").submit();
  $("#gimBaPrj").val("");

  /*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
   console.debug(uriContent);
   neww=window.open(uriContent,"dl");*/
}


//-------------------------------------------  LOCAL STORAGE MANAGEMENT (for this demo only) ------------------------------------------------------
Storage.prototype.setObject = function(key, value) {
  this.setItem(key, JSON.stringify(value));
};


Storage.prototype.getObject = function(key) {
  return this.getItem(key) && JSON.parse(this.getItem(key));
};


function loadFromLocalStorage() {
  var ret;
  if (localStorage) {
    if (localStorage.getObject("teamworkGantDemo")) {
      ret = localStorage.getObject("teamworkGantDemo");
    }
  } else {
    $("#taZone").show();
  }
  if (!ret || !ret.tasks || ret.tasks.length == 0)
    ret = JSON.parse($("#ta").val());
  ge.loadProject(ret);
  ge.checkpoint(); //empty the undo stack
}


function saveInLocalStorage() {
  var prj = ge.saveProject();
  if (localStorage) {
    localStorage.setObject("teamworkGantDemo", prj);
  } else {
    $("#ta").val(JSON.stringify(prj));
  }
}


</script>


<div id="gantEditorTemplates" style="display:none;">
  <div class="__template__" type="GANTBUTTONS"><!--
  <div class="ganttButtonBar">
    <h1 style="float:left">task tree/gantt</h1>
    <div class="buttons">
    <button onclick="$('#workSpace').trigger('undo.gantt');" class="button textual" title="undo"><span class="teamworkIcon">&#39;</span></button>
    <button onclick="$('#workSpace').trigger('redo.gantt');" class="button textual" title="redo"><span class="teamworkIcon">&middot;</span></button>
    <span class="ganttButtonSeparator"></span>
    <button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');" class="button textual" title="insert above"><span class="teamworkIcon">l</span></button>
    <button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');" class="button textual" title="insert below"><span class="teamworkIcon">X</span></button>
    <span class="ganttButtonSeparator"></span>
    <button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');" class="button textual" title="indent task"><span class="teamworkIcon">.</span></button>
    <button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');" class="button textual" title="unindent task"><span class="teamworkIcon">:</span></button>
    <span class="ganttButtonSeparator"></span>
    <button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');" class="button textual" title="move up"><span class="teamworkIcon">k</span></button>
    <button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');" class="button textual" title="move down"><span class="teamworkIcon">j</span></button>
    <span class="ganttButtonSeparator"></span>
    <button onclick="$('#workSpace').trigger('zoomMinus.gantt');" class="button textual" title="zoom out"><span class="teamworkIcon">)</span></button>
    <button onclick="$('#workSpace').trigger('zoomPlus.gantt');" class="button textual" title="zoom in"><span class="teamworkIcon">(</span></button>
    <span class="ganttButtonSeparator"></span>
    <button onclick="$('#workSpace').trigger('deleteCurrentTask.gantt');" class="button textual" title="delete"><span class="teamworkIcon">&cent;</span></button>
      &nbsp; &nbsp; &nbsp; &nbsp;
      <button onclick="saveGanttOnServer();" class="button first big" title="save">save</button>
    </div></div>
  --></div>

  <div class="__template__" type="TASKSEDITHEAD">
  <table class="gdfTable" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="height:40px">
      <th class="gdfColHeader" style="width:35px;"></th> 
      <th class="gdfColHeader" style="width:25px;"></th>
      <th class="gdfColHeader gdfResizable" style="width:55px;">κωδικός</th>
      <th class="gdfColHeader gdfResizable" style="width:200px;">Τίτλος</th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">Αρχή</th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">Τέλος</th>
      <th class="gdfColHeader gdfResizable" style="width:65px;">Διάρκεια</th>
      <th class="gdfColHeader gdfResizable" style="width:140px;">Συσχέτιση με εργασία</th>
      <th class="gdfColHeader gdfResizable" style="width:200px;">Ανατεθειμένο σε:</th>
    </tr>
    </thead>
  </table>
  </div>

  <div class="__template__" type="TASKROW"><!--
  <tr taskId="(#=obj.id#)" class="taskEditRow" level="(#=level#)">
    <th class="gdfCell edit" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >e</span></th>
    <td class="gdfCell" align="center"  onclick='datashow();'><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
    <td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)"></td>

    <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10#)px;"><input type="text" name="name" value="(#=obj.name#)" style="(#=obj.level>0?'border-left:2px dotted orange':''#)"></td>

    <td class="gdfCell"><input type="text" name="start"  value="" class="date"></td>
    <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
    <td class="gdfCell"><input type="text" name="duration" value="(#=obj.duration#)"></td>
    <td class="gdfCell"><input type="text" name="depends" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
    <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
  </tr>
  --></div>

  <div class="__template__" type="TASKEMPTYROW"><!--
  <tr class="taskEditRow emptyRow" >
    <th class="gdfCell" align="right"></th>
    <td class="gdfCell" align="center"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
  </tr>
  --></div>

  <div class="__template__" type="TASKBAR"><!--
  <div class="taskBox" taskId="(#=obj.id#)" >
    <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
      <div class="taskStatus" status="(#=obj.status#)"></div>
      <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
      <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

      <div class="taskLabel"></div>
      <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
    </div>
  </div>
  --></div>


  <div class="__template__" type="CHANGE_STATUS"><!--
    <div class="taskStatusBox">
      <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="Ενεργό"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Ολοκληρωμένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Αποτυχημένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Ανεσταλμένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Μη ορισμένο"></div>
    </div>
  --></div>


<!--  <form name="savedata" method="get" action="savedata.php"> -->
  <div class="__template__" type="TASK_EDITOR">
  <div class="ganttTaskEditor">
  <table width="100%">
    <tr>
      <td>
        <table cellpadding="5">
         <tr>
         <td><label for="id">Α/Α</label><br><input type="text" name="id" id="id" value="" class="formElements" readonly="readonly"></td>
          <tr></tr>
            <td><label for="code">κωδικός</label><br><input type="text" name="code" id="code" value="" class="formElements"></td>
           </tr><tr>
            <td><label for="name">Τίτλος</label><br><input type="text" name="name" id="name" value=""  size="35" class="formElements"></td>
          </tr>
          <tr></tr>
            <td>
              <label for="description">Περιγραφή</label><br>
              <textarea rows="5" cols="30" id="description" name="description" class="formElements"></textarea>
            </td>
          </tr>
        </table>
      </td>
      <td valign="top">
        <table cellpadding="5">
          <tr>
          <td colspan="2"><label for="status">Κατάσταση</label><br><div id="status" class="taskStatus" status=""></div></td>
          <tr>
          <td colspan="2"><label for="progress">Πρόοδος εργασίας</label><br><input type="text" name="progress" id="progress" value="" size="3" class="formElements"></td>
          </tr>
           <tr>
           <td><label for="level">Επίπεδο εργασίας</label><br><input type="text" name="level" id="level" value="" size="3" class="formElements"></td>
          <td><label for="progress">Συσχέτιση με εργασία</label><br><input type="text" name="dependence" id="dependence" value="" size="3" class="formElements"></td>
          </tr>
          <tr>
          <td><label for="start">Αρχή</label><br><input type="text" name="start" id="start"  value="" class="date" size="10" class="formElements"><input type="checkbox" id="startIsMilestone"> </td>
          <td><label for="duration">Διάρκεια</label><br><input type="text" name="duration" id="duration" value=""  size="5" class="formElements"></td>
        </tr><tr>
          <td><label for="end">Τέλος</label><br><input type="text" name="end" id="end" value="" class="date"  size="10" class="formElements"><input type="checkbox" id="endIsMilestone"></td>
          <tr></tr>
        </table>
      </td>
    </tr> 
    </table>
<!--- <form action="upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>   -->

<!-- <form action="add_file.php" method="post" enctype="multipart/form-data"> 
        <input type="file" name="uploaded_file" id="file"><br>
       <input type="submit" value="Μεταφόρτωση Αρχείου">
    </form>  --> 
  <form enctype='multipart/form-data' name='frmupload' action='' method='POST'>  
  <input type="file" id="fileInput" name="fileInput" multiple="multiple" onchange="GetFileInfo()"/>
    <div id="info" style="margin-top:30px"></div>
</form>

<?
if(isset($_FILES['fileInput'])) {
    // Make sure the file was sent without errors
    if($_FILES['fileInput']['error'] == 0) {
        // Connect to the database
        $dbLink = new mysqli('localhost', 'root', '5281', 'gantt');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $fname = $dbLink->real_escape_string($_FILES['fileInput']['name']);
        $mediaType = $dbLink->real_escape_string($_FILES['fileInput']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['fileInput']['tmp_name']));
        $size = intval($_FILES['fileInput']['size']);
 
        // Create the SQL query
        $query = "INSERT INTO file (name, type, size, data, created) VALUES ('{$fname}', '{$mediaType}', '{$size}', '{$data}', NOW() )";      // argotera prepei na proste8ei kai project_id
  $resulta = mysql_query($query);
    $linea = mysql_fetch_row($resulta); 
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
echo "<div id='imageframe'></div>"; ?>

<!--- Καλο για την περίπτωση που θέλουμε να ενεβάσουμε περισσότερα του ενός αρχεία
<input type="file" name="attachment" id="attachment" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
<div id="moreUploads"></div>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput();">Πρόσθεσε και άλλο αρχείο</a></div>
 -->   
    <h2>Ανατεθειμένο σε:</h2>
  <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
    <tr>
      <th style="width:100px;">name</th>
      <th style="width:70px;">role</th>
      <th style="width:30px;">est.wklg.</th>
      <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
    </tr>
  </table>

  <div style="text-align: right; padding-top: 20px"><button id="saveButton" type="submit" class="button big" onClick="savedata()">save</button></div>
  </div>
  </div>
<!--  </form>   -->

  <div class="__template__" type="ASSIGNMENT_ROW"><!--
  <tr taskId="(#=obj.task.id#)" assigId="(#=obj.assig.id#)" class="assigEditRow" >
    <td ><select name="resourceId"  class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
    <td ><select type="select" name="roleId"  class="formElements"></select></td>
    <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
    <td align="center"><span class="teamworkIcon delAssig" style="cursor: pointer">d</span></td>
  </tr>
  --></div>

</div>
<script type="text/javascript">
  $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig) {

    var resEl = assigTr.find("[name=resourceId]");
    for (var i in taskAssig.task.master.resources) {
      var res = taskAssig.task.master.resources[i];
      var opt = $("<option>");
      opt.val(res.id).html(res.name);
      if (taskAssig.assig.resourceId == res.id)
        opt.attr("selected", "true");
      resEl.append(opt);
    }


    var roleEl = assigTr.find("[name=roleId]");
    for (var i in taskAssig.task.master.roles) {
      var role = taskAssig.task.master.roles[i];
      var optr = $("<option>");
      optr.val(role.id).html(role.name);
      if (taskAssig.assig.roleId == role.id)
        optr.attr("selected", "true");
      roleEl.append(optr);
    }

    if (taskAssig.task.master.canWrite) {
      assigTr.find(".delAssig").click(function() {
        var tr = $(this).closest("[assigId]").fadeOut(200, function() {
          $(this).remove();
        });
      });
    }


  });
</script>

<script type="text/javascript">
// function savedata(){

// var name = document.getElementById("name").value; 
 // var code = document.getElementById("code").value; 
 //      alert(code);
 //       window.location.href="savedata.php?name="+name+"&code="+code;
 //}

</script>

<script type="text/javascript">
function savedata(){
   var xmlhttp;
var name = document.getElementById("name").value;
var id = document.getElementById("id").value;  
var code = document.getElementById("code").value; 
var description = document.getElementById("description").value; 
var status = document.getElementById("status").value; 
var progress = document.getElementById("progress").value; 
var duration = document.getElementById("duration").value;
var dependence = document.getElementById("dependence").value; 
var level = document.getElementById("level").value; 
var starti = document.getElementById("start").value;   
var endi = document.getElementById("end").value; 

/*
var fileInput = document.getElementById("fileInput"); 

 for (var i = 0; i < fileInput.files.length; i++) {
var file = fileInput.files[i];
                       
var fname = file.name;
var size = file.size;
var mediaType = file.type; 
//var data = file.slice(0);

//var data = new Blob();
//var data = file.mozSlice(0);

  var data = <?=$tmp_name;?>
               alert(data);

//var data = blob.slice(0);                   
//var data =readAsBinaryString(blob);                 
}

//for (var member in data){  // gia na dw ta orismata toy object file i toy object blob
//    alert(data[member]);
//}
*/
var startIsMilestone;
var endIsMilestone;

if (document.getElementById("startIsMilestone").checked==true){
startIsMilestone='true';
} else {
startIsMilestone='false';
}

if (document.getElementById("endIsMilestone").checked==true){
endIsMilestone='true';
} else {
endIsMilestone='false';
}

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera
      xmlhttp=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }

   xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }    
xmlhttp.open("GET","savedata.php?name="+name+"&code="+code+"&id="+id+"&description="+description+"&status="+status+"&progress="+progress+"&progress="+progress+"&duration="+duration+"&dependence="+dependence+"&starti="+starti+"&endi="+endi+"&level="+level+"&startIsMilestone="+startIsMilestone+"&endIsMilestone="+endIsMilestone,true);
xmlhttp.send();
}
</script>

<script type="text/javascript">
function savenewdata(){

  var task;

  //make task editor
  var taskEditor = $.JST.createFromTemplate({}, "TASK_EDITOR");



    //bind dateField on dates
    taskEditor.find("#start").click(function() {
      $(this).dateField({
        inputField:$(this),
        callback: function(date) {
          var dur = parseInt(taskEditor.find("#duration").val());
          date.clearTime();
          taskEditor.find("#end").val(new Date(computeEndByDuration(date.getTime(), dur)).format());
        }
      });
    });

    //bind dateField on dates
    taskEditor.find("#end").click(function() {
      $(this).dateField({
        inputField:$(this),
        callback: function(end) {
          var start = Date.parseString(taskEditor.find("#start").val());
          end.setHours(23, 59, 59, 999);

          if (end.getTime() < start.getTime()) {
            var dur = parseInt(taskEditor.find("#duration").val());
            start = incrementDateByWorkingDays(end.getTime(), -dur);
            taskEditor.find("#start").val(new Date(computeStart(start)).format());
          } else {
            taskEditor.find("#duration").val(recomputeDuration(start.getTime(), end.getTime()));
          }
        }
      });
    });

    //bind blur on duration
    taskEditor.find("#duration").change(function() {
      var start = Date.parseString(taskEditor.find("#start").val());
      var el = $(this);
      var dur = parseInt(el.val());
      dur = dur <= 0 ? 1 : dur;
      el.val(dur);
      taskEditor.find("#end").val(new Date(computeEndByDuration(start.getTime(), dur)).format());
    });

    //bind add assignment
    taskEditor.find("#addAssig").click(function() {
      var assigsTable = taskEditor.find("#assigsTable");
      var assigRow = $.JST.createFromTemplate({task:task,assig:{id:"tmp_" + new Date().getTime()}}, "ASSIGNMENT_ROW");
      assigsTable.append(assigRow);
    });

    taskEditor.find("#status").click(function() {
      var tskStatusChooser = $(this);
      var changer = $.JST.createFromTemplate({}, "CHANGE_STATUS");
      changer.css("top", tskStatusChooser.position().top);
      changer.find("[status=" + task.status + "]").addClass("selected");
      changer.find(".taskStatus").click(function() {
        tskStatusChooser.attr("status", $(this).attr("status"));
        changer.remove();
        tskStatusChooser.show();
      });
      tskStatusChooser.hide().oneTime(3000, "hideChanger", function() {
        changer.remove();
        $(this).show();
      });
      tskStatusChooser.after(changer);
    });


  var ndo = createBlackPage(800, 500).append(taskEditor);

}
 </script>
          
  <script type="text/javascript">     
              function GetFileInfo () {
            var fileInput = document.getElementById ("fileInput");

            var message = "";
            if ('files' in fileInput) {
                if (fileInput.files.length == 0) {
                    message = "Please browse for one or more files.";
                } else {
                    for (var i = 0; i < fileInput.files.length; i++) {
                        message += "<br /><b>" + (i+1) + ". file</b><br />";
                        var file = fileInput.files[i];
                        if ('name' in file) {
                            message += "name: " + file.name + "<br />";
                        }
                        else {
                            message += "name: " + file.fileName + "<br />";
                        }
                        if ('size' in file) {
                            message += "size: " + file.size + " bytes <br />";
                        }
                        else {
                            message += "size: " + file.fileSize + " bytes <br />";
                        }
                        }
                    }
                }
             
            else {
                if (fileInput.value == "") {
                    message += "Please browse for one or more files.";
                    message += "<br />Use the Control or Shift key for multiple selection.";
                }
                else {
                    message += "Your browser doesn't support the files property!";
                    message += "<br />The path of the selected file: " + fileInput.value;
                }
            }

            var info = document.getElementById ("info");
            info.innerHTML = message; 
          }
    </script>  
    
    
    <script type="text/javascript">  
    //αυτο χρησιμοποιείται για την περίπτωση που θέλουμε να ανεβάσουμε περισσότερα του ενός αρχεία 
 var upload_number = 2;
function addFileInput() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "attachment"+upload_number);
 	d.appendChild(file);
 	document.getElementById("moreUploads").appendChild(d);
 	upload_number++;
}
    </script>    
</body>
</html>