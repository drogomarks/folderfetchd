<?php
// Set variables from the HTML form
$email = $_POST['email'];
$pass = $_POST['pass'];
$server = $_POST['server'];
// Set a new variable adding brackets to host value
$host_server = "{ $server }";
// Remove the spaces added in previous variable because I'm not smart enoguh to do this all at once. 
$thehost = str_replace(' ', '', $host_server);

// Creat connection and authenticate to IMAP server
$mbox = imap_open("$thehost", $email, $pass)or die(imap_last_error())or die("can't connect: ".imap_last_error());

//Gather list of folders the user has
$list = imap_list($mbox, "$thehost", "*");

//remove  any } characters from the folder
if (preg_match("/}/i", $list[0])) {
    $arr = explode('}', $list[0]);
}

//also remove the ] if it exists, normally Gmail have them
if (preg_match("/]/i", $list[0])) {
    $arr = explode(']/', $list[0]);
}

//remove INBOX. from the folder name
$folder = str_replace('INBOX.', '', stripslashes($arr[1]));

//check if inbox is first folder if not reorder array
if($folder !== 'INBOX'){
    krsort($list);
}



//remove  any } characters from the folder
if (preg_match("/}/i", $list[0])) {
    $arr = explode('}', $list[0]);
}

//remove INBOX. from the folder name
$folder = str_replace('INBOX.', '', stripslashes($arr[1]));

//check if inbox is first folder if not reorder array
if($folder !== 'INBOX'){
    krsort($list);
}
?> 

<html>

<head>
    <title>Folderfetch'd 0.1</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="https://eafdbc63c97ce6bec9ef-b0a668e5876bef6fe25684caf71db405.ssl.cf1.rackcdn.com/v1-latest/canon.min.css">
    <script type="application/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="application/javascript" src="https://eafdbc63c97ce6bec9ef-b0a668e5876bef6fe25684caf71db405.ssl.cf1.rackcdn.com/v1-latest/canon.min.js"></script>
</head>


<link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


<body class="rs-responsive">
    <div class="rs-wrapper">
        <div class="rs-body">
            <div class="rs-container">
                <div class="rs-main">
                    <div class="rs-content rs-panel">
                        <div class="rs-inner">
                           <h2 class="rs-page-title">
                                Folderfetch'd for
                                <?php echo $email; ?>:
                           </h2>
                                <p style="font-style: italic;"> <b>folder.subfolder</b> = subfolder </p>
                                <p style="font-style: italic;"> <b style='color: red'>RED</b> = contains special character(s) </p>
                           </div>

<?php if (is_array($list)) {

     	//loop through rach array index
     	foreach ($list as $val) {

        	//remove  any } charactors from the folder
        	if (preg_match("/}/i", $val)) {
            		$arr = explode('}', $val);
        	}

        	//also remove the ] if it exists
        	if (preg_match("/]/i", $val)) {
            		$arr = explode(']/', $val);
        	}

        	//remove any slashes
        	$folder = trim(stripslashes($arr[1]));

        	//remove inbox. from the folderName its not needed for displaying purposes
        	$folderName = str_replace('INBOX.', '', $folder);

        	// Echoing out div tag to put iterations in body container

        	echo "<div class='rs-inner'>";
		
		// Match iterations that have a space or special character

 		if (preg_match('/^[a-zA-Z0-9 .]+$/', $folderName)) {
        		echo "<h3>".$folderName."</h3>";
    		} else {
        		echo "<h3 style='color: red'>".$folderName."</h3>";
    		}

        	echo "</div>";

    	}

} else {
    echo "Folders not currently available";
}

?>
	<div class="rs-inner">
	
	<a href="/" class="rs-btn">Back</a> 
	</div>

                    </div>
                </div>
            </div>
        </div>
        <div class="rs-push"></div>
    </div>
    <div class="rs-nav-footer">
        <div class="rs-container">
            <ul class="rs-nav">
                <li class="rs-nav-item">&copy; Rudy Marks</li>
        </div>
    </div>
</body>

</html> 
