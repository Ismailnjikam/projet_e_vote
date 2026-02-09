# Déploiement sur Railway

## Configuration pour Railway

Ce projet est configuré pour être déployé sur Railway avec Docker.

### Fichiers de configuration créés:

1. **Dockerfile** - Image Docker multi-stage optimisée
   - Build stage: Installe les dépendances Composer
   - Production stage: Apache + PHP 8.2 avec extensions nécessaires

2. **Procfile** - Configuration pour le démarrage (alternatif)
   - Lance `php artisan serve` si le Dockerfile n'est pas utilisé

3. **railway.json** - Configuration Railway
   - Utilise le builder Nixpacks (détection automatique)

4. **.dockerignore** - Fichiers ignorés lors du build Docker

5. **.env.example** - Variables d'environnement mises à jour
   - APP_ENV=production
   - APP_DEBUG=false
   - LOG_LEVEL=info

## Étapes de déploiement

### 1. Installer Railway CLI
```bash
npm install -g @railway/cli
```

### 2. Se connecter à Railway
```bash
railway login
```

### 3. Initialiser le projet (si premier déploiement)
```bash
railway init
```

### 4. Configurer les variables d'environnement
Sur le dashboard Railway:
- Ajouter `APP_KEY` (générer avec `php artisan key:generate`)
- Ajouter `APP_URL` (votre URL Railway)
- Configurer la base de données si nécessaire

### 5. Déployer
```bash
railway up
```

### 6. Migrations de base de données (première fois)
Dans le dashboard Railway, exécuter:
```bash
php artisan migrate --force
```

## Variables d'environnement essentielles

- `APP_KEY` - Clé d'application (générer avec `php artisan key:generate`)
- `APP_URL` - URL de l'application (ex: https://mon-app.railway.app)
- `DB_CONNECTION` - Type de base de données (sqlite par défaut)
- `SESSION_DRIVER` - Storage de sessions (database)

## Troubleshooting

### Erreur: vendor/bin/heroku-php-apache2 not found
✅ Corrigé - Le Procfile utilise maintenant la commande correcte

### Erreur: Permission denied
- Les permissions de storage et bootstrap/cache sont configurées dans le Dockerfile

### Erreur: Database not found
- Les migrations sont exécutées automatiquement
- Vérifier que APP_ENV=production

## Notes importantes

- Le Dockerfile utilise un build multi-stage pour minimiser la taille de l'image
- Les migrations s'exécutent lors du build si DB_CONNECTION=sqlite
- Les logs Apache et PHP sont visibles dans Railway Dashboard
- Les assets CSS/JS doivent être compilés avant le push

## Compilation des assets

Avant de pusher sur Git/Railway:
```bash
npm install
npm run build
```

Les fichiers compilés dans `public/build/` seront inclus dans l'image Docker.
