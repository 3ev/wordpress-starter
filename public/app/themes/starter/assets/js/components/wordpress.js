/* globals themeAjax */
/*
 * Provides access to the Wordpress ajax URL.
 *
 * Usage:
 *
 *     var $ = require('jquery')
 *       , wp = require('components/wordpress')
 *
 *     $.ajax({ url: wp.ajaxUrl })
 */



module.exports = {
    ajaxUrl: themeAjax.ajaxurl
}
