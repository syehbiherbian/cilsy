/**
 * plugin.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2015 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/*global tinymce:true */

tinymce.PluginManager.add('importcss', function(editor) {
	var self = this, each = tinymce.each;

	function removeCacheSuffix(url) {
		var cacheSuffix = tinymce.Env.cacheSuffix;

		if (typeof url == 'string') {
			url = url.replace('?' + cacheSuffix, '').replace('&' + cacheSuffix, '');
		}

		return url;
	}

	function isSkinContentCss(href) {
		var settings = editor.settings, skin = settings.skin !== false ? settings.skin || 'lightgray' : false;

		if (skin) {
			var skinUrl = settings.skin_url;

			if (skinUrl) {
				skinUrl = editor.documentBaseURI.toAbsolute(skinUrl);
			} else {
				skinUrl = tinymce.baseURL + '/skins/' + skin;
			}

			return href === skinUrl + '/content' + (editor.inline ? '.inline' : '') + '.min.css';
		}

		return false;
	}

	function compileFilter(filter) {
		if (typeof filter == "string") {
			return function(value) {
				return value.indexOf(filter) !== -1;
			};
		} else if (filter instanceof RegExp) {
			return function(value) {
				return filter.test(value);
			};
		}

		return filter;
	}

	function getSelectors(doc, fileFilter) {
		var selectors = [], contentCSSUrls = {};

		function append(styleSheet, imported) {
			var href = styleSheet.href, rules;

			href = removeCacheSuffix(href);

			if (!href || !fileFilter(href, imported) || isSkinContentCss(href)) {
				return;
			}

			each(styleSheet.imports, function(styleSheet) {
				append(styleSheet, true);
			});

			try {
				rules = styleSheet.cssRules || styleSheet.rules;
			} catch (e) {
				// Firefox fails on rules to remote domain for example:
				// @import url(//fonts.googleapis.com/css?family=Pathway+Gothic+One);
			}

			each(rules, function(cssRule) {
				if (cssRule.styleSheet) {
					append(cssRule.styleSheet, true);
				} else if (cssRule.selectorText) {
					each(cssRule.selectorText.split(','), function(selector) {
						selectors.push(tinymce.trim(selector));
					});
				}
			});
		}

		each(editor.contentCSS, function(url) {
			contentCSSUrls[url] = true;
		});

		if (!fileFilter) {
			fileFilter = function(href, imported) {
				return imported || contentCSSUrls[href];
			};
		}

		try {
			each(doc.styleSheets, function(styleSheet) {
				append(styleSheet);
			});
		} catch (e) {
			// Ignore
		}

		return selectors;
	}

	function convertSelectorToFormat(selectorText) {
		var format;

		// Parse simple element.class1, .class1
		var selector = /^(?:([a-z0-9\-_]+))?(\.[a-z0-9_\-\.]+)$/i.exec(selectorText);
		if (!selector) {
			return;
		}

		var elementName = selector[1];
		var classes = selector[2].substr(1).split('.').join(' ');
		var inlineSelectorElements = tinymce.makeMap('a,img');

		// element.class - Produce block formats
		if (selector[1]) {
			format = {
				title: selectorText
			};

			if (editor.schema.getTextBlockElements()[elementName]) {
				// Text block format ex: h1.class1
				format.block = elementName;
			} else if (editor.schema.getBlockElements()[elementName] || inlineSelectorElements[elementName.toLowerCase()]) {
				// Block elements such as table.class and special inline elements such as a.class or img.class
				format.selector = elementName;
			} else {
				// Inline format strong.class1
				format.inline = elementName;
			}
		} else if (selector[2]) {
			// .class - Produce inline span with classes
			format = {
				inline: 'span',
				title: selectorText.substr(1),
				classes: classes
			};
		}

		// Append to or override class attribute
		if (editor.settings.importcss_merge_classes !== false) {
			format.classes = classes;
		} else {
			format.attributes = {"class": classes};
		}

		return format;
	}

	editor.on('renderFormatsMenu', function(e) {
		var settings = editor.settings, selectors = {};