<?php

namespace App\Controllers;

//Importa a classe de serviço que lida com a lógica de negócio e interação com o banco de dados
use App\Services\DrinkService;
//Importa a interface do padrão PSR-7 como . Essa interface define métodos para acessar dados de solicitação de forma independente de estrutura
use Psr\Http\Message\ServerRequestInterface as Request;
//Importa a interface do PSR-7 como . Essa interface define métodos para criar e enviar respostas.
use Psr\Http\Message\ResponseInterface as Response;
//Importa a classe da estrutura Slim para lidar com erros de solicitação incorreta.
use Slim\Exception\HttpBadRequestException;
//Importa a classe de Slim para manipular erros não encontrados
use Slim\Exception\HttpNotFoundException;

//Declara uma classe chamada . Essa classe serve como um controlador que manipula solicitações HTTP relacionadas a bebidas.
class DrinkController
{
    //Define uma propriedade privada nomeada para manter uma instância da classe
    private $drinkService;

    //Define o construtor da classe. Ele toma um objeto como argumento e o atribui à propriedade. Isso é chamado de injeção de dependência, em que o controlador não cria o serviço em si, mas depende de um mecanismo externo (provavelmente um contêiner de injeção de dependência) para fornecê-lo
    public function __construct(DrinkService $drinkService)
    {
        $this->drinkService = $drinkService;
        echo "Api funcionando";
    }

    //Define um método público chamado que usa dois argumentos: um objeto e um objeto. Ele também declara um tipo de retorno de
    public function index(Request $request, Response $response): Response
    {
        //Chama o método no injetado(service) para recuperar todas as bebidas.
        $drinks = $this->drinkService->getAllDrinks();
        //Codifica a matriz no formato JSON e a grava no corpo da resposta
        $response->getBody()->write(json_encode($drinks));
        // Define o código de status de resposta como 200 (OK) e retorna o objeto modificado. Este método lida essencialmente com pedidos para obter uma lista de todas as bebidas.
        return $response->withStatus(200);
    }

    public function create(Request $request, Response $response): Response
    {
        // Decodifica os dados JSON do corpo da solicitação em uma matriz associativa ( argumento)
        $data = json_decode($request->getBody(), true);

        try {
            //Codifica os dados da bebida criados em JSON e os grava no corpo da resposta.
            $drink = $this->drinkService->createDrink($data);
            //Define o código de status como 201 (Criado) e retorna a resposta.
            $response->getBody()->write(json_encode($drink));
            return $response->withStatus(201);
        } catch (\Exception $e) {
            throw new HttpBadRequestException($e->getMessage());
        }
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        //Extrai o parâmetro dos argumentos de solicitação.
        $id = $args['id'];

        try {
            $drink = $this->drinkService->getDrinkById($id);
            $response->getBody()->write(json_encode($drink));
            return $response->withStatus(200);
        } catch (\Exception $e) {
            throw new HttpNotFoundException($e->getMessage());
        }
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $data = json_decode($request->getBody(), true);

        try {
            $drink = $this->drinkService->updateDrink($id, $data);
            $response->getBody()->write(json_encode($drink));
            return $response->withStatus(201);
    } catch (\Exception $e) {
        // Trate o erro aqui
        $errorMessage = $e->getMessage();
        $statusCode = 500; // Código de status HTTP apropriado

        // Opcional: Registre o erro em um log ou envie um email de notificação
        error_log($errorMessage);

        $response->getBody()->write(json_encode(['error' => $errorMessage]));
        return $response->withStatus($statusCode);
        }
    }
}