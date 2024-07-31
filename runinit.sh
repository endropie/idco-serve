docker run --rm --interactive --tty \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  composer install --ignore-platform-reqs
