# WP-Theme

#### Wordpress starter theme with FSE, Block theme, TailwindCSS and Vite

### Installation

```bash
git clone https://github.com/webpup/wp-theme.git
# Rename env.example to .env
# Do setup .env according to your environments
```

### HRM - Livereload setup

```bash
# wp-config.php add the following

# /* That's all, stop editing! Happy publishing. */
define('WP_ENV', 'development');
```

### Add Custom Fonts

```css
/* style.css */
@font-face {
  font-family: "Manrope";
  src: url("./assets/fonts/manrope/Manrope-VariableFont_wght.woff2") format("woff2"),
    format("woff2");
}

/* howto use it in tailwindcss */
@theme {
  --font-manrope-regular: "Manrope", serif;
}

h1 {
  @apply text-6xl text-green-500 font-manrope-regular leading-none;
}
```

## Docs

[webpup.github.io/wp-theme](https://webpup.github.io/wp-theme)
