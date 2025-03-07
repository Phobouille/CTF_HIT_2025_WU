# Solution
Nous nous rendons compte via un scan de ports que le seul port ouvert est 16992. Cela correspond à Intel AMT.

Ce challenge est basé sur la vulnérabilité "Silent Bob is silent". Celle-ci permet d'accéder au panneau d'administration
à cause d'une faille toute bête : 

```if(strncmp(computed_response, user_response, user_response_length))```

Le 3ème paramètre aurait dû être la longueur de computed_response, et non de user_response.
Cela permet de rentrer une réponse vide, et de comparer les 0 premiers caractères entre la bonne réponse et l'input utilisateur,
et donc d'avoir une condition toujours vraie.

Combiné avec l'utilisateur par défaut de Intel AMT : admin, cela permet de se connecter au serveur.

Nous pouvons donc nous connecter avec **user=admin** et **password=nimportequoi**
, puis modifier la requête pour changer la valeur de l'authentification Digest **response=""** et récupérer le flag : HIT{AB3g1nn€rM1stake}

Explication plus en profondeur :
https://theswissbay.ch/pdf/Whitepaper/Hacking/Silent%20Bob%20is%20Silent%20-%20Embedi.pdf