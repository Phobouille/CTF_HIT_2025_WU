# Solution 
En inspectant nos cookies nous voyons un cookie admin=0. Nous pouvons aisément imaginer qu'en le passant à 1 nous pouvons récupérer des droits admins.

Puisque son ip fonctionne même lorsqu'il passe par un VPN, alors il a sans doute utilisé **HTTP-X-FORWARDED-FOR**.
Malheureusement nous pouvons modifier le header HTTP-X-FORWARDED-FOR pour usurper aisément son IP.

En envoyant une requête avec le cookie **admin=1** et le header **X-FORWARDED-FOR=88.123.245.203** nous obtenons le flag : HIT{CaPARt&dUN3B0nN€1D}