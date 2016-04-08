# WHIZZYWIG CHANGE LOG #
## v63 - 27 June 2011 ##


### Bugs Fixed ###
  * InsHTML and dependent features, including insert image, insert link, insert table did not work in Internet Explorer 9 (IE9)

## v62 - 23 June 2011 ##
### New Features ###
  * how the cell borders on a borderless table in edit mode
  * Code tidied to give smaller footprint and better safety when compressing.
### Bugs Fixed ###
  * Clicking "Open link in new window" on Insert image deleted the selected text in some browsers (inc. Chrome)
  * InsHTML destroyed the current selection in some browsers (inc. Chrome)
  * Problems around linking from an image.


## v60 - 12 March 2010 ##
### New Features: ###
  * Fullscreen mode
  * Auto detect toolbar icons directory
  * Neater source code layout
  * new function: whizzywig(toolbar) will turn all textareas on page into whizzywigs
  * makeWhizzywig() can be called from anywhere: can dynamically create whizzywigs
  * works with whizzybrowse version 3
  * uses icons.png in same directory as whizzywig.js (instead of WhizzywigToolbar.png in document root)
### Bugs fixed: ###
  * Font and font size now available for Safari/Chrome
  * Trying to get table editing images not found (now part of toolbar icons png)
  * &LT; in initial textarea fix
  * layout adjacent images
  * add images without need to click edit area first

## v59 - 4 November 2009 ##
### New Features: ###
  * Works with new image and file browser
> > Whizzybrowse.php

## v58 - 3 November 2009 ##
### Bugs fixed: ###
  * Hilite not working in Firefox or Opera
### New Features: ###
  * Slightly smaller footprint (back to 25k)


## v57 - 16 October 2009 ##
### Bugs fixed: ###
  * Font controls don't work in Chrome/Safari (disabled)
  * Problems with IE 1-word attributes
  * Style attributes not aleays lower case
  * Issue if empty selection
  * '?' in url for links handled incorrectly
  * Had to select text before IE8 would set para style
  * hr and some other commands not working in IE8
### New Features: ###

> none


## v56 - 15 June 2009 ##
### Bugs fixed: ###
  * Whizzypic image browser now works again
### New Features: ###
  * Whizzywig now outputs xhtml by default: no need to use xhtml.js
  * The cleanup feature is simplified: no need to specify gentle/vicious
  * Added a button for full justify
  * Added a varible buttonExt, which allows buttons to be .png images
> > (but default is still .gif).

## v55b - 4 March 2007 ##
### Bugs fixed: ###
  * clicking color palette had no effect in Internet Explorer
### New Features: ###
  * The whizzywig does not need to be a textarea (textareas attract spambots)
> > Can be a DIV: whizzywig creates an INPUT type=HIDDEN to return the content
> > NAME= id of DIV

## v55 - 25 February 2007 ##
Tested in Opera 9, Firefox 2, IE 5.5, 6 and 7
### Bugs fixed: ###
  * iframe missing its border
  * linking did not work at first attempt with IE
  * could not remove link by blanking URL
### New Features: ###
  * **multiple whizzywigs on the same page**
  * reverted to using FONT tags for color (use xhtml.js to replace them with spans)
  * image attributes can now be edited
  * link URLs can now be edited
  * double clicking a link or image brings up edit form
  * removed support for Spellbound (current Firefox includes spellcheck)

