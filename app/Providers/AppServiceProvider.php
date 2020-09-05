<?php

namespace App\Providers;

use Faker\Generator;
use Faker\Provider\Base;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiscellanea();
    }

    public function registerMiscellanea(): void
    {
        $this->app->extend(Generator::class, function (Generator $generator) {
            $generator->addProvider(new class($generator) extends Base {
                static $index = 1;

                public function randomDigits($nDigits)
                {
                    $result = "";
                    for ($i = 0; $i < $nDigits; ++$i) {
                        $result .= $this->generator->randomDigit;
                    }
                    return $result;
                }

                public function index()
                {
                    return static::$index++;
                }

                public function resetIndex()
                {
                    static::$index = 1;
                }
            });

            return $generator;
        });

        $this->app->extend(ValidatorFactory::class, function (ValidatorFactory $factory) {
            $factory->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
                $validator = new Validator($translator, $data, $rules, $messages, $customAttributes);
                $validator->setImplicitAttributesFormatter(function ($attribute) {
                    [$group_name, $index, $attribute_name] = explode(".", $attribute);

                    return __("validation.attributes.{$attribute_name}", [
                        "index" => $index,
                    ]);
                });
                return $validator;
            });
            return $factory;
        });
    }
}
