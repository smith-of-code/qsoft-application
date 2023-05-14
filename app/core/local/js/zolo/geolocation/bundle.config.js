module.exports = {
	input: './src/application.js',
	output: './dist/geolocation.bundle.js',
	namespace: 'BX',
};

// const vuePlugin = require('rollup-plugin-vue');
// const commonjs = require('rollup-plugin-commonjs');
//
// module.exports = {
// 	input: './src/application.js',
// 	output: './dist/geolocation.bundle.js',
// 	namespace: 'BX',
// 	plugins: {
// 		custom: [
// 			vuePlugin(), commonjs()
// 		],
// 	},
// };