<?php
include 'top.php';


if (isset($_GET["gameID"])){
    $gameID = htmlentities($_GET['gameID'], ENT_QUOTES, "UTF-8");;    
}

foreach ($gameData as $gameRecord) {
    if ($gameRecord[0] == $gameID){
        $thisGame = $gameRecord;
    }
}

// ############################# Breadcrum Trail #############################//

if($thisGame[2]=='roleplay') {
    $genreClean = 'Role-Play';
} else{
    $genreClean = ucwords($thisGame[2]);
}


print('<nav class="breadcrumb"><p>
    <a href="index.php">Home</a> / 
    <a href="genre.php?genre='.$thisGame[2]. '">' . $genreClean .'</a> / 
    <a href="game.php?game=' . $thisGame[0]. '">' . $thisGame[1] .'</a>
    </p></nav>');




// ############################ Begin Game Article ########################## //

print '<article class="game">';

print PHP_EOL;
print PHP_EOL;

//to show row of data for this game for debugging

//print '<pre>';
//print_r($thisGame);
//print '</pre>';
//
//
//print PHP_EOL;
//print PHP_EOL;


$ratingColor = ratingGradient($thisGame[3]);

print '<h2>' . $thisGame[1] . '</h2>';

print PHP_EOL;
print PHP_EOL;

// ############################ Side Info Box ############################### //

print '<aside class="gameInfoContainer">';

print PHP_EOL;
print PHP_EOL;


// ########################### Rating Box ################################### //
print '<p class="ratingLabel">Rating:</p>';
print '<p class="rating" style="background-color:rgb(';
print $ratingColor[0] . ',' . $ratingColor[1] . ',' . $ratingColor[2];
print ')">' . $thisGame[3] . '</p><br>';

print PHP_EOL;
print PHP_EOL;

// ########################### Game Info #################################### //

// format date from dd/mm/yyyy to dd/mm/yy
$date = substr($thisGame[4], 0, -4) . substr($thisGame[4], -2);


print '
    <ul class="gameInfo">
        <li>
            <strong>Release Date</strong>: '.$date.' 
        </li>
        <li>
            <strong>Developer</strong>: '.$thisGame[5].'
        </li>
        <li>
            <strong>Publisher</strong>: '.$thisGame[6].'
        </li>
        <li>
            <strong>Platforms</strong>: '.$thisGame[7].'
        </li>
        <li>
            <strong>Age Rating</strong>: '.$thisGame[8].'
        </li>
        <li>
            <strong>Tags</strong>: '.$thisGame[9].'
        </li>
    </ul>';

print '</aside>';

print PHP_EOL;
print PHP_EOL;


// ############################ Cover Art ################################### //

$coverArtPath = getImagePathArray('images/cover-art/', $thisGame[0]);

//print html for showing that image
print '<figure class="coverArt"><img src="';
print $coverArtPath[0];
print '" alt=""></figure>';

print PHP_EOL;
print PHP_EOL;

// ############################ Summary ##################################### //

print '<p class="summary"><strong>Summary</strong>: ' . $thisGame[10] . '</p>';

print PHP_EOL;
print PHP_EOL;


// ############################ Screenshots ################################# //


//setup path to folder containing screenshots
$screenshotPaths = getImagePathArray('images/screenshots/', $thisGame[0]);

//create div to hold all images in the folder
print '<div id="screenshotContainer">';

//print images with sources from the array
foreach ($screenshotPaths as $screenshotPath) {
    print '<img class="screenshotSlides" src="';
    print $screenshotPath;
    print '" alt="">';
    print PHP_EOL;
}

//create div for buttons of slider
print '<div class="center display-bottom-middle" style="width:100%">';

//create left and right buttons for slider
print '<div class="left button" onclick="moveImg(-1)">&#10094;</div>';
print '<div class="right button" onclick="moveImg(1)">&#10095;</div>';

//for each image in slider add a bottom button
for ($i = 0; $i < count($screenshotPaths); $i++) {
    print '<div class="smallButton dot" onclick="setImg('; 
    if ($i == 0) {
        print '0'; //php didn't want to print a zero (printed nothing) so had to force it
    } else {
        print $i; //normally print game id
    }
    print ')"></div>';
             
}

print '</div>';

print '</div>';



print PHP_EOL;
print PHP_EOL;

// ############################ Game Trailer ################################ //

print '<figure class="video">';

print '<iframe width="640" height="352" src="https://youtube.com/embed/'.$thisGame[11].'" allowfullscreen></iframe>';

print '</figure>';

print PHP_EOL;
print PHP_EOL;

print '</article>';

// ######################### End Game Article ############################ //

print PHP_EOL;
print PHP_EOL;

include 'footer.php';


?>