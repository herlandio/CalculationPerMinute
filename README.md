# Tarifação de ligação com ou sem plano.

- Para baixar o script abra seu terminal e execute o comando abaixo.

```
git clone https://github.com/herlandio/Call-Pricing
```

- O primeiro parametro é a origem da ligação.
- O segundo parametro é o destino da ligação.
- O terceiro parametro é o total de minutos falados.
- O quarto parametro é o plano escolhido, ou seja, o plano inserido deve ser 30, 60 ou 120 minutos.
- O retorno da função sera o valor referentes ao total com plano ou sem plano.

```
(new PlanTalkMore('018', '011', 200, 120));
```

- O valor da tarifa por minuto esta identificado como priceForMinute.
- A origem esta identificado como origin.
- O destino esta identificado como destiny.

```
return [
          [
              'origin' => '011',
              'destiny' => '016',
              'priceForMinute' => 1.90
          ],
          [
              'origin' => '016',
              'destiny' => '011',
              'priceForMinute' => 2.90
          ],
          [
              'origin' => '011',
              'destiny' => '017',
              'priceForMinute' => 1.70
          ],
          [
              'origin' => '017',
              'destiny' => '011',
              'priceForMinute' => 2.70
          ],
          [
              'origin' => '011',
              'destiny' => '018',
              'priceForMinute' => 0.90
          ],
          [
              'origin' => '018',
              'destiny' => '011',
              'priceForMinute' => 1.90
          ]
      ];
```

- Acesse a pasta Call-Pricing e construa a imagem docker com o comando abaixo:

```
docker build -t plantalkmore:v1 .
```
- Inicie o container
```
docker run -it -d plantalkmore:v1
```
- Use docker ps para ver o CONTAINER_ID
- Use o comando abaixo para ver o resultado do script
```
docker exec -it CONTAINER_ID php PlanTalkMore.php
```