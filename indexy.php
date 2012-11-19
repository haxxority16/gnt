<?php
 $db = 'gantt';
 $link = mysql_connect("localhost", "root", "5281")
		or die("Δεν είναι δυνατή η σύνδεση με τη βάση: " . mysql_error());
	mysql_select_db($db);

   mysql_query("SET NAMES utf8");
   
  session_start();
  $proj = $_GET['proj'];
  $password = $_POST['password'];
  
  
    $quera ="select user_id,licenses from staff where password like '$password' ";
    $resulta = mysql_query($quera);
    $linea = mysql_fetch_row($resulta);
  
  $license = $linea[1];
  $user_id = $linea[0];
  $_SESSION['license']  = $linea[1];
  $_SESSION['user_id']  = $linea[0];
	//return $link;
    $quer1 ="select canwrite,canwriteonparent from licenses where license_id = $license";
    $result1 = mysql_query($quer1);
    $line1  = mysql_fetch_row($result1);
  
  if ($proj=='full'||$proj==null){
     $quer ="select * from tasks where parent = 0 and readit = 1 and project_id in (select project_id from staff_tasks where user_id = $linea[0]) ";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":'.$line[16].',"now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';
   }
$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":'.$line1[0].',"canWriteOnParent":'.$line1[1].' }';
  }else{
  // if ($proj==null){
 //  $proj=2;
 //  }
    $quer ="select * from tasks where project_id = $proj and readit = 1";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);
    
$asd ='{"tasks":[{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":"'.$line[16].'","now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';

   while ($line=mysql_fetch_row($result)) {
$asd.=',{"id":'.$line[0].',"name":"'.$line[1].'","code":"'.$line[0].'","level":'.$line[3].',"status":"'.$line[4].'","start":'.$line[5].',"duration":'.$line[6].',"end":'.$line[7].',"startIsMilestone":'.$line[8].',"endIsMilestone":'.$line[9].',"assigs":[],"depends":"'.$line[10].'","description":"'.$line[11].'","progress":"'.$line[12].'","full_mes":"'.$line[16].'","now_mes":"'.$line[17].'","fprogress":"'.$line[18].'","ffull_mes":"'.$line[19].'","fnow_mes":"'.$line[20].'"}';
   }
$asd.='],"selectedRow":0,"deletedTaskIds":[],"canWrite":'.$line1[0].',"canWriteOnParent":'.$line1[1].' }';
}
?>

<!DOCTYPE HTML>
<html>
<head>
 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Gantt manager</title>

  <link rel=stylesheet href="platform.css" type="text/css">
  <link rel=stylesheet href="libs/dateField/jquery.dateField.css" type="text/css">
  <link rel=stylesheet href="gantt.css" type="text/css">   
  <link rel=stylesheet href="jquery.alerts.css" type="text/css">     

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
  <script src="jquery.alerts.js"></script> 
 <!-- <script src="myajax.js"></script>   Den fainetai na toy leipei -->

</head>
<body style="background-color: #fff;" >

<div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px">
<!--- <button onclick="loadGanttFromServer();">Μετάβαση σε έργο</button> Den xreiazetai en teli-->
<!--- <select name="project" onChange="getCurrencyCode('getproject.php?project='+this.value)">
  <? //$result =  mysql_query("select name, project_id from tasks where parent = 0");   ?>
   <option value="">ΕΠΙΛΕΞΤΕ</option>
<? //while ($linew= mysql_fetch_row($result)) {?>
  <option value="<?// print $linew[1];?>"><?// print $linew[0]; ?></option>
  <?// } ?>
  <option value="full">Σύνοψη Έργων</option>
</select> -->
<!--- <button id="showr">Περισσότερες Πληροφορίες</button>
  <button id="hidr">Απόκρυψη</button> -->
</div>

<div id="taZone" style="display:none;"> 
<!--- <div> -->
  <textarea rows="8" cols="150" id="ta" name="ta">
    <? print $asd;?> 
 </textarea>
