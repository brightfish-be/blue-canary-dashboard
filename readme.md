# Blue Canary

[![Build Status](https://travis-ci.com/brightfish-be/blue-canary-dashboard.svg?branch=master&label=Build&style=flat-square)](https://travis-ci.com/brightfish-be/blue-canary-dashboard)
[![StyleCI](https://github.styleci.io/repos/225647185/shield?branch=master&style=flat-square)](https://github.styleci.io/repos/225647185)

Laravel-based monitoring and metrics collection server.  
Linked repositories: [Aggregator](https://github.com/brightfish-be/blue-canary-aggregator) | [Server](https://github.com/brightfish-be/blue-canary-server) | [Installer](https://github.com/brightfish-be/blue-canary-installer).

## Production installation
```
sudo docker-compose up -d
sudo ./install
```

## Development
### Folder structure
- blue-canary
    - blue-canary-aggregator
    - blue-canary-dashboard
    - blue-canary-install
    - blue-canary-server

### Deployment
```
cd blue-canary-install
docker-compose -f docker-compose.yml -f docker-compose-dev.yml build
docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d
```
