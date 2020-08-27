<?php

namespace App\Providers;

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

    }

    public function registerMiscellanea(): void
    {
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
