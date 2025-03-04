# web/Dockerfile
FROM php:7.4-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    wget \
    curl \
    iproute2 \
    && apt-get clean

# Install PHP MySQLi extension
RUN docker-php-ext-install mysqli

# Copy the application code
COPY . /var/www/html

COPY cert.pem /usr/local/share/ca-certificates/ctf_local.crt

RUN update-ca-certificates

# Set the working directory
WORKDIR /var/www/html

ARG DEFAULT_PASSWORD
ARG MACHINE_NAME
ARG CTF_ID
ARG VM_HOST_IP
ARG LAN_SUBNET
ARG DASHBOARD_PORT

# Create and configure flag.conf
RUN echo "DEFAULT_PASSWORD=${DEFAULT_PASSWORD}" > /var/www/html/flag.conf \
    && echo "CTF_SERVER=https://ctf.local:${DASHBOARD_PORT}}" >> /var/www/html/flag.conf \
    && echo "MACHINE_NAME=${MACHINE_NAME}" >> /var/www/html/flag.conf \
    && echo "LAN_SUBNET=${LAN_SUBNET}" >> /var/www/html/flag.conf \
    && echo "CTF_ID=${CTF_ID}" >> /var/www/html/flag.conf

RUN cat /var/www/html/flag.conf

# Set execute rights on flag.sh
RUN chmod +x /var/www/html/flag.sh


# # Enroll the VM (assuming flag.sh is a script that can be executed)
# RUN /var/www/html/flag.sh -f

# # Remove the default password from the file
# RUN sed -i '/^DEFAULT_PASSWORD=/d' /var/www/html/flag.conf

# Expose port 80
EXPOSE 80

# Start Apache

CMD ["sh", "-c", "/var/www/html/flag.sh -f; chown www-data /var/www/html/cookie.txt; apache2-foreground"]
# CMD ["apache2-foreground"]