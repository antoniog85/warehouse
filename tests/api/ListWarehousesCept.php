<?php
$I = new ApiTester($scenario);
$I->wantTo('retrieve the list of warehouses');
$I->sendGET('/warehouses');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('{"result":"ok"}');