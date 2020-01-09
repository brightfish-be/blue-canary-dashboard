# Blue Canary

[![Build Status](https://travis-ci.com/brightfish-be/blue-canary-dashboard.svg?branch=master&label=Build&style=flat-square)](https://travis-ci.com/brightfish-be/blue-canary-dashboard)
[![StyleCI](https://github.styleci.io/repos/225647185/shield?branch=master&style=flat-square)](https://github.styleci.io/repos/225647185)

**[WORK IN PROGRESS...]**  
Laravel-based monitoring and metrics collection server.  
Linked repositories: [Aggregator](https://github.com/brightfish-be/blue-canary-aggregator) 
| [Server](https://github.com/brightfish-be/blue-canary-server) 
| [Installer](https://github.com/brightfish-be/blue-canary-installer)
| [Client](https://github.com/brightfish-be/blue-canary-client).

## Production installation
(You may need `sudo` for the `setup` and `install` commands since these include docker commands.)
1. `git clone git@github.com:brightfish-be/blue-canary-installer.git .`
2. `./setup`
3. Edit your `.env` file
4. `./install`

## Development installation
```
mkdir blue-canary
cd blue-canary
git clone git@github.com:brightfish-be/blue-canary-aggregator.git
git clone git@github.com:brightfish-be/blue-canary-dashboard.git
git clone git@github.com:brightfish-be/blue-canary-server.git
git clone git@github.com:brightfish-be/blue-canary-installer.git
cd blue-canary-installer
docker-compose -f docker-compose.yml -f docker-compose-dev.yml build
docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d
```

## License
GNU General Public License (GPL). Please see License File for more information.
