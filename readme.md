# Nepse Scraper


An laravel based application for scraping various websites that provides the information regarding nepse (Nepal Stock Exchange) and its related news. An front end application using the data can be viewed here [STOCKNP.com](https://stocknp.com)

Installation
------------

Install the application, configure env files as usual and run

     php artisan migrate

Following commands with be available:

     php artisan scrape:brokers-list

Scrapes the list of brokers currently associated with nepse stock exchange

     php artisan scrape:company-list

Scrape the company list from nepse.

     php artisan scrape:dividend

Scrape the latest dividend issues from companies

     php artisan fetch:news

Fetch news from sharesansar of companie

     php artisan fetch:photos

Fetch photo urls from sharesansar of companies

     php artisan scrape:sharesansar-id

Scrape sharesansar ID to properly redirect to their website when required

     php artisan scrape:livestock

Scrape the current value of stock live or in trading. Schedule this command to run only from 11AM - 3PM

     php artisan scrape:todays-share-price

Scrape the current value of stock as of End of Day.

Please submit issue or pull request in case of new feature. It will be gladly accepted.

Contact me @ [LinkedIn](https://www.linkedin.com/in/suman-shresth)
