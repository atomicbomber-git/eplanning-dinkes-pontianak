<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Providers\AuthServiceProvider;
use App\Puskesmas;
use App\Support\SessionHelper;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PuskesmasForAdminController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(AuthServiceProvider::MANAGE_PUSKESMAS);
        return $this->responseFactory->view("puskesmas-for-admin.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize(AuthServiceProvider::MANAGE_PUSKESMAS);
        return $this->responseFactory->view("puskesmas-for-admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize(AuthServiceProvider::MANAGE_PUSKESMAS);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "alamat" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)],
            "name" => ["required", "string"],
            "password" => ["required", "string", "confirmed"],
        ]);

        $data["password"] = Hash::make($data["password"]);

        DB::beginTransaction();

        /** @var User $user */
        $user = User::query()
            ->create(Arr::only($data, [
                "username",
                "name",
                "password",
            ]));

        $user->puskesmas()->create(Arr::only($data, [
            "nama",
            "alamat",
        ]));

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("puskesmas-for-admin.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Puskesmas $puskesmas
     * @return Response
     */
    public function show(Puskesmas $puskesmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Puskesmas $puskesmas
     * @return Response
     */
    public function edit(Puskesmas $puskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_PUSKESMAS);

        return $this->responseFactory->view("puskesmas-for-admin.edit", [
            "puskesmas" => $puskesmas->load("user"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Puskesmas $puskesmas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Puskesmas $puskesmas)
    {
        $this->authorize(AuthServiceProvider::MANAGE_PUSKESMAS);

        $data = $request->validate([
            "nama" => ["required", "string"],
            "alamat" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)->ignoreModel($puskesmas)],
            "name" => ["required", "string"],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        if (isset($data["password"])) {
            $data["password"] = Hash::make($data["password"]);
        }
        else {
            unset($data["password"]);
        }

        DB::beginTransaction();

        /** @var User $user */
        $puskesmas->user()
            ->update(Arr::only($data, [
                "username",
                "name",
                "password",
            ]));

        $puskesmas->update(Arr::only($data, [
            "nama",
            "alamat",
        ]));

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("puskesmas-for-admin.edit", $puskesmas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Puskesmas $puskesmas
     * @return Response
     */
    public function destroy(Puskesmas $puskesmas)
    {
        //
    }
}
