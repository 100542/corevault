## Corevault

Corevault is een trading platform die gebruik maakt van live API's om de prijs van verschillende cryptocurrencies te tracken.
Deze currencies kunnen worden gekocht & verkocht, maar ook kunnen deze worden verhandeld. 

## Hieronder een kleine handleiding over ReactTS & Laravel, zodat ik dat ook blijf onthouden.


## Stap 1: Laravel aanmaken

Als je nog geen werkend laravel project hebt opgestart kan je het volgende doen:

Composer create-project laravel/Laravel dit-moet-een-projectnaam-zijn

## Stap 2: Installeer dependencies

Laravel heeft vanaf versie 10 standaard Vite geinstalleerd. Dit kan je gebruiken voor de dependencies.

React & React-DOM
Npm install react react-dom

TypeScript 
Npm install –save-dev typescript @types/react @types/react-dom

Vite React plugin
Npm install –save-dev @vitejs/plugin-react

## Stap 3: TypeScript configuratie

Om typescript te kunnen gebruiken, moet er een tsconfig file gemaakt worden.

Maak het bestand tsconfig.json aan in de root van je project met de volgende waardes:
{
  "compilerOptions": {
    "target": "ESNext",
    "lib": ["DOM", "DOM.Iterable", "ESNext"],
    "allowJs": true,
    "skipLibCheck": true,
    "esModuleInterop": true,
    "allowSyntheticDefaultImports": true,
    "strict": true,
    "forceConsistentCasingInFileNames": true,
    "module": "ESNext",
    "moduleResolution": "Node",
    "resolveJsonModule": true,
    "isolatedModules": true,
    "jsx": "react-jsx"
  },
  "include": ["resources/ts"]
}

## Stap 4: Vite configuratie

Bewerk het bestand vite.config.js (root) zodat deze de react plugin laad. Deze moet ook sturen naar je hoofdbestand voor react.

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/ts/app.tsx'],
      refresh: true,
    }),
    react(),
  ],
});

Let dus op! De input: [] moet gelijk zijn aan je hoofdbestand (gewoonlijk App.tsx)

## Stap 5: React Startpunt

Maak nu een folder aan voor je code. Dit zal waarschijnlijk resources/ts worden. Zorg dat je hierin een entreebestand aanmaakt. Hier een voorbeeld van mijn App.tsx:

import React from "react";
import ReactDOM from "react-dom/client";

const App: React.FC = () => {
    return (
        <>
        </>
    );
};

const container = document.getElementById("app");
if (container) {
    ReactDOM.createRoot(container).render(<App />);
}



## Stap 6: Blade template

Je moet nog steeds blades gebruiken om React te kunnen tonen. 
Maak een view aan in resources/views met een naam die je wilt.

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>React TypeScript in Laravel</title>
  @viteReactRefresh
  @vite('resources/ts/app.tsx')

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
</head>
<body>
  <div id="app"></div>
</body>
</html>

## Stap 7: Definieer een route voor de React app

Voeg in routes/web.php een nieuwe route toe naar je view bestand (de blade, niet de tsx!)

Route::get('/', function () {
    return view('app');
});

## Opstarten server

Je hebt twee terminals nodig:

Terminal 1:
Php artisan serve

Terminal 2:
Npm run dev

Mogelijke errors!
Soms mis je nog een APP_KEY in je .env bestand. Run dan:

Php artisan key:generate

Het kan ook zijn dat je nog geen migrations hebt gedaan. Dan krijg je een database error. Run het volgende:

Php artisan migrate

## Bouwen voor productie

Als je klaar bent voor een deployment, run je het volgende:
Npm run build

