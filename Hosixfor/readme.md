# presentation de projet

creation d'un projet avec symfony6 pour apprendre les bonnes pratiques

<!-- ## Installation
utilisation de PHP 8.1.1 Xammp, composer, cli,
utilsation de node.js pour installer node modules bootstrap dans public
utilsation de template SB bootstrap from le site nmpjs.com

```bash
commande pour utilser node modules;
npm init --yes
npm i bootstrap
ajouter le fichier readme.md pour la documentation de projet
cree un dossier assets pour mettre les fichies js et css images ..
```

## Usage twig

-crée un nouveu fichie twig template pour placer une sidebar (SB admin bootstrap) et placer les message flashbags juste avant le body.
-crée un dossier fragements dans templates pour ecrire les codes betes(sans controller=traitement) qui sont reutilisables dans plusieurs pages et on les appeles par la methode include().
-utiliser la methode url('') pour un path absolue url d'une page.
-utiliser la methode render(\\controlleur) pour des traitement reutilisables comme les articles recents.
