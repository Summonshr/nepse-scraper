# Nepse Scraper
========

An laravel based application for scraping various websites that provides the information regarding nepse (Nepal Stock Exchange) and its related news. An front end application using the data can be viewed here [STOCKNP.com](https://stocknp.com)

Installation
------------

Install the application, configure env files as usual and run

     php artisan migrate

Following commands with be available:

     scrape:brokers-list

Scrapes the list of brokers currently associated with nepse stock exchange

     scrape:company-list

Scrape the company list from nepse.

     scrape:dividend

Scrape the latest dividend issues from companies

      fetch:news

Fetch news from sharesansar of companie

       fetch:photos

Fetch photo urls from sharesansar of companies

       scrape:sharesansar-id

Scrape sharesansar ID to properly redirect to their website when required

        scrape:livestock

Scrape the current value of stock live or in trading. Schedule this command to run only from 11AM - 3PM

        scrape:todays-share-price

Scrape the current value of stock as of End of Day.
