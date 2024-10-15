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
- "Use o comando abaixo para ver o resultado do script, fornecendo os valores dos parâmetros via variáveis de ambiente, como no exemplo abaixo:"
```
docker run --rm \
  -e ORIGIN='018' \
  -e DESTINY='011' \
  -e TIME=200 \
  -e PLAN=120 \
  plantalkmore
```
Explicação do Comando

docker run --rm: Executa um novo container e remove-o após a execução.

-e ORIGIN='018': Define a variável de ambiente ORIGIN com o valor 018.

-e DESTINY='011': Define a variável de ambiente DESTINY com o valor 011.

-e TIME=200: Define a variável de ambiente TIME com o valor 200.

-e PLAN=120: Define a variável de ambiente PLAN com o valor 120.

plantalkmore: O nome da imagem Docker que você criou.

Ao executar esse comando, o script PHP PlanTalkMore.php será executado dentro do container, usando os valores fornecidos nas variáveis de ambiente.