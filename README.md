- 👋 Hello, I’m @CogitiumAcademy
- 👀 I’m interested in WebDev
- 🌱 I’m currently teaching Symfony 5.4
- 💞️ I’m looking to collaborate with you
- 📫 How to reach me : www.cogitium.com

Pour lancer ce projet :
- Dans une première console, faire le clone
- Installer les bundles :
    > composer install
- Suite à l'installation de CKEditor : 
    > composer update
- Vérifier le .env pour 
    - Les paramètres de connexion à la BD
    - Les paramètres SMTP :
        - Pour SMTP local style Maildev ou Mailhog :
            > MAILER_DSN=smtp://localhost:1025
            - Puis lancer le service dans une console séparée
            - Et un onglet sur la boite de réception
        - Pour SMTP cloud style Mailtrap :
        (dans .env.local pour ne pas avoir les credentials sur GitHub...)
            > MAILER_DSN=smtp://login:password@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login
            - Puis ouvrir un onglet sur la boite de réception du service
- Créer la BD : 
    > php bin/console doctrine:database:create
- Exécuter les migrations :
    > php bin/console doctrine:migrations:migrate
- Dans une autre console, lancer le serveur web :
    > symfony server:start

=====================
Ajout du 09/05/2022 :
=====================
Suite à un composer update et au passage en 5.4.8, une erreur s'affiche sur les pages qui ont besoin de data.
Il faut changer la version de doctrine/persistence :
    > composer req doctrine/persistence:^2.4

Puis une erreur se produit sur le slug article car incompatibilité avec Gedmo/doctrine-extension qui doit passer en 3.6.0 :
    > composer update 
