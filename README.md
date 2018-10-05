Synergist.io Challenge
======================
[![Build Status](https://travis-ci.org/canerdogan/synergist-challenge.svg?branch=master)](https://travis-ci.org/canerdogan/synergist-challenge)
[![Coverage Status](https://coveralls.io/repos/github/canerdogan/synergist-challenge/badge.svg?branch=master)](https://coveralls.io/github/canerdogan/synergist-challenge?branch=master)

Installation
------------
You have to change Google API Key in `docker-compose.yml` and `docker-compose-server.yml` files:
```yaml
GOOGLE_API_KEY:
``` 
Testing
-------
To run the test for this, run:
```bash
docker-compose up
```
Run Server
----------
To run the server, run:
```bash
docker-compose -f docker-compose-server.yml up
```