# Projet Test Technique - Gestion RH Laravel

Application Full Stack Laravel simple pour la gestion des employés et des offres d'emploi.

## Prérequis

*   PHP >= 8.1
*   Composer
*   Node.js & npm
*   Serveur de base de données (MySQL recommandé)

## Installation

1.  **Cloner le dépôt :**
    ```bash
    git clone <votre-url-git> hr-management-app
    cd hr-management-app
    ```
    *(Ou dézippez l'archive si fournie)*

2.  **Installer les dépendances PHP :**
    ```bash
    composer install
    ```

3.  **Configurer l'environnement :**
    *   Copiez le fichier d'environnement exemple :
        ```bash
        cp .env.example .env
        ```
    *   Générez la clé d'application :
        ```bash
        php artisan key:generate
        ```
    *   Modifiez le fichier `.env` pour configurer votre connexion à la base de données (lignes `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.). Assurez-vous que la base de données existe.

4.  **Exécuter les migrations :**
    ```bash
    php artisan migrate
    ```
    *(Optionnel : Pour ajouter des données de test, vous pouvez créer et exécuter des seeders : `php artisan db:seed`)*

5.  **Installer les dépendances JavaScript :**
    ```bash
    npm install
    ```

6.  **Compiler les assets (CSS/JS) :**
    *   Pour le développement (avec rechargement à chaud) :
        ```bash
        npm run dev
        ```
    *   Pour la production :
        ```bash
        npm run build
        ```

7.  **Lancer le serveur de développement :**
    ```bash
    php artisan serve
    ```

8.  **Accéder à l'application :**
    Ouvrez votre navigateur et allez à l'adresse indiquée par la commande `php artisan serve` (généralement `http://127.0.0.1:8000`).

## Choix Techniques

*   **Framework:** Laravel (PHP) - Écosystème robuste, développement rapide, bonnes pratiques intégrées (MVC, Eloquent ORM, Blade, Vite). Idéal pour une application Full Stack.
*   **Frontend:** Blade (moteur de template de Laravel) + Tailwind CSS - Simple et efficace pour créer des interfaces rapidement sans écrire beaucoup de CSS custom. Vite pour la compilation des assets.
*   **Base de données:** MySQL (via Eloquent ORM) - Standard relationnel, bien supporté par Laravel. Les migrations facilitent la gestion du schéma.
*   **Architecture:** Modèle-Vue-Contrôleur (MVC) standard de Laravel. Utilisation de contrôleurs ressources pour le CRUD, de modèles Eloquent pour l'interaction BDD, et de vues Blade pour la présentation.
*   **Validation:** Gérée directement dans les contrôleurs pour ce test (pour la simplicité et rapidité). Dans un projet plus conséquent, l'utilisation de Form Requests serait préférable pour séparer la logique de validation.
*   **Relations:** Utilisation des relations Eloquent (`hasMany`, `belongsTo`) pour lier les offres d'emploi aux employés recruteurs.