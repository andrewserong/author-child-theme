# Author - Hemingway Child Theme

## A child theme for the Hemingway Wordpress theme

This is a simple child theme for the excellent WordPress theme [Hemingway](https://en-au.wordpress.org/themes/hemingway/) by [Anders Noren](http://www.andersnoren.se/teman/hemingway-wordpress-theme/).

**Current status:** in development. This child theme was developed for the website for urban fantasy author [Anna McIlwraith](https://www.annamcilwraith.com), is under active development, and is likely to change without notice. Feel free to have a play and fork if you like it!

![Screenshot of Author - Hemingway Child Theme in use](https://raw.githubusercontent.com/andrewserong/author-hemingway-child-theme/master/screenshot.jpg)

## Objective

Hemingway is an elegant, beautiful theme for blogging, and seems like an ideal fit for authors. I wanted to add a couple more features to extend the theme to nicely display a collection of books for an author. The assumption is that each book would be created as its own page, with the book cover image set as the featured image for the page.

## Additional features of this child theme

1. A **book detail** template. This template uses the featured image attached to a page as a hero image for the page, displayed at the left on larger width screens, and full-width on smaller screens.
2. A **pages listing** template. This template displays a grid of tiles of the sub-pages of the current page. The tile uses the featured image of the child page as its image. Depends on flexbox support in the browser.

## Supported custom fields

The following custom fields can be added to a page, and will be rendered beneath the main page heading on the **book detail** template:

* series_title - the title of the series (if the book is a part of a series)
* series_permalink - a URL to link to the series title
* book_number - which number the book is, within the series

The theme also switches on the 'excerpt' feature for pages.

## Installation

1. First, download and install [Hemingway](https://en-au.wordpress.org/themes/hemingway/) for your WordPress site.
2. Copy this child theme to your `/wp-content/themes/` directory, and activate it within the WordPress admin.