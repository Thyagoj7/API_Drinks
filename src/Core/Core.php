<?php

namespace App\Core;

//Essa classe atua como um hub central para gerenciar a  instância usada no Doctrine ORM (Object-Relational Mapper) em seu aplicativo.
// Ele fornece uma maneira padronizada de acessar e definir o gerenciador de entidades, 
//garantindo uma interação consistente com seu banco de dados em todo o código.EntityManager


//use Doctrine\ORM\EntityManager;: Isso importa a classe da biblioteca ORM do Doctrine, permitindo que você a faça referência direta
// sem o namespace completo.EntityManager
use Doctrine\ORM\EntityManager;


class Core
{

  //private static $entityManager;: Isso declara uma propriedade estática privada chamada $entityManager. As propriedades estáticas são compartilhadas entre todas as instâncias da classe e não podem ser modificadas de fora da classe. Aqui Ele armazena uma referência ao gerenciador de entidades.
  private static $entityManager;

  //public static function setEntityManager(EntityManager $entityManager): void: Este método estático público, nomeado setEntityManager, usa um argumento do tipo EntityManager. Ele define o $entityManager com a instância do gerenciador de entidades fornecida. O tipo de retorno void indica que não retorna nenhum valor.
  public static function setEntityManager(EntityManager $entityManager): void
  {
      self::$entityManager = $entityManager;
  }
//public static function getEntityManager(): object: Este método estático público, nomeado getEntityManager, Tenta recuperar o gerenciador de entidades. Primeiro, verifica se self::$entityManager não é nulo (o que significa que ainda não foi definido). Se não estiver definido, lança um Exception com uma mensagem indicando que o gerenciador de entidades não foi configurado. Se estiver definido, ele retorna o $entityManager objeto.
  public static function getEntityManager(): object
  {
      if (!self::$entityManager) {
          throw new \Exception('Entity Manager not set');
      }

      return self::$entityManager;
  }
  // public static function dispatch(array $routes)
  // {
  //   print_r($routes);
  // }
}



//Para definir o gerenciador de entidades: -----------------------------------------

/*$entityManager = // ... Create or obtain your entity manager instance

Core::setEntityManager($entityManager);*/

//Para recuperar o gerenciador de entidades: --------------------------------------------------
/*$entityManager = Core::getEntityManager();
//Use the $entityManager for your database operations*/


/*
Pontos principais:

Essa classe demonstra o padrão Singleton, criando um único ponto de acesso ao gerenciador de entidades dentro do aplicativo.
O uso de uma propriedade estática torna o gerenciador de entidades acessível sem a necessidade de instanciar a própria classe.Core
O tratamento de erros é implementado para impedir o uso de um gerenciador de entidades não definido.
O método comentado sugere uma possível funcionalidade de roteamento futuro.
Espero que esta explicação seja útil! Sinta-se à vontade para perguntar se você tiver mais alguma dúvida.
*/