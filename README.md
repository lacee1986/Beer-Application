## Useage
* Clone repository
* Run composer install

## Overview
This tasks requires you to create a simple PHP website that interacts with the BreweryDB API. This
page should allow you to:
* Display a random beer section, with a button/link to display other beers by the brewery associated
with that beer.
* Display a small search form where users can search for beers or breweries by free text search.
* Show search results from the BreweryDB API.

A sample page layout is below. It is at your discretion whether this is a one page application or
whether the Random Beer, Search Form and Search results are separated into individual pages.

## Getting Started
* The code should connect to the BreweryDB API, found at http://www.brewerydb.com
* The documentation may be found at at http://www.brewerydb.com/developers/docs
* You’ll need to setup a free account with them to get an API key. Please note that their free accounts
have a limit of 400 API requests per API key per day. You should take this into account when
developing your code.

## Requirements
### Random Beer Section
You should display a random beer to the user. It should show the beer name, description and image
(add any other info if you like):
* On initial load, show the user a random beer.
* Provide a button to display a new random beer.
* Only beers with both a label and a description should be displayed.
• Provide a button to display other beers by this brewery in the Search Results.
### Search Form
Take the following inputs from the user:
* A free text string to search for. This must only contain letters, numbers, hyphens and spaces.
All other characters should cause an error to be displayed.
* A radio button where users can select whether to search for breweries or for beers. One of these
options must be selected.
### Search Results
These results should be presented in a formatted list, containing the name of the beer, a small icon
and an abbreviated description of the beer. (add any other info if you like).
### Unit Tests
You should provide sample unit tests using PHPUnit, for example, tests of the search form input
validation.

## Other information
This test is completed at home, but should be returned within 7 days.
### Do:
* Include a readme file if there is setup required for your code to run, or if there is something you
would like to comment on.
* Keep your code tidy. Consider using a standard like PSR-2.
* Write Clean Code. This is an exercise in how you construct code, not solving a problem by the
shortest route possible.
* Consider the SOLID principles when you are constructing your code.
* Feel free to use a framework, but remember that we want you to show off your code, not the
framework.
* Take the opportunity to show off beyond the above requirements. This could include the use of
namespacing, autoloaders, composer packages, JavaScript libraries, caching strategies. If there is
something you would like to do but are constrained by time, outline it in the readme file.
### Don’t:
* Include automatically generated documentation files like phpDocumentor. We will be studying
your code.
* Give up. If you are trying something cool but don’t have time to finish it, include it and a description
in your comments/readme of what you were trying.
* Spend too much time on styling over PHP. We’re more interested in good clean code that shows
you as a developer rather than a designer.