## v54 - 27 September 2006 ##
### Bugs fixed: ###
  * popped dialogs did not always get focus
  * insHTML javascript actions
  * object bug in IE
  * empty tags retained if they had attributes
  * whereAmI() and insHTML() recoded to improve browser compatibility
  * IE messes up links within page (# anchors)
### New Features: ###
  * Fonts added: Trebuchet, Impact, Arial Black (reasonable cross-OS support)
  * Some  features now supported in Opera 9 (not insHTML)
  * HTML tag buttons added to HTML view
  * HTML tag buttons shown for browsers that do not support design mode
  * New Word paste button (IE only)
  * New "ask" option for gentleClean (default is "true") (Needs translation)
  * Clean removes xml from pasted in MS Word

## v53 - 1 June 2006 ##
### Bugs fixed: ###
  * Inserting an anchor with IE caused full path of editor to be added
  * Insert an image not always at cursor with IE
  * Custom buttons with a javascript action not working
  * Some versions of IE (.net) stumble on code to cleanUp long dash

### New Features: ###
  * Demo to show whizzywig editing multiple divs on the same page

## v52 - 14 April 2006 ##
### Bugs fixed: ###
  * Extraneous end tag for div at end of tableform
  * Toolbar buttons not titled (tool tips) in Firefox/Mozilla
  * Cannot remove a link (by blanking URL in link form)
  * DOM trail not displayed in status bar for Firefox/Mozilla

### New Features: ###
  * Cleanup now removes fixedheight on table elements
  * Table buttons now available for Mozilla/Firefox
  * Rendered source easier to read

## xhtml.js v2 - 2 April 2006 ##
  * Changed to MIT licence to match v51 of whizzywig.js
  * Some simplifications to code for smaller file size.

## v51 - 1 April 2006 ##
### Bugs fixed: ###
  * syncTextarea did not attach to onsubmit if the form was not the immediate parent of the textarea
> > this bug sometimes described as "Whizzywig does not save if it's in a table or div"
  * Fallback font for Courier incorrectly specified as 'mono' : corrected to 'monospace'
  * Enter key on forms submitted whole page - Enter key now does nothing
  * 404 errors if buttonPath == '' or 'textbuttons'
  * Width calc now uses 'ex' rather than 'em' - better in Firefox
  * simplified code to switch designmode on + oWhizzy renamed to oW
### New Features: ###
  * **Extendable**: Can now add your own button or selects to the toolbar.
> > Will insert HTML or execute javascript (which may be internal or external to whizzywig)
  * Switched to MIT licence (allows use of whizzywig in commercial projects)
  * Added buttons to insert 'http://' or 'mailto:' in link form
  * Setting color no longer inserts font tag
  * cleanUp() has a better go at removing XML inserted by Office applications
  * gentleClean switch: set gentleClean = false and spans, inline styles and classes
> > removed by cleanUp(). Default is true; i.e. they are retained (unless class=Mso...),
> > so not as vicious as v50
  * syncTextarea() now called whenever cleanUp() is executed

## v50 - 1 February 2006 ##
### Bugs fixed: ###
  * minor bugs on cleanup and insHTML.
### New Features: ###
  * cleanUp() removes spans, inline styles and classes as well as fonts and table widths
> > ie vicious with text pasted in from Office applications, but preserves bold, italics, bullets etc.
> > This will stomp over some formatting (e.g. text color) applied by whizzywig, so you can disable
> > with
> > gentleClean = true;
  * No longer forces a white background - picks up background from the cssFile
  * Highlight button enabled for Mozilla/FireFox
  * Now uses real buttons for tighter code
  * If a button image is missing, it will use (translated) text instead of reporting a broken image.
> > Note, this will generate harmless 404 errors in log files.
  * No longer necessary to have onsubmit="syncTextarea()", whizzywig will automatically attach the event.
> > Note, if you want process the textarea with your own onsubmit event, you must call syncTextarea() first.

## v49 - 23 December 2005 ##
### Bugs fixed: ###
  * In IE, Insert Image/Table sometimes inserts at the beginning of the page instead of at the cursor.
  * When using the xhtml option, view source does not convert to xhtml

## v48 - 13 December 2005 ##
### New Features: ###
  * Firefox/Mozilla only:
> > Ctrl+L opens Link dialog, Ctrl+M opens Image dialog
  * Bold command always inserts STRONG, Italic command always inserts EM
> > -this means IE users can unformat changes made by Firefox users and vice versa
> > -also B and I are deprecated tags
  * URL fields no longer pre-populated with 'http://' (confusing if inserting relative link)
  * 'Choose style' select has option 'Computer code' to insert CODE tag
  * cleanup() leaves spans and classes except 'mso...'
  * cleanup() substitutes long dash with '-'
  * Clicking the Cleanup button with text selected removes formatting from the selection
### Bugs fixed: ###
  * Cursor not visible in HTML view in Firefox/Mozilla
  * class="MsoNormal" not alway removed by cleanup();
  * IE displays a warning message if it encounters an iframe with no src attribute while using HTTPS
  * Mozilla Javascript console reports some CSS errors on whizzywig

## v47 - 12 October 2005 ##
### New Feature: ###
  * Clean up now takes width attributes out of tables and TD
> > (so tables pasted in from Word will have liquid layout)
> > Note: you can automatically invoke clean up on Submit with
> > form onsubmit="cleanUp(); syncTextarea();" ...
  * Cleanup has a go at removing MS xml in spans
> > (typically introduced if pasting in a Word document with an image)
  * Clean up of MS "smart quotes" reverts to replacing with " and '
> > because HTML entities cause problems with spell checking, don&#39;t they?

## v46 - 19 September 2005 ##
### New Feature: ###
  * Insert link now has option to open link in new window
  * Whizzywig version text now hidden in a '.'
  * Mozilla version no longer uses styled spans for bold and italic
  * interface for image and link browser published
### Bugs fixed: ###
  * Could not use an image as a link

## v45 - 24 May 2005 ##
### New Features: ###
  * Including html2xhtml.js in the HTML page that calls Whizzywig will produce xhtml
> > output rather than HTML4. [checks for get\_xhtml() function](Whizzywig.md).
  * Empty tags are removed from the generated code.
  * Toolbar selects are lined up more neatly.
  * Clicking the "Clean" button with text selected removes formatting from the selected text.
> > (As before, clicking Clean with no selection removes unwanted formatting on everything)
  * Clean now removes full justification (justify renders badly in some browsers).
  * Clean turns "smartquotes" inserted by MS Word etc. into correct HTML entities.
  * Insert image border and margin fields have tooltip - can now be
> > numbers (e.g. '0', '1')  or
> > CSS values (e.g. 'thin dashed #999999', '1px solid black')
### Bugs fixed: ###
  * Inserting an image or table in IE without first clicking in the edit area
> > incorrectly inserted the image or table at the top of the page.
  * Clearing a link did not work on Mozilla/Firefox.

## v44 - 05 May 2005 ##

> Bug fix - changing font size after CTRL+A in Firefox loses text
> +other peculiarities fixed related to the fontTags variable - now withdrawn
> Experimental - hook for xhtml conversion

## v43 - 04 May 2005 ##
### Bugs fixed: ###
  * sometimes get blank line after toolbar and before edit area
  * focus not always returned to edit area
  * formatting could introduce empty HTML tag if no text selected
  * toolbar sometimes wider than edit area
### New Features: ###
  * Translation of message text now supported, via externally defined language array.
  * Version number simpler, less visible.
  * IMG ALT text defaults to base part of filename (so '/images/diagram.gif' gives 'diagram')
  * Ensures user selects text before attempting link or color
  * Javascript trimmed to keep below 21k

## v42 First GNU GPL version ##