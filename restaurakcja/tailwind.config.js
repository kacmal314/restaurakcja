import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
		
		safelist: [
			
			{
				
				// always include these classes
				// default: only including explicitly typed classes
				// problem: dynamic PHP generated css class names
				
				pattern: /^bg-(orange|green)-(50|100|200|300|400|500|600|700|800|900)$/,
				
			},
			
		],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
