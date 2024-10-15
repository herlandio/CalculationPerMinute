FROM php:7.4-alpine

# Instala dependências necessárias para o Composer
RUN apk add --no-cache \
    curl \
    git \
    unzip

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copia o composer.json (não é necessário copiar o composer.lock, pois ele será gerado)
COPY composer.json ./

# Instala as dependências do Composer
RUN composer install --no-interaction --prefer-dist

# Copia o restante do código
COPY . .

# Definição das variáveis de ambiente
ENV ORIGIN=""
ENV DESTINY=""
ENV TIME=0
ENV PLAN=0

CMD ["sh", "-c", "php index.php $ORIGIN $DESTINY $TIME $PLAN"]
