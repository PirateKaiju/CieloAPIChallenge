<h1>Exemplo de aplicação com a API Cielo em PHP</h1>

<h3>Sobre</h3>
Esta é uma aplicação de teste que cria e consulta registros de vendas através da API Cielo. A mesma é desenvolvida em PHP, com a API Cielo na versão 3.0, disponível em: 
https://github.com/DeveloperCielo/ 

No viés de tornar esta uma aplicação mais interativa, a mesma conta com uma UI (páginas) que possibilita executar os testes.

É necessário a obtenção de uma chave e um identificador para o ambiente sandbox da API. Os mesmos podem ser obtidos através do link: https://cadastrosandbox.cieloecommerce.cielo.com.br/

<h3>Deployment / Testes</h3>

Esta aplicação faz uso do composer como gerenciador de dependências. Para testar a mesma, observe os passos a seguir (considerando um ambiente PHP completamente operacional):

<ul>

<li>Clone este repositório (ou faça o download e descompacte o arquivo)</li>
<li>No diretório do projeto, execute o comando: </li>
<li>A Chave e o Identificador devem ser atribuídos às constantes presentes no arquivo <i>config.php</i> do projeto</li>
<li>Esta aplicação foi desenvolvida de modo à operar independentemente do servidor utilizado. Fato é que o próprio servidor built-in de testes do PHP pode ser usado para a mesma. Para isto, é necessário rodar o seguinte comando no diretório do projeto: '''php -S localhost:8000'''</li>
<li>Acesse o endereço a seguir para a UI da aplicação: http://localhost:8000/</li>

</ul>