<!-- <button onclick="loadGanttFromServer();">load</button> -->  
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

  .boxi {
  background-color: #F4F4F4;
  border: 1px solid #CCC;
  height: 100px;
  width: 200px;
  padding: 5px;
  display:none;
  position:absolute;
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
  $(".ganttButtonBar div")//.append("<button onclick='clearGantt();' class='button'>Καθαρισμός</button>")
          .append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
          .append("<button onclick='openResourceEditor();' class='button'>edit resources</button>")
      //    .append("<button onclick='getFile();' class='button'>Εξαγωγή αποτελεσμάτων</button>")
          .append("<button onclick='staffmanage();' class='button'>Διαχείριση Χρηστών</button>")
          .append("<button onclick='savenewdata();' class='button' id='sava' >Εισαγωγή νέων</button>")
           .append("<button onclick='dok();' class='button1' id='hidr'>Απόκρυψη</button>")
          .append("<button  onclick='dok();' class='button1' id='showr' >Περισσότερες Πληροφορίες</button>")
          .append("<select name='project' class='button' id='prosel' onChange='getCurrencyCode(this.value)'> <?$result =  mysql_query('select name, project_id from tasks where parent = 0 and project_id in (select project_id from staff_tasks where user_id = "'.$user_id.'" )'); ?><option value=''>ΕΠΙΛΕΞΤΕ</option><? while ($linew= mysql_fetch_row($result)) {?><option value='<? print $linew[1];?>'><? print $linew[0]; ?></option><? } ?><option value='full'>Σύνοψη Έργων</option></select> ")
          .append("<select name='project' class='buttonslct' id='propacktask' onclick='packtaskchange();'> <option value=''>Επιλέξτε</option></select> ");
 //  .append("<? $result =  mysql_query('select name, project_id from tasks where parent = 0');   ?> ")
 //  .append(" <option value=''>ΕΠΙΛΕΞΤΕ</option>  ")
 //.append(" <? while ($linew= mysql_fetch_row($result)) {?> ")
 //  .append(" <option value='<? print $linew[1];?>'><? print $linew[0]; ?></option> ")
 //  .append(" <? } ?> ")
 //  .append(" <option value='full'>Σύνοψη Έργων</option> ")
 //  .append(" </select> ");
 ////$(".ganttButtonBar h1").html("<img src='twGanttSmall.png'>");
 
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
  
 // var inp3 = $("<table  cellspacing='1' cellpadding='0' width='100%' id='assigsTable'><h4>Εισαγωγή νέου τεχνικού:</h4><tr><th style='width:100px;'>Όνομα</th><th style='width:70px;'>Ιδιότητα</th><th style='width:30px;' id='addAssig1'><span class='teamworkIcon' style='cursor: pointer'>+</span></th></tr></table>");
 // editor.append(inp3);

   var inp3 = $("<a style='cursor: pointer' onclick=nge()>Εισαγωγή νέου τεχνικού</a>");
 editor.append(inp3); 
  

  //var sv = $("<div>save</div>").css("float", "right").addClass("button").click(function() {
  //  $(this).closest(".resEdit").find("input").each(function() {
   //   var el = $(this);
  //    var pos = el.attr("pos");
  //    ge.staff[pos].name = el.val();
  //  });
  //  ge.editor.redraw();
  //  closeBlackPopup();
 // });
 // editor.append(sv);
 

  var ndo = createBlackPage(800, 500).append(editor);
}
  function nge(){
  $(".ganttButtonBar div")//.append("<button onclick='clearGantt();' class='button'>Καθαρισμός</button>")
  .append("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")
  var inp4 = $("<a style='cursor: pointer'>Εισαγωγήee νέου τεχνικού</a>");
 editor.append(inp4);
 //alert('adsad');
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
  if (!ret || !ret.tasks || ret.tasks.length == 0) {
    ret = JSON.parse($("#ta").val());
  ge.loadProject(ret);
  ge.checkpoint(); //empty the undo stack
}
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
    </div></div>
  --></div>

  <!--- TO esvisa --->
  <!---  <button onclick="saveGanttOnServer();" class="button first big" title="save">save</button> den 8eloume na kanei save me ayto to koumpi -->



  <div class="__template__" type="TASKSEDITHEAD">
  <table class="gdfTable" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="height:40px">
      <th class="gdfColHeader" style="width:35px;"></th> 
      <th class="gdfColHeader" style="width:25px;"></th>
      <th class="gdfColHeader gdfResizable" style="width:55px;">κωδικός</th>
      <th class="gdfColHeader gdfResizable" style="width:386px;">Τίτλος</th>
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

    <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10#)px;"><a><input type="text" name="name" value="(#=obj.name#)" style="(#=obj.level>0?'border-left:2px double orange':''#); font-size: (#=17-2*obj.level#)px;"></a></td>

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

  <div class="__template__" type="TASKBAR"><!---
  <div class="taskBox" taskId="(#=obj.id#)" >
    <div class="layout (#=obj.hasExternalDep?'extDep':''#)" style="background-color:(#=obj.level==0?"#808080":(obj.level==1?"#A9A9A9":(((obj.level==2)&&(obj.full_mes==0))?"#ADD8E6":"#b4f3b4"))#);">  
        <div class="taskLabel"><tr><tr><font color=(#=obj.full_mes>0?"#006600":"#FFFFFF"#)>( (#=obj.now_mes#) / (#=obj.full_mes#) ) - (#=obj.progress#)%</font></tr><br><tr><font color="#3300CC">( (#=obj.fnow_mes#) / (#=obj.ffull_mes#) ) - (#=obj.fprogress#)%</font></tr></tr></div>
      <div class="taskProgress1" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(32, 255, 0);'#);"></div>
     <div class="taskProgress"  style="width:(#=obj.fprogress>100?100:obj.fprogress#)%; background-color:(#=obj.fprogress>100?'red':'rgb(53,155,251);'#);"></div>

      <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>
      <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
      
    </div>

  </div>
--> </div>
  <!-- 0 ta perigramata den mas aresoun ta afairesame <div class="layout (#=obj.hasExternalDep?'extDep':''#)" style="background-color:(#=obj.level==0?"#CCDDEE":(obj.level==1?"#0000EE":(obj.level==2?"#CC0000":"#EEFFFF"))#); border:(#=obj.level<1?'3px LightSalmon solid;':''#); border-left:(#=obj.full_mes==0?'10px MediumBlue solid;':''#)">  -->
  <!--- 1 <div class="taskStatus" status="(#=obj.status#)"></div> htan sto Taskbar gia na fainetai i katastasi tis ergasias-->
  <!--- 2 an 8elw na emfanizetai to pososto vazw (#=obj.progress#)% meta to div -->

  <div class="__template__" type="CHANGE_STATUS"><!--
    <div class="taskStatusBox">
      <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="Ενεργό"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Ολοκληρωμένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Αποτυχημένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Ανεσταλμένο"></div>
      <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Μη ορισμένο"></div>
    </div>
  --></div>




  <div class="__template__" type="TASK_EDITOR">
  <div class="ganttTaskEditor" >
<!--  <form> -->
  <table width="100%">
    <tr>
      <td>
        <table cellpadding="5">
         <tr>
         <td><label for="κωδικός">Α/Α</label><br><input type="text" name="id" id="id" value="" class="formElements" readonly="readonly"></td>
          <tr></tr>
          <td>
          <label for="code">κωδικός</label><br><input type="text" name="code" id="code" value="" class="formElements"></td>  
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
           <td><span onmouseover="ShowText('Message'); return true;" onmouseout="HideText('Message'); return true;" href="javascript:ShowText('Message')">
           <label>Σύνολο Πόρων</label></span><br><input type="text" name="full_mes" id="full_mes" value="" size="3" class="formElements" onchange="jalert()">
           <div  id="Message"  class="boxi">Σύνολο Πόρων ορίζεται η συνολική ποσότητα της μετρικής που χρησιμοποιούμε π.χ. εργατοώρες, εργατομήνες κ.α.</div>
           </td>
          <td><span onmouseover="ShowText('Message1'); return true;" onmouseout="HideText('Message1'); return true;" href="javascript:ShowText('Message1')">
          <label>Πόροι έως τώρα</label> <div  id="Message1"  class="boxi">Πόροι έως τώρα ορίζεται η τιμή της μετρικής όπως αυτή έχει καθοριστεί έως τώρα</div></span><br><input type="text" name="now_mes" id="now_mes" value="" size="3" class="formElements" onchange="jalert()"></td>
          <td><label for="progress">Πρόοδος εργασίας</label><br><input type="text" name="progress" id="progress" value="" size="3" class="formElements"></td>
          </tr>
          
           <tr>
           <td><span onmouseover="ShowText('fMessage'); return true;" onmouseout="HideText('fMessage'); return true;" href="javascript:ShowText('fMessage')">
           <label>Σύνολο Δαπανών</label></span><br><input type="text" name="ffull_mes" id="ffull_mes" value="" size="3" class="formElements" onchange="jalert()">
           <div  id="fMessage"  class="boxi">Σύνολο Δαπανών ορίζεται το σύνολο των χρημάτων που διατίθενται για την ολοκλήρωση της συγκεκριμένης εργασίας</div>
           </td>
          <td><span onmouseover="ShowText('fMessage1'); return true;" onmouseout="HideText('fMessage1'); return true;" href="javascript:ShowText('fMessage1')">
          <label>Δαπάνες έως τώρα</label> <div  id="fMessage1"  class="boxi">Δαπάνες έως τώρα ορίζεται το σύνολο των χρημάτων τα οποία έχουν δαπανηθεί έως τώρα</div></span><br><input type="text" name="fnow_mes" id="fnow_mes" value="" size="3" class="formElements" onchange="jalert()"></td>
          <td><label for="fprogress">Οικονομική Πρόοδος</label><br><input type="text" name="fprogress" id="fprogress" value="" size="3" class="formElements"></td> 
          </tr>
          
           <tr>
           <td><label for="level">Επίπεδο εργασίας</label><br><input type="text" name="level" id="level" value="" size="3" class="formElements"></td>
          <td><label for="depends">Συσχέτιση με εργασία</label><br><input type="text" name="depends" id="depends" value="" size="3" class="formElements"></td>
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

<table cellpadding="10" cellspacing="0" width="100%" border="0" align="center">


<tr><td>
  <!--  <form enctype='multipart/form-data' name='frmupload' action='' method='POST'>  -->
<input name="upload" type="submit" class="button big" id="upload" value=" Διαθέσιμα αρχεία " onClick="savefile()">       <!--- "location.href='fileuploadinblob/index.php'" --->
<!--	 </form>     -->
</td></tr>


<!--- Καλο για την περίπτωση που θέλουμε να ενεβάσουμε περισσότερα του ενός αρχεία
<input type="file" name="attachment" id="attachment" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
<div id="moreUploads"></div>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput();">Πρόσθεσε και άλλο αρχείο</a></div>
 -->   
   
  <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
   <h2>Ανατεθειμένο σε:</h2>
    <tr>
      <th style="width:100px;">Όνομα</th>
      <th style="width:70px;">Ιδιότητα</th>
      <th style="width:30px;">est.wklg.</th>
      <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
    </tr>
  </table>	 
  <div style="text-align: right; padding-top: 20px"><button id="anairesi" name="anairesi" class="button big" onClick="anairesi();">Αναίρεση</button><button id="saveButton" name="saveButton" type="submit" class="button big" onClick="savedata();" >Αποθήκευση</button></div>
  </div> 
  </table> 
 <!--  </form>      -->
  </div
 </form>  

      
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

<!-- Elegxos tis or8otitas twn timwn> -->
<script type="text/javascript">
 function jalert(){
var full_mes = document.getElementById("full_mes").value; 
var now_mes = document.getElementById("now_mes").value;
var ffull_mes = document.getElementById("ffull_mes").value; 
var fnow_mes = document.getElementById("fnow_mes").value;
var progress = document.getElementById("progress").value; 
var fprogress = document.getElementById("fprogress").value; 

if (parseFloat(now_mes)>parseFloat(full_mes)) {
 document.getElementById("now_mes").value = 0;
 document.getElementById("progress").value = 0; 
jAlert('Οι "Πόροι εως τώρα" δεν μπορεί να ξεπερνούν το "Σύνολο των Πόρων" ');
}

if (parseFloat(fnow_mes)>parseFloat(ffull_mes)) {
document.getElementById("fnow_mes").value = null;
 document.getElementById("fprogress").value = 0; 
jAlert('Οι "Δαπάνες εως τώρα" δεν μπορεί να ξεπερνούν το "Σύνολο των Δαπανών" ');
}

}
</script>   

<script type="text/javascript">
function clearcombo(el)
{
    for (var i = el.options.length; i >= 0; i--)
    {
        el.options[i] = null;
    }
    el.selectedIndex = -1;
} 
</script> 

<script type="text/javascript">
function anairesi(){

var id = document.getElementById("id").value;

<?
mysql_query("SET NAMES utf8");
 $proj = $_GET['proj'];
 $id = 266;//$_POST['id'];
 $quer ="select * from tasks where project_id = $proj and readit = 1 ";
 $quer.="and id = $id ";
    $result = mysql_query($quer);
    $line = mysql_fetch_row($result);  
    
    $startday = $line[5]/1000;
    $sdt = new DateTime("@$startday");
    
    
    $endday = $line[7]/1000;
    $edt = new DateTime("@$endday");

    ?>
   //    alert('<?echo $id;?>');
 document.getElementById("name").value =  '<?= $line[1]; ?>';
 document.getElementById("code").value  = '<?= $line[0]; ?>'; 
document.getElementById("description").value  =  '<?= $line[11]; ?>';
document.getElementById("status").value =   '<?= $line[4]; ?>';
document.getElementById("progress").value = '<?= $line[12]; ?>'; 
document.getElementById("fprogress").value = '<?= $line[18]; ?>'; 
document.getElementById("duration").value = '<?= $line[6]; ?>';
document.getElementById("depends").value = '<?= $line[10]; ?>'; 
document.getElementById("level").value = '<?= $line[3]; ?>'; 
document.getElementById("start").value = '<?= $sdt->format("d/m/y");?>';   
document.getElementById("end").value = '<?= $edt->format("d/m/Y"); ?>';   // alli enalaktiki gia tin imerominia '<?= $readable_date=date("m/d/Y",$line[7]/1000); ?>'
document.getElementById("full_mes").value  =  '<?= $line[16]; ?>';
document.getElementById("now_mes").value  =   '<?= $line[17]; ?>';
document.getElementById("fnow_mes").value  =  '<?= $line[20]; ?>';
document.getElementById("ffull_mes").value =   '<?= $line[19]; ?>';
}
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
var fprogress = document.getElementById("fprogress").value; 
var duration = document.getElementById("duration").value;
var depends = document.getElementById("depends").value; 
var level = document.getElementById("level").value; 
var starti = document.getElementById("start").value;   
var endi = document.getElementById("end").value; 
var full_mes = document.getElementById("full_mes").value; 
var now_mes = document.getElementById("now_mes").value; 
var ffull_mes = document.getElementById("ffull_mes").value; 
var fnow_mes = document.getElementById("fnow_mes").value; 
var startIsMilestone;
var endIsMilestone;

//var prosel = document.getElementById("prosel").value;
//var prosel = this.value;
//alert(prosel.options[prosel.selectedIndex].value);

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
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;  //pros to paron den epistrefei kapoia metavliti
    //  loadGanttFromServer();  
     
    }
  }    
xmlhttp.open("GET","savedata.php?name="+name+"&code="+code+"&id="+id+"&description="+description+"&status="+status+"&progress="+progress+"&fprogress="+fprogress+"&duration="+duration+"&depends="+depends+"&starti="+starti+"&endi="+endi+"&level="+level+"&startIsMilestone="+startIsMilestone+"&endIsMilestone="+endIsMilestone+"&full_mes="+full_mes+"&now_mes="+now_mes+"&ffull_mes="+ffull_mes+"&fnow_mes="+fnow_mes,true);//+"&fname="+fname+"&size="+size+"&mediaType="+mediaType+"&data="+data,true);
xmlhttp.send();
 //var tmp    = document.forms[0];
//tmp.submit();

	setTimeout("location.reload(true);",100);   //gia na kanei refresh kai na fainontai oi allages
  //	setTimeout("loadFromLocalStorage();",100);
  
  // setTimeout("location.replace('index.php?proj='+prosel.options[prosel.selectedIndex].value);",100);   //to exei parei apo alloy to project_id
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
 	file.setAttribute("name", "userfile"+upload_number);
 	d.appendChild(file);
 	document.getElementById("moreUploads").appendChild(d);
 	upload_number++;
}
    </script>
    
    
    
