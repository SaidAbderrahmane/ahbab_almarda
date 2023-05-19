const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    //flowbite integration
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],

  theme: {
    extend: {
      // fontFamily: {
      //     sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      // },
      colors: {
        primary:
        // {
        //   "50": "#f9fafb",
        //   "100": "#f3f4f6",
        //   "200": "#e5e7eb",
        //   "300": "#d1d5db",
        //   "400": "#9ca3af",
        //   "500": "#6b7280",
        //   "600": "#4b5563",
        //   "700": "#374151",
        //   "800": "#1f2937",
        //   "900": "#111827",
        //   "950": "#030712"
        // }
         { "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a" }
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
        'body': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
        'mono': ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace']
      },
      transitionProperty: {
        'width': 'width'
      },
      textDecoration: ['active'],
      minWidth: {
        'kanban': '28rem'
      },
    },
  },

  plugins: [require('@tailwindcss/forms'),
  require('flowbite/plugin')
  ],
};
