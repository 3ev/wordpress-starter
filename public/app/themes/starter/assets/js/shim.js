/*
 * Refer to https://github.com/thlorenz/browserify-shim#shimjs for the config
 * in this file.
 */



module.exports = {
    'jquery': {
        exports: 'global:jQuery'
    }

  , 'modernizr': {
        exports: 'global:Modernizr'
    }

  , 'tether': {
        exports: 'Tether'
    }
}
