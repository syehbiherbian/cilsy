/*
waitMe - 1.15 [15.02.16]
Author: vadimsva
Github: https://github.com/vadimsva/waitMe
*/
(function($) {
  $.fn.waitMe = function(method) {
    return this.each(function() {

      var elem = $(this),
			elemClass = 'waitMe',
			waitMe_text,
			effectObj,
			effectElemCount,
			createSubElem = false,
			specificAttr = 'background-color',
			addStyle = '',
			effectElemHTML = '',
			waitMeObj,
			_options,
			currentID;

      var methods = {
        init : function() {
          var _defaults = {
            effect: 'bounce',
            text: '',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
						maxSize: '',
            source: '',
						onClose: function() {}
          };
          _options = $.extend(_defaults, method);

          currentID = new Date().getMilliseconds();
          waitMeObj = $('<div class="' + elemClass + '" data-waitme_id="' + currentID + '"></div>');

          switch (_options.effect) {
            case 'none':
              effectElemCount = 0;
              break;
            case 'bounce':
              effectElemCount = 3;
              break;
            case 'rotateplane':
              effectElemCount = 1;
              break;
            case 'stretch':
              effectElemCount = 5;
              break;
            case 'orbit':
              effectElemCount = 2;
              break;
            case 'roundBounce':
              effectElemCount = 12;
              break;
            case 'win8':
              effectElemCount = 5;
              createSubElem = true;
              break;
            case 'win8_linear':
              effectElemCount = 5;
              createSubElem = true;
              break;
            case 'ios':
              effectElemCount = 12;
              break;
            case 'facebook':
              effectElemCount = 3;
              break;
            case 'rotation':
              effectElemCount = 1;
              specificAttr = 'border-color';
              break;
            case 'timer':
              effectElemCount = 2;
							if ($.isArray(_options.color)) {
								var color = _options.color[0];
							} else {
								var color = _options.color;
							}
              addStyle = 'border-color:' + color;
              break;
            case 'pulse':
              effectElemCount = 1;
              specificAttr = 'border-color';
              break;
            case 'progressBar':
              effectElemCount = 1;
              break;
            case 'bouncePulse':
              effectElemCount = 3;
              break;
            case 'img':
              effectElemCount = 1;
              break;
          }

          if (addStyle !== '') {
            addStyle += ';';
          }
					
          if (effectElemCount > 0) {
            if(_options.effect === 'img') {
							effectElemHTML = '<img src="' + _options.source + '">';
            } else {
              for (var i = 1; i <= effectElemCount; ++i) {
								if ($.isArray(_options.color)) {
									var color = _options.color[i];
									if (color == undefined) {
										color = '#000';
									}
								} else {
									var color = _options.color;
								}
                if (createSubElem) {
                  effectElemHTML += '<div class="' + elemClass + '_progress_elem' + i + '"><div style="' + specificAttr +':' + color + '"></div></div>';
                } else {
                  effectElemHTML += '<div class="' + elemClass + '_progress_elem' + i + '" style="' + specificAttr + ':' + color + '"></div>';
                }
              }
            }
            effectObj = $('<div class="' + elemClass + '_progress ' + _options.effect + '" style="' + addStyle + '">' + effectElemHTML + '</div>');
          }

          if (_options.text && _options.maxSize === '') {
						if ($.isArray(_options.color)) {
							var color = _options.color[0];
						} else {
							var color = _options.color;
						}
            waitMe_te