## Youtube API Client Challenge

### Challenge's Description

    Build an MVC application using PHP and a popular framework which will use the YouTube API on the server side to return a list of YouTube search results by an ajax call.

    Some coding restrictions:

    The code should be created using any popular PHP framework such as Laminas, Laravel or Symfony and follow their best practices for code styling.
    The code submission must be done by sending through a git repository with at least two commits:
        Showing the basic framework and library installation with no modifications
        Showing the application being built and committed without any basic framework setup, this may be done on several commits if desired showing clear progression in building the app.
    Please do not use pre-existing API wrapping libraries (like alaouy/youtube) or submit a pure javascript based implementation where the request to the API is not done in PHP
        We want to see how you interact with an API directly using PHP
        We want to see how you handle the request and the response
        There are many many ways to complete this challenge, but the more you can show off your PHP skills the better.

## How-TOS

### Install application:

1. Open terminal.
2. Go to docker folder. `cd /docker`
3. Execute: `docker-compose build`
4. Execute: `docker-compose up -d`
5. Open Browser and access link: `http://127.0.0.1:8080`

### Access Containers:

- Nginx: `docker exec -it docker_nginx_1 bash`
- PHP: `docker exec -it docker_php_1 bash`

### Install new dependencies through composer:

1. `cd docker` 
2. `docker-compose run php composer require dependency-owner/dependency-name`

### Contributors:
    - Diogo Correia (diogorodriguescorreia89@gmail.com)
