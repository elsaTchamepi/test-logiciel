<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../src/ContactService.php';

/**
 * * @covers invalidInputException
 * @covers \ContactService
 *
 * @internal
 */
final class ContactServiceUnitTest extends TestCase {
    private $contactService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->contactService = new ContactService();
    }

    public function testCreationContactWithoutAnyText() {
        $ContactServiceUnitTest = new \Tests\uniTests\ContactServiceUnitTest(\Mockery::mock('\Tests\uniTests\AbstractPdoFacade'));
        $this->assertEquals(new \src\ContactService("foo"), $ContactServiceUnitTest->createContact("foo"));
    }

    public function testCreationContactWithoutPrenom() {

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('le prenom doit être renseigné');
        $contactService = new ContactService();
        $contactService->createContact("tchamepi",null);
    }
    

    public function testCreationContactWithoutNom() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('le nom  doit être renseigné');
        $contactService = new ContactService();
        $contactService->createContact(null,"elsa");
    }

    public function testSearchContactWithNumber() {
        
    }

    public function testModifyContactWithInvalidId() {
        $contactService = new ContactService();

        $contactService = "
        id  |nom         |prenom  
        5   |tchamapi    |elsa  
               
    	";

        $expectedArray = array(
            array("id" => "5",
                "nom" => "tchamepi",
                "prenom" => "elsa"),
            
        );
        $this->assertSame($expectedArray, $contactService->contactService($contactService));
    }

    public function testDeleteContactWithTextAsId()
     {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");
        $contactService = new ContactService();
        $contactService->deleteContact("zare");
    }
}

