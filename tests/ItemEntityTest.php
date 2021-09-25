<?php

namespace App\Tests;

use App\Entity\Item;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validation;

class ItemEntityTest extends KernelTestCase
{
    public function testValidEntity(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);
    }

    public function testValidItem():void{
        $item=(new Item())
        ->setTitre("Le Jeu de la dame")
        ->setDescription("The queen's gambit")
        ->setDuree(40)
      //  ->setAnnee(2020)
        ->setType("Série");
        // démarrer le noyau de symfony
        $validator = Validation::createValidator();   
        $violations = $validator->validate($item);     
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($violations as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $this->assertCount(0, $violations, implode(', ', $messages));
        
    }    

 
}
