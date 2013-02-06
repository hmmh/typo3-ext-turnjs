==========
EXT: turnjs
==========

:Author:
	hmmh Team TYPO3

:Created:
	2013-01-13

:Email:
	typo3@hmmh.de


.. contents::


Extension Key:  **turnjs**

Copyright 2013, hmmh multimediahaus AG, <typo3@hmmh.de>

**Please report all bugs and feature request at https://github.com/hmmh/typo3-ext-turnjs/issues**

This document is published under the Open Content License available from http://www.opencontent.org/opl.shtml

The content of this document is related to TYPO3 a GNU/GPL CMS/Framework available from www.typo3.org


Introduction
------------

This extension implements the turnjs.com page flip effect in TYPO3-based websites.

Turn.js is a JavaScript library which will make your contents look like a real book or magazine.
To learn more about turn.js, go to `turnjs.com <http://www.turnjs.com>`_.

What does it do?
^^^^^^^^^^^^^^^^

The extension gets page contents via AJAX from `styles.content.get` and displays them in a flip book.
It is using hash.js to make your book pages accessible via hash urls like "#/page/1".
To include pages, select a custom set of pages or choose a subtree of pages from your page tree.


Configuration
-------------

Static template
^^^^^^^^^^^^^^^

Please include the shipped static template.

Include libraries
^^^^^^^^^^^^^^^^^

Please set the needed libraries in the constants settings.
You can choose if you want to include the following libraries:

- jQuery
- Turn.js
- Hash.js

Configurate options
^^^^^^^^^^^^^^^^^^^^^

All turn.js options described in the `official turn.js documenation <http://turnjs.com/docs/Turn_Options>`_
are configurable using the plugin. You can also set constants for default values to be used in all your turnjs
plugins on your TYPO3 site.


To-Do list & known problems
---------------------------

See https://github.com/hmmh/typo3-ext-turnjs/issues

Credits
---------

- Extension icon by http://famfamfam.com/lab/icons/mini/
- Turn.js library http://www.turnjs.com/
- Note that turn.js requires a `licence for commercial use <http://turnjs.com/get>`_.