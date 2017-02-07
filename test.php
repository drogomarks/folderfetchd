<?php


$mbox = imap_open("{secure.emailsrvr.com}", "aleco@raxrse.com", "Welcome!")or die(imap_last_error())or die("can't connect: ".imap_last_error());

$list = imap_list($mbox, "{secure.mailsrvr.com}", "*");

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

//make sure the list is an array
if (is_array($list)) {

     //loop through rach array index
     foreach ($list as $val) {

        //remove  any } charactors from the folder
        if (preg_match("/}/i", $val)) {
            $arr = explode('}', $val);
        }

        //also remove the ] if it exists, normally Gmail have them
        if (preg_match("/]/i", $val)) {
            $arr = explode(']/', $val);
        }

        //remove any slashes
        $folder = trim(stripslashes($arr[1]));

        //remove inbox. from the folderName its not needed for displaying purposes
        $folderName = str_replace('INBOX.', '', $folder);

        $Folders= ucwords(strtolower(imap_utf7_decode($folderName)));


//        echo "<p>".ucwords(strtolower(imap_utf7_decode($folderName)))."</p>";


    }

} else {
    echo "Folders not currently available";
}

?>


<html>

<head>
    <title>Folder Fetch 0.1</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="https://eafdbc63c97ce6bec9ef-b0a668e5876bef6fe25684caf71db405.ssl.cf1.rackcdn.com/v1-latest/canon.min.css">
    <script type="application/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type="application/javascript" src="https://eafdbc63c97ce6bec9ef-b0a668e5876bef6fe25684caf71db405.ssl.cf1.rackcdn.com/v1-latest/canon.min.js"></script>
</head>

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

        //also remove the ] if it exists, normally Gmail have them
        if (preg_match("/]/i", $val)) {
            $arr = explode(']/', $val);
        }

        //remove any slashes
        $folder = trim(stripslashes($arr[1]));

        //remove inbox. from the folderName its not needed for displaying purposes
        $folderName = str_replace('INBOX.', '', $folder);

        // TESTING THIS THING OUT OMG LJSDFLJSDF

	echo "<div class='rs-inner'>";

 if (preg_match('/^[a-zA-Z0-9 .]+$/', $folderName)) {
        echo "<h3>".$folderName."</h3>";
    } else {
	echo "<h3 style='color: red'>".$folderName."</h3>";
    }




//        echo "<div class='rs-inner'>";

 //       echo "<h3>".ucwords(strtolower(imap_utf7_decode($folderName)))."</h3>";
        echo "</div>";

    }

} else {
    echo "Folders not currently available";
}
?>
                    </div>
                </div>
            </div>
        </div>
        <div class="rs-push"></div>
    </div>
    <div class="rs-nav-footer">
        <div class="rs-container">
            <ul class="rs-nav">
                <li class="rs-nav-item">&copy; Rackspace, US</li>
                <li class="rs-nav-item"><a class="rs-nav-link" href="http://www.rackspace.com/information/legal/websiteterms" target="blank">Website Terms</a>
                    <li class="rs-nav-item"><a class="rs-nav-link" href="http://www.rackspace.com/information/legal/privacystatement" target="blank">Privacy Policy</a> </ul>
        </div>
    </div>
</body>

</html>
