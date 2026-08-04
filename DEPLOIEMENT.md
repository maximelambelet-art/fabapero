# Mettre le site en ligne chez Infomaniak

Procédure pour un hébergement **Web mutualisé** Infomaniak. Le site n'a besoin
que de PHP : **aucune base de données à créer**, sessions et cache sont en
fichiers.

---

## Ce qu'il faut avant de commencer

| Élément | Où l'obtenir |
|---|---|
| Accès SSH à l'hébergement | Manager Infomaniak → Hébergement → SSH |
| PHP 8.3 ou 8.4 sélectionné | Manager → Hébergement → paramètres du site |
| Boîte e-mail `hello@fabapero.ch` créée | Manager → Mail |
| Domaine `fabapero.ch` pointé sur l'hébergement | Manager → Domaines |

---

## 1. Récupérer le code sur le serveur

La clé SSH de la machine locale ne fonctionne pas depuis le serveur : générer
une clé **sur le serveur** et l'ajouter comme *deploy key* en lecture seule sur
le dépôt GitHub.

```
ssh-keygen -t ed25519 -C "infomaniak-fabapero"
cat ~/.ssh/id_ed25519.pub
```

Coller cette clé dans GitHub → dépôt `fabapero` → Settings → Deploy keys.

Puis, depuis le dossier du site :

```
cd sites/fabapero.ch
git clone git@github.com:maximelambelet-art/fabapero.git .
```

## 2. Installer les dépendances

Node n'est pas nécessaire : le CSS compilé est déjà dans le dépôt
(`public/build/`).

```
composer install --no-dev --optimize-autoloader
```

## 3. Créer le fichier `.env`

```
cp .env.example .env
php artisan key:generate
```

Puis éditer `.env` et régler au minimum :

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://fabapero.ch
```

⚠️ `APP_DEBUG=false` est impératif : à `true`, une erreur afficherait le contenu
de la configuration, mots de passe compris.

Renseigner ensuite le bloc SMTP décrit en commentaire dans `.env.example`
(le mot de passe de la boîte mail ne doit jamais être committé).

### Faire relire l'allemand et l'anglais sur le site en ligne

Les deux langues sont accessibles sur `/de/` et `/en/` mais restent invisibles :
`noindex`, absentes du sitemap et du sélecteur de langue. Pour les faire relire
directement sur le site, passer temporairement :

```
SHOW_DRAFT_LOCALES=true
```

Le sélecteur FR / DE / EN apparaît alors dans l'en-tête. **Remettre à `false`
après la relecture** : sans quoi un vrai prospect peut atterrir sur une
traduction non validée.

Une fois une langue validée, la déplacer de `draft_locales` vers
`active_locales` dans `config/site.php` : elle devient indexable, entre dans le
sitemap et apparaît définitivement dans le sélecteur.

## 4. Droits d'écriture

Deux dossiers seulement doivent être inscriptibles :

```
chmod -R 775 storage bootstrap/cache
```

## 5. Pointer le site sur `public/`

Dans le Manager Infomaniak → Hébergement → paramètres avancés du site,
changer le répertoire du site pour :

```
/sites/fabapero.ch/public
```

C'est l'étape qui protège l'application : sans elle, `.env` et tout le code
seraient accessibles depuis le web.

## 6. Optimiser pour la production

```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 7. Activer HTTPS

Manager → Hébergement → SSL → certificat Let's Encrypt (gratuit, automatique).
Le middleware `ForceHttps` redirige déjà tout le trafic HTTP vers HTTPS dès que
`APP_ENV=production`.

---

## Vérifications après mise en ligne

- [ ] `https://fabapero.ch` répond et redirige vers `/fr/`
- [ ] `https://fabapero.ch/.env` renvoie une erreur 403 ou 404 — **jamais** le contenu du fichier
- [ ] Le formulaire de contact envoie un vrai e-mail à `hello@fabapero.ch`
- [ ] `https://fabapero.ch/sitemap.xml` liste bien les pages
- [ ] Le favicon apparaît dans l'onglet
- [ ] Soumettre le sitemap à la Google Search Console

---

## Mettre à jour le site plus tard

```
cd sites/fabapero.ch
git pull
composer install --no-dev --optimize-autoloader
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

⚠️ Si la mise à jour touche au CSS, il faut avoir lancé `npm run build`
**en local avant de committer** : le serveur ne peut pas compiler.

---

## Ajouter une photo ou un article, sans toucher au code

**Photo** — déposer le fichier dans `public/img/site/` avec le nom exact indiqué
dans `photos-source/README.md`. Il apparaît immédiatement.

**Article de blog** — ajouter un fichier `.md` dans
`resources/content/blog/fr/`, en copiant l'en-tête d'un article existant.

Dans les deux cas, committer et pousser depuis la machine locale, puis faire un
`git pull` sur le serveur.
