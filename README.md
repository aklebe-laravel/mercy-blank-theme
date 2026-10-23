## Mercy Blank Theme

A theme for the [Mercy Scaffold](https://github.com/aklebe-laravel/mercy-scaffold)
(based on [alizharb/laravel-themer](https://github.com/alizharb/laravel-themer)).

Default theme of the [Mercy Scaffold](https://github.com/aklebe-laravel/mercy-scaffold) and part of the Mercy core. Parent theme for project themes
like [central-ui](https://github.com/aklebe-laravel/central-ui-theme).

## Installation

Part of the Mercy core: the scaffold always installs it (`resources/setup/core.yaml`).
It is the theme by default (`kernel.theme: "mercy-blank"` in `setup.yaml`).

## Structure

| Path                      | Content                                      |
|---------------------------|----------------------------------------------|
| `theme.json`              | name, parent, screenshots, design tokens     |
| `resources/views`         | Blade views (layouts, auth, components, ...) |
| `resources/assets/css`    | Tailwind 4 entry (`app.css`)                 |
| `resources/assets/js`     | JavaScript entry (`app.js`)                  |
| `resources/assets/images` | images used by the views                     |

## Build

A theme has no own build. Its CSS and JS are part of the scaffold's Vite build: `deploy-env:build-mercy-assets` writes imports of the enabled modules and the current theme
(`storage/app/mercy-generated/`), the root `resources/js/app.js` imports them. In the **project root**:

```
# dev server with hot reload
sail npm run dev

# build
sail artisan deploy-env:build-mercy-assets
npm ci && npm run build
```

The production build (`php build.php create`) runs these steps itself.
Static files like images are published by laravel-themer to `public/themes/mercy-blank`.

## License

MIT, see [LICENSE.md](LICENSE.md).
