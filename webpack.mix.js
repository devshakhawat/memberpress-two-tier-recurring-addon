const mix   = require('laravel-mix');
const wpPot = require('wp-pot');

mix.options({
    autoprefixer: {
        remove: false
    },
    processCssUrls: false,
	terser: {
		terserOptions: {
			compress: false
		},
		extractComments: false
	}
});

mix.webpackConfig({
	target: 'web',
	externals: {
		jquery: "window.jQuery",
		$: "window.jQuery",
		wp: 'window.wp',
		React: 'window.React',
		GSTM_DATA: 'window.GSTM_DATA'
	},
	watchOptions: {
		ignored: /node_modules/
	}
});

// Disable notification on dev mode
if ( process.env.NODE_ENV.trim() !== 'production' ) {
	mix.disableNotifications();
}


// Form Builder JS
mix.scripts('./dev/public/js/public.js', './assets/public/js/public.min.js');
mix.scripts('./dev/admin/js/admin.js', './assets/admin/js/admin.min.js');

// Form Builder SCSS
mix.sass('./dev/public/css/public.scss', './assets/public/css/public.min.css');
mix.sass('./dev/admin/css/admin.scss', './assets/admin/css/admin.min.css');

// Freemius
if ( process.env.NODE_ENV.trim() === 'production' ) {

	// Language pot file generator
	wpPot({
		destFile: 'languages/sktplugin.pot',
		domain: 'sktplugin',
		package: 'Skt_Memberpress',
		src: ['**/*.php', '!freemius/**/*.php']
	});

}