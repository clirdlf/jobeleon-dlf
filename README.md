# Jobeleon Child Theme

This is a Wordpress child theme for the WPJobBoards plugin. You will
need to make sure you have downloaded the latest version of the theme
(`1.3.1` at the time of this development) and placed in your `themes`
directory.

## Upgrade Bootstrap

In order to decrease render-blocking for the entire Bootstrap library,
a customized version of the used Bootrap library is used and compiled
using SASS (see https://getbootstrap.com/docs/5.0/customize/sass/).

### Updating

```
npm update
```

Then you can run either the `gulp watch` or `gulp style` tasks to
recompile the SASS file into `stylesheets/main.css`. The only required
modules are `containers` and `grid`.

## Development Setup

I'm assuming you're using [MAMP](https://www.mamp.info). If you're doing
something else, you'll need to update the `dev_url` in `gulpfile.js` to
whatever your connection is (and probably `port` too).

You need both the `Jobeleon` theme and the `wpjobboard` plugin downloaded
on your local machine. Once this is set up and activated, link in this
code:

```
$ cd /Applications/MAMP/htdocs/wordpress/wp-content/themes
$ ln -s ~/projects/projects/jobeleon-dlf
```

Then activate the theme in the Wordpress admin panel.


Install the `node` dependencies:

```
$ cd ~/projects/jobeleon-dlf
$ npm install
```

Open the project in your favorite editor, then start the `gulp` proxy to
compile SCSS and do browser refreshes on saves.

```
$ cd ~/projects/jobeleon-dlf
$ gulp
```

![winning](http://www.reactiongifs.com/wp-content/uploads/2013/09/rock.gif)
