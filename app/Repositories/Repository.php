<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected Model $user;

    /**
     * @param \Illuminate\Database\Eloquent\Model $user
     * @return void
     */
    public function setUser(Model $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getUser(): Model
    {
        return $this->user ?? Auth::user() ?? throw new ModelNotFoundException('User not defined.');
    }

    /**
     * @param callable $callback
     * @return mixed
     */
    public function accessAll(callable $callback)
    {
        $content = $callback ();

        return $content;
    }

    /**
     * @param callable $callback
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function accessGet(
        callable $callback
    ): Model|null
    {
        $content = $callback ();

        return $content;
    }

    /**
     * @param callable $callback
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function mutateUpdate(
        callable $callback
    ): Model|null
    {
        $content = null;

        DB::beginTransaction();

        try {

            $content = $callback ();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param callable $callback
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function mutateCreate(
        callable $callback
    ): Model|null
    {
        $content = null;

        DB::beginTransaction();

        try {

            $content = $callback ();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param callable $callback
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function mutateDelete(
        callable $callback
    ): Model|null
    {
        $content = null;

        DB::beginTransaction();

        try {

            $content = $callback ();

            DB::commit();

        } catch (Exception $exception) {

            DB::rollback();

            Log::info($exception->getMessage());
        }

        return $content;
    }
};
