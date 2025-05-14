const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.jsx', 'public/js')
   .react()
   .webpackConfig({
     resolve: {
       extensions: ['.js', '.jsx', '.json', '.wasm', '.mjs'],
       alias: {
         '@': path.resolve(__dirname, 'resources/js'),
       },
     },
   });

   mix.js('resources/js/components/OrganizationsPage.jsx', 'public/js/OrganizationsPage.js').react();


