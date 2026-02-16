## Etape 1: Pour vous (Linux) - SUR DEV
git checkout dev
git pull origin dev  # Récupère le travail du binôme
# Travailler...
git add .
git commit -m "Fonctionnalité X"
git push origin dev

# Pour le binôme (Mac) - SUR DEV
git checkout dev
git pull origin dev  # Récupère VOTRE travail
# Ses fichiers config.php restent intacts !

## Etape 2: Merger vers main (version stable)

# Quand une fonctionnalité est terminée et testée
git checkout dev
git pull origin dev  # S'assurer d'être à jour

# Tester en local
# ...

# Merger vers main
git checkout main
git merge dev
git push origin main

# Retourner sur dev pour continuer
git checkout dev