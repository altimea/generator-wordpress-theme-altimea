/* exported Analytics */
/* global dataLayer, jQuery */

var Analytics = ( function( $ ) {
    'use strict';

    /**
     * Realiza el registro del evento mediante Google Tag Manager
     * @param {string}  name     - Nombre del evento
     * @param {string=} category - Categoria del evento
     * @param {string=} action   - Accion del evento
     * @param {string=} label    - Etiqueta del evento
     */
    var trackEvent = function( name, category, action, label ) {
        if ( 'undefined' === typeof category ) {
            dataLayer.push({
                'event': name
            });
        } else {
            if ( 'undefined' === typeof action ) {
                dataLayer.push({
                    'event': name,
                    'category': category
                });
            } else {
                if ( 'undefined' === typeof label ) {
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
    };

    /**
     * Realiza el registro con los datos asociados al evento
     * @param {object} event - Evento
     */
    var onClickTrack = function( event ) {
        var name = event.data.name,
            category = event.data.category,
            action = event.data.action,
            label = event.data.label;

        trackEvent( name, category, action, label );
    };

    /**
     * Realiza el registro de pagina virtual mediante Google Tag Manager
     * @param {string} url - URL del evento
     */
    var trackPageView = function( url ) {

        // Comprobamos si ya existe una URL registrada
        var repeat = false,
            i,
            l;

        for ( i = -1, l = dataLayer.length; ++i < l && false === repeat; ) {
            if ( dataLayer[i].category === url ) {
                repeat = true;
            }
        }

        if ( false === repeat ) {
            dataLayer.push({
                'event': 'virtualPage',
                'category': url
            });
        }
    };

    /**
     * Realizamos el registro de evento vinculado a la tienda electronica
     * @param {object} product - Meta informacion del producto
     */
    var trackEcommerceImpression = function( product ) {
        dataLayer.push({
            'event': 'productImpression',
            'ecommerce': {
                'currencyCode': product.currency,
                'impressions': [ {
                    'name': product.name,
                    'id': product.id,
                    'price': product.price,
                    'brand': 'LBEL',
                    'category': product.category,
                    'list': product.list,
                    'position': product.position
                } ]
            }
        });
    };

    /**
     * Realizamos el registro de evento vinculado a la tienda electronica
     * @param {object} product - Meta informacion del producto
     */
    var trackEcommerceClick = function( product ) {
        var list = product.category;

        if ( '' !== product.list ) {
            list = product.list;
        }
        dataLayer.push({
            'event': 'productClick',
            'ecommerce': {
                'currencyCode': product.currency,
                'click': {
                    'actionField': {
                        'list': list
                    },
                    'products': [
                        {
                            'name': product.name,
                            'id': product.id,
                            'price': product.price,
                            'brand': 'LBEL',
                            'category': product.category,
                            'position': product.position
                        }
                    ]
                }
            }
        });
    };

    /**
     * Realizamos el registro de evento productImpression
     * @param {object} product - Meta informacion del producto
     * @param currency
     */
    var productImpression = function( product, currency ) {
        dataLayer.push({
            'event': 'productImpression',
            'ecommerce': {
                'currencyCode': currency,
                'impressions': product
            }
        });
    };

    /**
     * Realizamos el registro de evento productClick
     * @param {object} product - Meta informacion del producto
     * @param currency
     */
    var productClick = function( product, currency ) {
        dataLayer.push({
            'event': 'productClick',
            'ecommerce': {
                'currencyCode': currency,
                'click': product
            }
        });
    };

    /**
     * Realizamos el registro de evento virtualEvent
     * @param {object} eventInfo - Meta informacion del producto
     */
    var virtualEvent = function( eventInfo ) {
        dataLayer.push({
            'event': 'virtualEvent',
            'category': eventInfo.category,
            'action': eventInfo.action,
            'label': eventInfo.label
        });
    };

    /**
     * Realizamos el registro de evento virtualPage
     * @param {object} eventInfo - Meta informacion del producto
     */
    var virtualPage = function( eventInfo ) {
        dataLayer.push({
            'event': 'virtualPage',
            'pageUrl': eventInfo.url,
            'pageName': eventInfo.name
        });
    };


    // Metodos publicos
    return {
        trackEvent: trackEvent,
        trackPageView: trackPageView,
        onClickTrack: onClickTrack,
        trackEcommerceImpression: trackEcommerceImpression,
        trackEcommerceClick: trackEcommerceClick,
        productImpression: productImpression,
        productClick: productClick,
        virtualEvent: virtualEvent,
        virtualPage: virtualPage,
    };

}( jQuery ) );
