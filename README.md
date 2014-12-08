clinic
========

Clinic is a school project written with the PHP CodeIgnitter framework.

You can find it online <a href="http://waldo2.dawsoncollege.qc.ca/1237628/clinic">here</a>

### Features
- **Login and logout**: passwords are safely hashed in the database.
- **Queuing**: 5 priorities queues ensure that patients are treated in an efficient and fair manner.
- **Modern design**: created with the modern web in mind, **clinic** makes use of framesworks like [BootStrap](https://www.getbootstrap.com) and [Chart.js](http://www.chartjs.org/).

## Extra features
- **Admin page**: useful statistics are displayed using doughnut charts and bar graphs.

## TODO
- ~~**Concurrency**: modify model to lock rows while processing transaction to prevent concurrency issues.~~
- ~~**Sanitize**: *striptags everything!* Must make sure input from user is sanitized, especially in the admin page.~~
- **Sticky forms**: a few of the forms that aren't sticky, need to be sticky.
- **Verify input**: phone numbers, etc could be validated.
