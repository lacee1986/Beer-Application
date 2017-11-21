<?php
/*
 * Beer Application
 * By: Laszlo Kruchio
 * Date: 17.11.2017
 */

require_once 'vendor/autoload.php';
use Controllers\Controller;
use Controllers\BeerController;
$controller = new Controller();
$beerController = new BeerController();

/** @var \Models\BeerModel $randomBeer */
$randomBeer = $beerController->randomBeer();

// Get a random beer - get another if there isn't any description.
for ($i = 1; $i < 5; $i++){
    if ( $randomBeer->getDescription() == null || $randomBeer->getIcon() == null ) {
        $randomBeer = $beerController->randomBeer();
    } else {
        break; // Prevent infinite loop!
    }
}

// Searh beers or breweries
if ( isset($_POST['search']) && isset($_POST['keyword']) && isset($_POST['type']) ) {
    if ( $controller->sanitizer($_POST['keyword']) ) {
        $searchResults = $beerController->searchBeer($_POST['keyword'], $_POST['type']);
        if ( empty($searchResults) || $searchResults === null ) {
            $errorText = 'Sorry, there isn\'t any result with this keyword';
        }
    } else {
        $errorText = 'Sorry, the keyword can only contain letters, numbers, hyphens and spaces.';
    }
}

// Get all beers from the same brewery
if ( isset($_POST['same-breweryId']) ) {
    if ( $controller->sanitizer($_POST['same-breweryId']) ) {
        $searchResults = $beerController->searchBeer($_POST['same-breweryId'], 'brewery', true);
        if ( empty($searchResults) || $searchResults === null ) {
            $errorText = 'Sorry, there isn\'t any result with this keyword';
        }
    } else {
        $errorText = 'Sorry, the keyword can only contain letters, numbers, hyphens and spaces.';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Beer Application</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<main role="main" class="container">

    <h1>Beer Application</h1>

    <!-- Random Beer -->
    <?php if ( isset($randomBeer) ) { ?>
        <div class="row" id="random-beer-container">
            <div class="col-12"><h5><?php echo $randomBeer->getName(); ?> (<?php echo $randomBeer->getBreweryName(); ?>)</h5></div>
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <img src="<?php echo $randomBeer->getIcon(); ?>" alt="<?php echo $randomBeer->getName(); ?>" />
                    </div>
                    <div class="col-7">
                        <p><?php echo $randomBeer->getDescription(); ?></p>
                    </div>
                    <div class="col-3">
                        <p><a class="btn btn-primary btn-block" href="." role="button">Another beer</a></p>
                        <p>
                            <form action="" method="post" name="form-same-brewery" id="form-same-brewery">
                                <input type="hidden" name="same-breweryId" value="<?php echo $randomBeer->getBreweryId(); ?>" >
                                <input type="hidden" name="same-breweryName" value="<?php echo $randomBeer->getBreweryName(); ?>" >
                                <button class="btn btn-primary btn-block" type="submit">More from this Brewery</button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Search Header -->
    <div class="row" id="search-header">
        <div class="col-12">
            <h2>Search</h2>
        </div>
        <div class="col-12">
            <form name="form-search" id="form-search" action="" method="post">
                <div class="row">
                    <div class="col-2 search_keyword">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search" required="" value="<?php if ( isset($_POST['keyword']) ) { echo $_POST['keyword']; } ?>">
                    </div>
                    <div class="col-7 search_type">
                        <label>
                            <input type="radio" value="beer" name="type" checked> Beer
                        </label>
                        <label>
                            <input type="radio" value="brewery" name="type" <?php if ( isset($_POST['type']) && $_POST['type'] == 'brewery' ) { echo 'checked'; } ?>> Brewery
                        </label>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary btn-block" type="submit" name="search">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Results -->
    <?php if ( isset($searchResults) && !empty($searchResults) ) { ?>
        <div class="row" id="search-results">
            <div class="col-12">
                <h2>Search Results <?php if( isset($_POST['same-breweryName']) ) { echo ' - Brewery: ' . $_POST['same-breweryName']; } ?></h2>
            </div>
            <div class="col-12">
                <?php foreach( $searchResults as $key => $searchResult ) { ?>
                    <div class="row beer-holder">
                        <div class="col-2">
                            <img src="<?php echo $searchResult->getIcon(); ?>" alt="<?php echo $searchResult->getName(); ?>" />
                        </div>
                        <div class="col-10">
                            <h3><?php echo $searchResult->getName(); ?> <?php if ( $searchResult->getBreweryName() !== null ) { ?>(<?php echo $searchResult->getBreweryName(); ?>) <?php } ?></h3>
                            <p><?php echo $searchResult->getDescription(); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <?php if ( isset($errorText) ) { ?>
            <h5><?php echo $errorText; ?></h5>
        <?php } ?>
    <?php } ?>

</main>

</body>
</html>