<script type="text/javascript">
function get_groject(){
/*
   var xmlhttp;
   var project = document.getElementById("project").value;
       //    alert(project);
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
xmlhttp.open("GET","getproject.php?project="+project,true);
xmlhttp.send();
*/
var project = document.getElementById("project").value;
alert(project);
var pap=window.parent;
pap.location.replace("getproject.php?project="+project);

}
</script>  

<!--- anoigei antistoixo para8iro mesw toy opoioy mporei na ginei apo8ikeysi arxeioy gia tin sigkekrimeni ergasia-->
<script type="text/javascript">
function savefile(){

var id = document.getElementById("id").value;

  window.open('fileuploadinblob/index.php?id='+id,'popuppage', 
      'width=500,toolbar=1,resizable=1,scrollbars=yes,height=300,top=100,left=100'); 
}
</script> 


<script type="text/javascript">
function packtaskchange(){
 var pap=window.frames["ifrummy"].window;
var proj = document.getElementById("prosel").value;
  
 pap.location.replace("packtaskchange.php?project="+proj);
}
</script>



<!-- oi dyo parakatw synarthshs xrhsimopoioyntai stin periptwsi poy kapoios allaksi project mesw drop down menu, gia na fortwnontai ta antistoixa gantt>  -->
<script> 
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}

		
function getCurrencyCode(mstrURL)
{	
  var 	strURL =  "getproject.php?project="+mstrURL;
	var req = getXMLHTTP();	
  
	if (req) 
	{
		//function to be called when state is changed
		req.onreadystatechange = function()
		{
			//when state is completed i.e 4
			if (req.readyState == 4) 
			{			
				// only if http status is "OK"
				if (req.status == 200)
				{						
					document.getElementById('ta').value= req.responseText;
          loadGanttFromServer();  // tin kalo edw se periptwsi poy den 8elw koumpi wste na ginei fortwsi twn dedomenwn sta diagrammata gantt
        //   alert(req.responseText);							
				} 
			//	else 
			//	{
			//		alert("There was a problem while using XMLHTTP:\n" + req.statusText);
			//	}
			}				
		 }			
		 req.open("GET", strURL, true);
		 req.send(null);
	}
  
 // setTimeout("location.replace('index.php?proj='+prosel.options[prosel.selectedIndex].value);",100);
 location.replace('index.php?proj='+prosel.options[prosel.selectedIndex].value);				
} 
</script> 

