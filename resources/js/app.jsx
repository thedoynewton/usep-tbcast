import './bootstrap'; // Import any JavaScript dependencies or initialization scripts
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react'; // Import the Inertia app
import { createRoot } from 'react-dom/client'; // Import React's createRoot for rendering the app

// Initialize the Inertia application
createInertiaApp({
  // The 'resolve' function tells Inertia how to load the pages
  resolve: name => {
    // Import all pages eagerly using Vite's `import.meta.glob`
    const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
    return pages[`./Pages/${name}.jsx`];
  },
  // The 'setup' function is where we render the Inertia app into the DOM
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />); // Render the Inertia app using React's createRoot
  },
});
