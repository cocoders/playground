Run docker
===========

**Notice:** Will remove and close all other docker container.

Running docker

```bash
sudo ./docker.sh
```

Run command at docker container
========

```bash
sudo docker run --link mysql:mysql --name app --rm -v $(pwd):/var/www/playground -t -i application php -v
```
