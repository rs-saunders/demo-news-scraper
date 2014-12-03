# Demo News Scraper

This project was a programming test. 

## Test Requirements
Using object­oriented PHP, build a console application that scrapes the [BBC news
homepage](http://www.bbc.co.uk/news/) and returns a JSON array of the most popular
shared articles table.

## Dependancies

* Symfony Cosole
* Symfony Dom Crawler
* Symfony CSS Selector
* PhpUnit

## Installation
Install dependancies via Composer.

`composer install`

## Usage

run the command:

`php app.php scrape:bbc`

view help:

`php app.php scrape:bbc --help`

specify a different url:

`php app.php scrape:bbc ./data/homepage.html`

example output:

```
{
    "results": [
        {
            "title": "1: Hawking: AI could end human race",
            "href": "http://www.bbc.co.uk/news/technology-30290540",
            "size": 3628,
            "most_used_word": "of"
        },
        {
            "title": "2: Richard III DNA: Infidelity surprise",
            "href": "http://www.bbc.co.uk/news/science-environment-30281333",
            "size": 6440,
            "most_used_word": "of"
        },
        {
            "title": "3: The art of a good Christmas card photo",
            "href": "http://www.bbc.co.uk/news/blogs-magazine-monitor-30289820",
            "size": 2890,
            "most_used_word": "to"
        },
        {
            "title": "4: Why Texas is closing prisons",
            "href": "http://www.bbc.co.uk/news/world-us-canada-30275026",
            "size": 5920,
            "most_used_word": "of"
        },
        {
            "title": "5: HIV evolving 'into milder form'",
            "href": "http://www.bbc.co.uk/news/health-30254697",
            "size": 4014,
            "most_used_word": "to"
        }
    ]
}
```

## Tests
Run phpunit tests with command below

`./vendor/bin/phpunit`