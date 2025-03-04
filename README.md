# Legit CTF vulnerable docker template

## Introduction
This repo is used to create and deploy easily vulnerable docker machine for the LegitCtf environment.

It is designed for web vulnerability, but it can be easily changed.

## How to use it.

Create a new project by copying the content of this repo.
Edit the .env file.
Retrieve your CTF server certificate from your LegitCTF instance inside the ansible>roles>ctf_client_install>files directory. The fdile should be named cert.pem.  
Create the init.sql based on your needs.
Create your web app inside the web directory.

When everything is ready and your ctf platform is up, run inside your project directory:
```
docker compose up --build
```


## More details

### Networking stuff

3 networks are defined in the docker compose.

***lan_net***
It is used to get a dedicated ip on your computer/server network.
That's why you have to provide LAN_INTERFACE in the .env file.

As it is a macvlan network, you can't reach the docker from the host via this network.

Be carefull, as docker doesn't use your network dhcp it can define an ip already taken by another machine. That's why there is the LAN_RANGE variable. It is used to define an ip range used by docker to define the ip address of your container.

***ctf-docker***
This network is created when you run a LegitCTF instance. If no instance is running, this network will not exist and lead to an error.
If you didn't change the default config of LegitCTF, do not touch to the CTF_IP and DASHBOARD_PORT varibles.

***db_net***
It is not required. Generally, for a web application you need a database. This network is used by the web service to communicate with the database which is not exposed on any other network.



