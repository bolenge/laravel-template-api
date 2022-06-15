<?php

namespace Tests\Unit\App\Http\Requests;

use App\Http\Requests\ValidatorRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\MessageBag;
use Mockery;
use PHPUnit\Framework\TestCase;

class ValidatorRequestTest extends TestCase
{
    private $validator;
    private $messageBag;

    public function setUp() : void
    {
        parent::setUp();

        $this->validator = Mockery::mock(Validator::class);
        $this->messageBag = Mockery::mock(MessageBag::class);
    }

    public function test_validation_not_failed()
    {
        $validatorRequest = new ValidatorRequest([], ['email' => '']);
        
        $this->assertFalse($validatorRequest->failed());
    }

    public function test_set_and_get_errors()
    {
        $validatorRequest = new ValidatorRequest();

        $this->assertEmpty($validatorRequest->setErrors('Email invalid'));
        $this->assertStringContainsString('Email invalid', $validatorRequest->errors());
    }

    public function test_handle_validation_exception()
    {
        $this->messageBag->shouldReceive('all')->andReturn([]);
        $this->validator->shouldReceive('errors')->andReturn($this->messageBag);
        
        $validatorRequest = new ValidatorRequest();

        $this->assertEmpty($validatorRequest->handleValidationException($this->validator));
    }
}