<script> 
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		} 	
		return xmlhttp;
	}

  function getCurrencyCode1(packtask)
{	
  var 	strURL =  "getpacktask.php?packtask="+packtask+"&project="+<?= $proj;?> ;
	var req = getXMLHTTP();	
  
	if (req) 
	{
		req.onreadystatechange = function()
		{
			if (req.readyState == 4) 
			{			
				if (req.status == 200)
				{						
					document.getElementById('ta').value= req.responseText;
          loadGanttFromServer();  
           alert(req.responseText);				
			}				
		 }			
		 req.open("GET", strURL, true);
		 req.send(null);
	}
  } 
  }
</script> 

<!-- gia na emfanizontai ypodeikseis se pedia poy 8eloun erminia-->
<script type="text/javascript" language="JavaScript">
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
rX = self.pageXOffset;
rY = self.pageYOffset;
}
else if(document.documentElement && document.documentElement.scrollTop) {
rX = document.documentElement.scrollLeft;
rY = document.documentElement.scrollTop;
}
else if(document.body) {
rX = document.body.scrollLeft;
rY = document.body.scrollTop;
}
if(document.all) {
cX += rX; 
cY += rY;
}
d.style.left = (cX+10) + "px";
d.style.top = (cY+10) + "px";
}
function HideText(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowText(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//-->
</script>

<!-- gia na megalwnei kai na mikrainei to box me tis plirofories--> 
<script type="text/javascript" language="JavaScript">
function dok(){
    $("#showr").click(function () {
     // $(".splitBox1").hide("fast", function () {
        // use callee so don't have to name the function
        //$(this).prev().hide("fast", arguments.callee); 
        $(".splitBox1").animate({width:"1065.091px"}, 700 ); 
      	$(".splitBox2").animate({width: "666.917px", left: "1071.08px"}, 700 );
        $(".vSplitBar").animate({left: "1066.08px"}, 700 );   
     // });
       });
   $("#hidr").click(function () { 
      $(".splitBox1").animate({width:"308.8888883590698px"}, 500 );
      $(".splitBox2").animate({width: "1778.1111116409302px", left: "308.8888883590698px"}, 500 );
      $(".vSplitBar").animate({left: "303.889px"}, 500 );

  }); 
    }
</script>

<script type="text/javascript">

	function ajax_mine(stateID)
	{
		alert(stateID);
		$.ajax({
			type: "POST",
			url: "datasupplier.php",
			dataType: "json",
			data: {stateID:stateID},
     		success: function(data)
				{
					console.log("debug!");
					alert(data);
					//$('#secondselect').append('<option value="" selected="selected">Select YpoTask</option>');
					
					$("#secondselect option[value='secondmaker']").remove();
					
					for (var i=1; i<data.length; i+=2) {
						//console.log(data[i]);
						$('#secondselect').append('<option value='+data[i+1]+'>'+data[i]+'</option>');
					}
					
				}, error:function(data,msg,xhr) {console.log(data); console.log(msg); console.log(xhr);}
			});
	}
</script>


</body>
</html>          