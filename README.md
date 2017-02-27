tvseries
========

Quentin VAN DE KADSYE - PHP IFI

# implementé
 - L'autentification
 - ajout d'une série
 -ajout d'un épisode
 - gestion des pages en fonction du statut de l'utilisateur;
 
## Pas implémenté 
 - gestion des épisodes vus
 
# Sécurité
- L'ORM doctrine a été utilisé
- Les formtype de symfony ont été utilisés
Cependant lors d'une tentative d'exploitation d'une faille XSS, celle-ci a été bloqué, mais l'affichage des détails d'une série était impossible à cause de l'encodage de caractère
