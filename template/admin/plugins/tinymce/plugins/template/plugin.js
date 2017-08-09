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

tinymce.PluginManager.add('template', function(editor) {
	var each = tinymce.each;

	function createTemplateList(callback) {
		return function() {
			var templateList = editor.settings.templates;

			if (typeof templateList == "function") {
				templateList(callback);
				return;
			}

			if (typeof templateList == "string") {
				tinymce.util.XHR.send({
					url: templateList,
					success: function(text) {
						callback(tinymce.util.JSON.parse(text));
					}
				});
			} else {
				callback(templateList);
			}
		};
	}

	function showDialog(templateList) {
		var win, values = [], templateHtml;

		if (!templateList || templateList.length === 0) {
			var message = editor.translate('No templates defined.');
			editor.notificationManager.open({text: message, type: 'info'});
			return;
		}

		tinymce.each(templateList, function(template) {
			values.push({
				selected: !values.length,
				text: template.title,
				value: {
					url: template.url,
					content: template.content,
					description: template.description
				}
			});
		});

		function onSelectTemplate(e) {
			var value = e.control.value();

			function insertIframeHtml(html) {
				if (html.indexOf('<html>') == -1) {
					var contentCssLinks = '';

					tinymce.each(editor.contentCSS, function(url) {
						contentCssLinks += '<link type="text/css" rel="stylesheet" href="' + editor.documentBaseURI.toAbsolute(url) + '">';
					});

					var bodyClass = editor.settings.body_class || '';
					if (bodyClass.indexOf('=') != -1) {
						bodyClass = editor.getParam('body_class', '', 'hash');
						bodyClass = bodyClass[editor.id] || '';
					}

					html = (
						'<!DOCTYPE html>' +
						'<html>' +
							'<head>' +
								contentCssLinks +
							'</head>' +
							'<body class="' + bodyClass + '">' +
								html +
							'</body>' +
						'</html>'
					);
				}

				html = replaceTemplateValues(html, 'template_preview_replace_values');

				var doc = win.find('iframe')[0].getEl().contentWindow.document;
				doc.open();
				doc.write(html);
				doc.close();
			}

			if (value.url) {
				tinymce.util.XHR.send({
					url: value.url,
					success: function(html) {
						templateHtml = html;
						insertIframeHtml(templateHtml);
					}
				});
			} else {
				templateHtml = value.content;
				insertIframeHtml(templateHtml);
			}

			win.find('#description')[0].text(e.control.value().description);
		}

		win = editor.windowManager.open({
			title: 'Insert template',
			layout: 'flex',
			direction: 'column',
			align: 'stretch',
			padding: 15,
			spacing: 10,

			items: [
				{type: 'form', flex: 0, padding: 0, items: [
					{type: 'container', label: 'Templates', items: {
						type: 'listbox', label: 'Templates', name: 'template', values: values, onselect: onSelectTemplate
					}}
				]},
				{type: 'label', name: 'description', label: 'Description', text: '\u00a0'},
				{type: 'iframe', flex: 1, border: 1}
			],

			onsubmit: function() {
				insertTemplate(false, templateHtml);
			},

			width: editor.getParam('template_popup_width', 600),
			height: editor.getParam('template_popup_height', 500)
		});

		win.find('listbox')[0].fire('select');
	}

	function getDateTime(fmt, date) {
		var daysShort = "Sun Mon Tue Wed Thu Fri Sat Sun".split(' ');
		var daysLong = "Sunday Monday Tuesday Wednesday Thursday Friday Saturday Sunday".split(' ');
		var monthsShort = "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(' ');
		var monthsLong = "January February March April May June July August September October November December".split(' ');

		function addZeros(value, len) {
			value = "" + value;

			if (value.length < len) {
				for (var i = 0; i < (len - value.length); i++) {
					v