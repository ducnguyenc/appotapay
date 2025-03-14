# Run docker
docker-compose up -d

# Install composer
docker-compose exec app bash
composer i

# URL
FE: localhost/transfer
API: localhost/api/v1/service/transfer/make