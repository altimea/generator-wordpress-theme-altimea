/* exported Analytics */
/* global dataLayer, jQuery */

var Analytics = (function($) {
	'use strict';

	var debug = false;

	/**
	 * Realiza la configuracion de los elementos a analizar
	 */
	var setup = function() {
		var $body = $('body'),
			$element,
			track;
	};

	/**
	 * Realiza el registro del evento mediante Google Tag Manager
	 * @param {string}  name     - Nombre del evento
	 * @param {string=} category - Categoria del evento
	 * @param {string=} action   - Accion del evento
	 * @param {string=} label    - Etiqueta del evento
	 */
	var trackEvent = function(name, category, action, label) {
		if (typeof category === 'undefined') {
			dataLayer.push({
				'event': name
			});
		} else {
			if (typeof action === 'undefined') {
				dataLayer.push({
					'event': name,
					'category': category
				});
			} else {
				if (typeof label === 'undefined') {
					dataLayer.push({
						'event': name,
						'category': category,
						'action': action
					});
				} else {
					dataLayer.push({
						'event': name,
						'category': category,
						'action': action,
						'label': label
					});

				}
			}
		}

		if (debug) {
			console.log(arguments);
		}
	};

	/**
	 * Realiza el registro con los datos asociados al evento
	 * @param {object} event - Evento
	 */
	var onClickTrack = function(event) {
		var name = event.data.name,
			category = event.data.category,
			action = event.data.action,
			label = event.data.label;

		trackEvent(name, category, action, label);
	};

	/**
	 * Realiza el registro de pagina virtual mediante Google Tag Manager
	 * @param {string} url - URL del evento
	 */
	var trackPageView = function(url) {
		// Comprobamos si ya existe una URL registrada
		var repeat = false,
			i,
			l;

		for (i = -1, l = dataLayer.length; ++i < l && repeat === false;) {
			if (dataLayer[i].category === url) {
				repeat = true;
			}
		}

		if (repeat === false) {
			dataLayer.push({
				'event': 'virtualPage',
				'category': url
			});

			if (debug) {
				console.log(arguments);
			}
		}
	};

	/**
	 * Configura la variable de debug
	 * @param {boolean} b - Valor a definir
	 */
	var setDebug = function(b) {
		debug = b;
	};

	// Metodos publicos

	return {
		setup: setup,
		trackEvent: trackEvent,
		trackPageView: trackPageView,
		onClickTrack: onClickTrack,
		setDebug: setDebug
	};


})(jQuery);
