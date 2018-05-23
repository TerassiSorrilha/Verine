# Verine
A simple system with Symfony 4!

O symfony não precisa estar dentro de um virtual host para funcionar, então pode baixar e deixar em qualque pasta.

## Instalação
1- Baixe e instale o composer e o MySQL seguindo as opções Defaults;

2- Usando o terminal (Power Shell no caso de Windows), navegue até a pasta na qual esta o sistema;

3- Execute o comando 'composer install' para instalar o restante das dependencias do sistema;

4- Ja em um editor, procure o arquivo '.env' e vá ate a linha que começa com 'DATABASE_URL' e insira as informações do seu MySQL;

5- Volte para o terminal e digite o comando 'php bin/console doctrine:database:create', com isto seu banco de dados será criado;

6- Execute o comando 'php bin/console doctrine:migrations:diff'. Isto vai comparar seu BD com o codigo;

7- Execute o comando 'php bin/console doctrine:migrations:migrate' e confirme com 'y' quando precisar;

8- Execute o comando para instalar o primeiro usuario 'php bin/console app:add-user'.

### Até aqui seu banco de dados ja foi configurado e o symfony instalado.

9- Execute o comando 'php bin/console server:run 0.0.0.0:8000' para iniciar o sistema.

### Fim

Agora o sistema ja está online e assivel pelo seu IP interno na rede ou pelo 'localhost'. 

Lembrar de usar a porta, que neste caso é '8000' ficando 'localhost:8000'.

### Paths temporarios

Blog: localhost:8000
administração: localhost:8000/admin/post/

