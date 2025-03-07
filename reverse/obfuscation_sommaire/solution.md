# Solution
Il faut analyser le code, nous nous rendons compte qu'il a été obfusqué par des fonctions et des boucles inutiles.

En renommant petit à petit les fonctions selon ce qu'elles font, nous comprenons comment fonctionne le programme.
Plutot que de galérer à vouloir retrouver comment est stocké le mot de passe, nous allons plutot contourner la comparaison 
entre celui-ci et l'input utilisateur.

En modifiant la valeur du saut de la comparaison entre l'input utilisateur et le mot de passe pour la rediriger vers la fonction normalement appelée lorsque le mot de passe est bon, nous pouvons relancer le programme normalement,
tapper n'importe quoi, et accéder au flag : HIT{GpluDINSPIla}