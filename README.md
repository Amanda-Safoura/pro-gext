# Gestionnaire de Projets et Tâches

Une application web simple permettant de gérer des projets, leurs tâches associées, ainsi que les notifications utilisateurs. L'application permet également la gestion des rôles (administrateur ou utilisateur simple) et inclut un tableau de bord pour les statistiques.

## Fonctionnalités

-   **Gestion des utilisateurs** :
    -   Création et authentification des utilisateurs.
    -   Vérification d'email après l'inscription.
    -   Réinitialisation du mot de passe via email.
    -   Attribution de rôles (administrateur ou utilisateur simple).
-   **Gestion des projets** :
    -   Ajout, modification et suppression de projets.
    -   Suivi des projets terminés et en cours.
-   **Gestion des tâches** :
    -   Association des tâches à des projets spécifiques.
    -   Priorisation des tâches (basse, moyenne, haute).
    -   Suivi de l'état des tâches (non démarrée, en cours, terminée).
-   **Notifications personnalisées** :
    -   Notifications pour les utilisateurs concernant les projets et les tâches.
    -   Marquage des notifications comme lues ou non lues.
-   **Tableau de bord** :
    -   Statistiques sur le nombre de projets, de tâches et d'utilisateurs.
    -   Visualisation des tâches par priorité.

---

## Prérequis

Pour exécuter ce projet correctement, assurez-vous d'avoir :

-   **Environnement de développement** :

    -   PHP 8.1 ou supérieur
    -   Composer
    -   Node.js et npm
    -   MySQL

-   **Serveur d'email** :  
    Comme l'application inclut des fonctionnalités liées à l'email (vérification d'email et réinitialisation de mot de passe), un serveur d'email est nécessaire. En développement, vous pouvez utiliser des outils comme **MailHog** ou **Mailtrap** pour capturer les emails de test. En production, configurez un fournisseur d'email comme SMTP, Mailgun ou Amazon SES.

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-utilisateur/votre-repo.git
cd votre-repo
```

### 2. Installer les dépendances

Installez les dépendances PHP et Node.js :

```bash
composer install
npm install && npm run dev
```

### 3. Configurer l'environnement

Copiez le fichier `.env.example` en `.env` et configurez vos variables d'environnement :

```bash
cp .env.example .env
```

-   **Base de données** : Configurez `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD`.
-   **Email** : Configurez vos variables d'email (MAIL_HOST, MAIL_PORT, etc.) pour le développement avec MailHog ou pour la production avec un service réel.
-   **Clé d'application** : Générez une clé d'application Laravel :

```bash
php artisan key:generate
```

### 4. Migrer et seed la base de données

Exécutez les migrations et insérez les données de test avec les seeders :

```bash
php artisan migrate --seed
```

### 5. Démarrer le serveur

Lancez le serveur de développement :

```bash
php artisan serve
```

L'application sera accessible sur http://localhost:8000.

---

## Utilisateurs par défaut

Deux utilisateurs sont générés avec les seeders :

-   **Administrateur** :

    -   **Email** : `admin@example.com`
    -   **Mot de passe** : `password`

-   **Utilisateur régulier** :
    -   **Email** : `user@example.com`
    -   **Mot de passe** : `password`

---

## Serveur de développement

Pour tester les emails en environnement local, vous pouvez utiliser **MailHog**. Voici les étapes pour le configurer :

### 1. Installez MailHog

Vous pouvez suivre la documentation officielle pour l'installation de MailHog :  
[Documentation MailHog](https://github.com/mailhog/MailHog)

### 2. Configurez votre fichier `.env`

Ouvrez votre fichier `.env` et modifiez les variables suivantes pour configurer MailHog :

```env
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

### 3. Lancez MailHog

Dans votre terminal, exécutez la commande suivante pour démarrer MailHog :

```bash
mailhog
```

### 4. Accédez à l'interface de MailHog

Une fois que MailHog est en cours d'exécution, ouvrez votre navigateur et allez sur http://localhost:8025 pour accéder à l'interface de gestion des emails capturés.

## Serveur de production

Configurez un fournisseur d'email réel comme Mailgun, SendGrid, ou Amazon SES dans votre fichier `.env`. Par exemple, pour Mailgun :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=votre-utilisateur
MAIL_PASSWORD=votre-mot-de-passe
MAIL_ENCRYPTION=tls
```

---

## Structure des tables

### **Users**

| Colonne      | Type      | Description                          |
| ------------ | --------- | ------------------------------------ |
| `id`         | BIGINT    | Identifiant unique                   |
| `name`       | STRING    | Nom de l'utilisateur                 |
| `email`      | STRING    | Email de l'utilisateur (unique)      |
| `password`   | STRING    | Mot de passe hashé                   |
| `is_admin`   | BOOLEAN   | Rôle de l'utilisateur (admin ou non) |
| `created_at` | TIMESTAMP | Date de création                     |
| `updated_at` | TIMESTAMP | Date de mise à jour                  |

### **Projects**

| Colonne       | Type    | Description                         |
| ------------- | ------- | ----------------------------------- |
| `id`          | BIGINT  | Identifiant unique                  |
| `title`       | STRING  | Titre du projet                     |
| `description` | TEXT    | Description du projet               |
| `deadline`    | DATE    | Date limite du projet               |
| `user_id`     | BIGINT  | Créateur du projet (référence User) |
| `finished`    | BOOLEAN | Statut de finalisation              |

### **Tasks**

| Colonne       | Type   | Description                             |
| ------------- | ------ | --------------------------------------- |
| `id`          | BIGINT | Identifiant unique                      |
| `title`       | STRING | Titre de la tâche                       |
| `description` | TEXT   | Description de la tâche                 |
| `status`      | STRING | Statut (not started, in running, ended) |
| `priority`    | STRING | Priorité (low, medium, high)            |
| `assigned_to` | BIGINT | Utilisateur assigné (référence User)    |
| `project_id`  | BIGINT | Projet associé (référence Project)      |

### **CustomNotifs**

| Colonne   | Type    | Description                  |
| --------- | ------- | ---------------------------- |
| `id`      | BIGINT  | Identifiant unique           |
| `content` | STRING  | Contenu de la notification   |
| `user_id` | BIGINT  | Récepteur de la notification |
| `read`    | BOOLEAN | Statut de lecture            |

---

## Auteurs

-   **Amanda Safoura**
-   Contact : [amandasafoura56@gmail.com](mailto:amandasafoura56@gmail.com)

## Licence

Ce projet est sous licence MIT. Vous êtes libre de le modifier et de le distribuer à votre guise.
