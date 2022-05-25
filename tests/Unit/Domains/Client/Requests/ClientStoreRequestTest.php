<?php

namespace Tests\Unit\Domains\Client\Requests;

use App\Data\Models\Client;
use App\Domains\Client\Requests\ClientStoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;

class ClientStoreRequestTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @var \App\Domains\Client\Requests\ClientStoreRequest */
    private $rules;

    /** @var \Illuminate\Validation\Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->validator = app()->get('validator');
        $this->rules = (new ClientStoreRequest())->rules();
    }

    public function validationProvider()
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);
        $name = $faker->regexify('[A-Za-z]{2,32}');
        $email = $faker->email;
        $phone = $faker->e164PhoneNumber;

        return [
            'request_should_fail_when_no_firstName_is_provided' => [
                'passed' => false,
                [
                    'lastName' => $name,
                    'email' => $email,
                    'phone' => $phone
                ]
            ],
            'request_should_fail_when_firstName_has_less_than_2_characters' => [
                'passed' => false,
                'data' => [
                    'firstName' => $faker->paragraphs(2),
                    'lastName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_firstName_has_less_than_32_characters' => [
                'passed' => false,
                'data' => [
                    'firstName' => $faker->paragraphs(33),
                     'lastName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_firstName_doest_have_latin_letters' => [
                'passed' => false,
                'data' => [
                    'firstName' => $faker->numberBetween(1, 10),
                     'lastName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_no_lastName_is_provided' => [
                'passed' => false,
                'data' => [
                    'firstName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_lastName_has_less_than_2_characters' => [
                'passed' => false,
                'data' => [
                    'lastName' => $faker->paragraphs(2),
                    'firstName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_lastName_has_less_than_32_characters' => [
                'passed' => false,
                'data' => [
                    'lastName' => $faker->paragraphs(33),
                    'firstName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_lastName_doest_have_latin_letters' => [
                'passed' => false,
                'data' => [
                    'lastName' => $faker->numberBetween(1, 10),
                    'firstName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_no_email_is_provided' => [
                'passed' => false,
                'data' => [
                    'firstName' => $name,
                    'lastName' => $name,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_fail_when_no_phoneNumber_is_provided' => [
                'passed' => false,
                'data' => [
                    'firstName' => $name,
                    'lastName' => $name,
                    'email' => $email
                ]
            ],
            'request_should_fail_when_phoneNumber_doesnt_match_e164_format' => [
                'passed' => false,
                'data' => [
                    'firstName' => $name,
                    'lastName' => $name,
                    'email' => $email,
                    'phoneNumber' => $faker->phoneNumber,
                ]
            ],
            'request_should_pass_when_email_format_is_invalid' => [
                'passed' => false,
                'data' => [
                    'firstName' => $name,
                    'lastName' => $name,
                    'email' => $this->faker->text,
                    'phoneNumber' => $phone
                ]
            ],
            'request_should_pass_when_data_is_provided' => [
                'passed' => true,
                'data' => [
                    'firstName' => $name,
                    'lastName' => $name,
                    'email' => $email,
                    'phoneNumber' => $phone
                ]
            ]
        ];
    }

    /**
     * @test
     */
    public function request_should_fail_when_email_already_exists()
    {
        $client=Client::factory()->create()->first();

        $this->validation_results_as_expected(false, [
            'firstName' => $this->faker->regexify('[A-Za-z]{2,32}'),
            'lastName' => $this->faker->regexify('[A-Za-z]{2,32}'),
            'email' => $client->email,
            'phoneNumber' => $this->faker->e164PhoneNumber
        ]);
    }

    /**
     * @test
     */
    public function request_should_fail_when_phoneNumber_already_exists()
    {
        $client=Client::factory()->create()->first();

        $this->validation_results_as_expected(false, [
            'firstName' => $this->faker->regexify('[A-Za-z]{2,32}'),
            'lastName' => $this->faker->regexify('[A-Za-z]{2,32}'),
            'email' => $this->faker->email,
            'phoneNumber' =>$client->phoneNumber
        ]);
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validation_results_as_expected($shouldPass, $mockedRequestData)
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData)
    {
        return $this->validator->make($mockedRequestData, $this->rules)
            ->passes();
    }
}
