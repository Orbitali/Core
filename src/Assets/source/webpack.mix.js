const mix = require("laravel-mix");
Mix.extractingStyles = true;

mix
    .autoload({ jquery: ["$", "jQuery"] })
    .js("resources/assets/js/dashmix/app.js", "js/orbitali.core.js")
    .sass("resources/assets/sass/main.scss", "css/orbitali.css")
    .setResourceRoot("/vendor/orbitali/")
    .setPublicPath('public/vendor/orbitali/')
    //.copyDirectory("public/vendor/orbitali", "storage/orbitali/src/Assets/compiled")
    /* Tools */
    .browserSync("localhost")
    .disableNotifications()
    /* Options */
    .options({ assetModules: true })
    .extract()
    .version()
    .sourceMaps(false, "source-map")
;
