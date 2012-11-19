<html><head><title>JavaScript SQL Text Editor</title>
<script language="javascript" type="text/javascript" src="FancyToolbar.js"></script>
<script language="javascript" type="text/javascript" src="SQLStore.js"></script>
<link rel="stylesheet" type="text/css" href="FancyToolbar.css">
 
<style>
body {
    // margin: 80px;
    // background-color: rgb(153, 255, 255);
}
 
iframe.editable {
    width: 80%;
    height: 300px;
    margin-top: 60px;
    margin-left: 20px;
    margin-right: 20px;
    margin-bottom: 20px;
}
 
table.filetable {
    border-collapse: collapse;
}
 
tr.filerow {
    border-collapse: collapse;
}
 
td.filelinkcell {
    border-collapse: collapse;
    border-right: 1px solid #808080;
    border-bottom: 1px solid #808080;
    border-top: 1px solid #808080;
}
 
td.filenamecell {
    border-collapse: collapse;
    padding-right: 20px;
    border-bottom: 1px solid #808080;
    border-top: 1px solid #808080;
    border-left: 1px solid #808080;
    padding-left: 10px;
    padding-right: 30px;
}
</style>
 
</head><body onload="initDB(); setupEventListeners(); chooseDialog();">
 
<div id="controldiv"></div>
<iframe id="contentdiv" style="display: none" class="editable"></iframe>
 
<div id="origcontentdiv" style="display: none"></div>
<div id="tempdata"></div>
 
 
</body>
</html>