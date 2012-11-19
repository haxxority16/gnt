<?

// Connect to the database
// replace "user_name" and "password" with your real login info

$dbh = mysql_connect("localhost","user_name","password") or die("There was a problem with the database connection.");
$dbs = mysql_select_db("MyDatabase", $dbh) or die("There was a problem selecting the categories.");

// Set up a list of acceptable file extensions.
// This keeps out malicious files

$acceptable_extensions[0] = "pdf";
$acceptable_extensions[1] = "jpg";
$acceptable_extensions[2] = "gif";
$acceptable_extensions[3] = "doc";
$acceptable_extensions[4] = "ppt";
$acceptable_extensions[5] = "xls";
$acceptable_extensions[6] = "xsl";
$acceptable_extensions[7] = "PDF";
$acceptable_extensions[8] = "JPG";
$acceptable_extensions[9] = "GIF";
$acceptable_extensions[10] = "DOC";
$acceptable_extensions[11] = "PPT";
$acceptable_extensions[12] = "XLS";
$acceptable_extensions[13] = "XSL";
$acceptable_extensions[14] = "txt";
$acceptable_extensions[15] = "TXT";
$acceptable_extensions[16] = "csv";
$acceptable_extensions[17] = "CSV";
$acceptable_extensions[18] = "docx";
$acceptable_extensions[19] = "DOCX";

// Check the uploaded file to make sure it's a valid file

$validated = 1;

if($_FILES && $_FILES['file']['name']){
            
    //make sure the file has a valid file extension
    
    $file_info = pathinfo($_FILES['file']['name']);
    $acceptable_ext = 0;
                
    for($x = 0; $x < count($acceptable_extensions); $x++){
                    
        if($file_info['extension'] == $acceptable_extensions[$x]){
            $acceptable_ext = 1;
                        
        }
    }
                
    if(!$acceptable_ext){
        $validated = 0;
    }   
}else{
    $validated = 0;
}

//Now that we're sure we have a valid file, 
//we'll add it into the database

if($validated){

    // Get important information about the file and put it into variables

    $fileName = $_FILES['file']['name'];
    $tmpName  = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    // Slurp the content of the file into a variable
                    
    $fp = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    if(!get_magic_quotes_gpc()){
        $fileName = addslashes($fileName);
     }
                    
    $file_info = pathinfo($_FILES['file']['name']);

    $sql = "INSERT INTO Files SET 
                Title = "".htmlentities(stripslashes($_POST['title']))."", 
                File_Name = '".$fileName."', 
                File_Type = '".$fileType."',
                File_Size = '".$fileSize."',
                File_Content = '".$content."',
                File_Extension = '".$file_info['extension']."'";
                
                
    $result = mysql_query($sql);
            
    // If the query was successful, give success message

    if(!$result){
        echo "Could not add this file.";
         exit;
    } 
    else{
        echo  "New file successfully added.";
    }

}else{
    echo "Invalid file.";
    exit;
}
?>