import forms from '@tailwindcss/forms';
/** @type {import('tailwindcss').Config} */
export default {
  presets: [
		 './vendor/robsontenorio/mary/src/View/Components/**/*.php'
	],
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/robsontenorio/mary/src/View/Components/**/*.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [
		forms,
		require('daisyui')
	],
}

