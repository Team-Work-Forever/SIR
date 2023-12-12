FROM mysql:latest

COPY ./schema.sql /docker-entrypoint-initdb.d/init.sql

EXPOSE 3306

# RUN echo "character-set-server=utf8mb4" >> /etc/mysql/my.cnf
# RUN echo "collation-server=utf8mb4_unicode_ci" >> /etc/mysql/my.cn